<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;

class Payment extends CI_Controller {
  
    public function __construct() 
    {
        parent::__construct();

        // Load Midtrans config
        $this->load->config('midtrans');

        // Set Midtrans configuration
        Config::$serverKey = $this->config->item('midtrans_server_key');
        Config::$clientKey = $this->config->item('midtrans_client_key');
        Config::$isProduction = $this->config->item('midtrans_is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        
    }

    public function index() 
    {
        $data['user'] = $this->modelUser->getUserBySession();
        $keranjang = $this->session->userdata('keranjang');
        // Jika keranjang kosong
		if (empty($keranjang)) {
			$data['keranjang'] = [];
			$data['total_pembayaran'] = 0;
			$data['message'] = 'Keranjang Anda kosong. Silakan tambahkan produk ke keranjang.';
		} else {
			$total_pembayaran = 0;

			// Hitung total pembayaran
			foreach ($keranjang as $item) {
				$total_pembayaran += $item['harga_produk'] * $item['jumlah'];
			}

			// Data yang akan dikirim ke view
			$data['keranjang'] = $keranjang;
			$data['total_pembayaran'] = $total_pembayaran;
			$data['message'] = null; // Tidak ada pesan
		}

        $this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('keranjang/checkout', $data);
		$this->load->view('layoutHome/footer', $data);
    }

    public function pay() 
    {
        // Ambil data dari model keranjang
        $data['user'] = $this->modelUser->getUserBySession();
        $user = $data['user'];
        $keranjang = $this->session->userdata('keranjang');
        
        // Jika keranjang kosong
        if (empty($keranjang)) {
            echo json_encode(['error' => 'Keranjang Anda kosong. Silakan tambahkan produk ke keranjang.']);
            return;
        }

        $total_pembayaran = 0;

        // Hitung total pembayaran
        foreach ($keranjang as $item) {
            $total_pembayaran += $item['harga_produk'] * $item['jumlah'];
        }

        // Data transaksi untuk Midtrans
        $transaction_details = [
            'order_id' => uniqid('ORDER-'), // Buat order_id unik
            'gross_amount' => $total_pembayaran
        ];

        // Data pelanggan
        $customer_details = [
            'first_name' => $user['nama'],
            'email' => $user['email'],
            'phone' => $user['no_telp']
        ];

        // Data item
        $item_details = [];
        foreach ($keranjang as $item) {
            $item_details[] = [
                'id' => $item['id_produk'],
                'price' => $item['harga_produk'],
                'quantity' => $item['jumlah'],
                'name' => $item['nama_produk']
            ];
        }

        // Data untuk tabel orders
        $order_data = [
            'id_user' => $this->session->userdata('id_user'),
            'total_harga' => $total_pembayaran,
            'metode_pembayaran' => 'Midtrans', // Metode pembayaran
            'status_pembayaran' => 'Menunggu Pembayaran', // Status pembayaran
            'status_pesanan' => 'Diproses',
            'tanggal_order' => date('Y-m-d H:i:s'),
            'order_id' => $transaction_details['order_id'] // Simpan order_id Midtrans
        ];

        // Simpan data order ke database
        $id_order = $this->modelKeranjang->insert_order($order_data);

        // Simpan data ke tabel order_item
        foreach ($keranjang as $item) {
            $order_item_data = [
                'id_order' => $id_order,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga_produk']
            ];
            $this->modelKeranjang->insert_order_item($order_item_data);
        }

        // Parameter pembayaran
        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details
        ];

        // Dapatkan Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            echo json_encode(['token' => $snapToken]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


    public function finish() 
    {
        // Cek apakah keranjang ada di session
        $keranjang = $this->session->userdata('keranjang');
        
        if (!$keranjang) {
            // Jika tidak ada keranjang, redirect ke halaman keranjang
            $this->session->set_flashdata('error', 'Keranjang Anda kosong atau sudah diproses.');
            redirect('keranjang/index');
        }

        // Hapus keranjang dari session
        $this->session->unset_userdata('keranjang');

        // Set pesan sukses
        $this->session->set_flashdata('success', 'Pembayaran berhasil! Pesanan Anda sedang diproses.');

        // Redirect ke halaman konfirmasi atau riwayat pesanan
        redirect('keranjang');
    }

    // Fungsi untuk mengecek status transaksi
    public function check_payment_status($order_id) 
    {
        try {
            // Ambil status transaksi berdasarkan order_id
            $status = Transaction::status($order_id);

            // Proses respons status transaksi
            $transaction_status = $status->transaction_status;
            $fraud_status = $status->fraud_status;

            // Lakukan tindakan berdasarkan status transaksi
            if ($transaction_status == 'settlement') {
                // Pembayaran sukses
                echo "Pembayaran berhasil untuk Order ID: $order_id";
                // Update status pembayaran di database
                $this->update_payment_status($order_id, 'Lunas');
            } else if ($transaction_status == 'pending') {
                // Pembayaran masih pending
                echo "Pembayaran masih pending untuk Order ID: $order_id";
            } else if ($transaction_status == 'expire') {
                // Pembayaran kadaluwarsa
                echo "Pembayaran expired untuk Order ID: $order_id";
                $this->update_payment_status($order_id, 'Kadaluarsa');
            } else if ($transaction_status == 'cancel') {
                // Pembayaran dibatalkan
                echo "Pembayaran dibatalkan untuk Order ID: $order_id";
                $this->update_payment_status($order_id, 'Dibatalkan');
            } else {
                // Status lainnya
                echo "Status transaksi: $transaction_status untuk Order ID: $order_id";
            }
        } catch (Exception $e) {
            // Jika ada error dalam permintaan API
            echo "Error: " . $e->getMessage();
        }
    }

    public function check_all_pending_payments() 
{
    // Ambil semua order_id yang status pembayarannya 'Menunggu Pembayaran'
    $pending_orders = $this->db->get_where('orders', ['status_pembayaran' => 'Menunggu Pembayaran'])->result_array();

    // Cek status pembayaran untuk setiap order_id
    foreach ($pending_orders as $order) {
        try {
            // Panggil Midtrans API untuk mendapatkan status pembayaran
            $status = \Midtrans\Transaction::status($order['order_id']);
            // Akses properti objek dengan '->'
            $transaction_status = $status->transaction_status;
            $payment_type = $status->payment_type;
            $payment_date = $status->transaction_time;  // Mendapatkan tanggal pembayaran dari Midtrans

            // Update status berdasarkan respons dari Midtrans
            switch ($transaction_status) {
                case 'settlement':
                    // Pembayaran berhasil, update status dan kurangi stok produk
                    $this->update_payment_status($order['order_id'], 'Lunas', $payment_type, $payment_date);
                    // Setelah status Lunas, baru mengurangi stok produk
                    $this->reduce_product_stock($order['order_id']); 
                    log_message('info', "Order ID: {$order['order_id']} berhasil dibayar dan stok produk telah dikurangi.");
                    break;
                
                case 'expire':
                    // Pembayaran kadaluarsa
                    $this->update_payment_status($order['order_id'], 'Kadaluarsa', $payment_type, $payment_date);
                    log_message('info', "Order ID: {$order['order_id']} telah kadaluarsa.");
                    break;
                
                case 'cancel':
                    // Pembayaran dibatalkan
                    $this->update_payment_status($order['order_id'], 'Dibatalkan', $payment_type, $payment_date);
                    log_message('info', "Order ID: {$order['order_id']} telah dibatalkan.");
                    break;
                
                default:
                    log_message('info', "Order ID: {$order['order_id']} masih {$transaction_status}.");
                    break;
            }
        } catch (Exception $e) {
            log_message('error', "Gagal mengecek status untuk Order ID: {$order['order_id']}. Error: {$e->getMessage()}");
        }
    }

    // Menghapus session keranjang setelah proses selesai
    $this->session->unset_userdata('keranjang');

    if ($this->session->userdata('level') == 'admin') {
        redirect('admin/v_order');
    } else {
        redirect('keranjang/orders');
    }
    
}

// Fungsi untuk mengupdate status pembayaran di database
private function update_payment_status($order_id, $status, $payment_type, $payment_date) 
{
    // Update status pembayaran, jenis pembayaran, dan tanggal pembayaran di database
    $data = [
        'status_pembayaran' => $status,
        'jenis_pembayaran' => $payment_type,
        'tanggal_pembayaran' => $payment_date  // Simpan tanggal pembayaran
    ];
    $this->db->where('order_id', $order_id);
    $this->db->update('orders', $data);

    log_message('info', "Status pembayaran Order ID: {$order_id} berhasil diperbarui menjadi: $status pada $payment_date.");
}

private function reduce_product_stock($order_id)
{
    // Ambil data order untuk order_id
    $order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
    
    if (empty($order)) {
        log_message('error', "Order ID: {$order_id} tidak ditemukan.");
        return;
    }

    // Ambil data order item untuk order_id
    $order_items = $this->db->get_where('order_item', ['id_order' => $order['id_order']])->result_array();

    if (empty($order_items)) {
        log_message('error', "Tidak ada item untuk order ID: {$order_id}.");
        return;
    }

    // Loop melalui order_items untuk mengurangi stok produk
    foreach ($order_items as $item) {
        // Kurangi stok produk menggunakan query update langsung
        $this->db->set('stok_produk', 'stok_produk - ' . $item['jumlah'], FALSE);
        $this->db->where('id_produk', $item['id_produk']);
        $this->db->where('stok_produk >=', $item['jumlah']); // Pastikan stok cukup
        $this->db->update('produk');

        if ($this->db->affected_rows() > 0) {
            log_message('info', "Stok produk ID: {$item['id_produk']} dikurangi.");
        } else {
            log_message('error', "Stok produk ID: {$item['id_produk']} tidak cukup untuk order ID: {$order_id}.");
        }
    }
}


    
}