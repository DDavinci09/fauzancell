<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {
		
	public function __construct()
    {
        parent::__construct();
        $this->load->model('modelKeranjang');
    }

    // Menampilkan halaman keranjang
	public function index()
	{
		$data['user'] = $this->modelUser->getUserBySession();
		// Ambil data keranjang dari session
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

		// Load views
		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('keranjang/index', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	
    // Menambahkan produk ke keranjang
    public function tambah($id_produk)
    {
        $jumlah = $this->input->post('jumlah', TRUE);
        if (!$jumlah) {
            $jumlah = 1; // Jika tidak ada jumlah, default ke 1
        }

        // Panggil model untuk menambahkan produk ke keranjang
        $this->modelKeranjang->tambah_ke_keranjang($id_produk, $jumlah);

        // Redirect ke halaman keranjang
        redirect('keranjang/index');
    }


	public function hapus_item($id_produk)
	{
		// Ambil data keranjang dari session
		$keranjang = $this->session->userdata('keranjang');

		// Periksa apakah keranjang ada dan ID produk yang dimaksud ada di dalamnya
		if ($keranjang && isset($keranjang[$id_produk])) {
			// Hapus produk dari keranjang
			unset($keranjang[$id_produk]);

			// Update kembali session keranjang
			$this->session->set_userdata('keranjang', $keranjang);

			// Set flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Produk berhasil dihapus dari keranjang!
			</div>');
		} else {
			// Jika produk tidak ditemukan
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Produk tidak ditemukan di keranjang!
			</div>');
		}

		// Redirect kembali ke halaman keranjang
		redirect('keranjang');
	}

	public function update_keranjang()
	{
		// Ambil data keranjang dari session
		$keranjang = $this->session->userdata('keranjang');

		// Ambil data dari form (ID produk dan jumlah baru)
		$id_produk = $this->input->post('id_produk');
		$jumlah_baru = $this->input->post('jumlah');

		// Validasi jumlah baru harus lebih besar dari 0
		if ($jumlah_baru > 0) {
			// Update jumlah produk di keranjang
			if (isset($keranjang[$id_produk])) {
				$keranjang[$id_produk]['jumlah'] = $jumlah_baru;
				$this->session->set_userdata('keranjang', $keranjang);

				// Flash message sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Jumlah produk berhasil diperbarui!
				</div>');
			} else {
				// Flash message error jika produk tidak ditemukan
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Produk tidak ditemukan di keranjang!
				</div>');
			}
		} else {
			// Flash message error jika jumlah tidak valid
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Jumlah produk harus lebih besar dari 0!
			</div>');
		}

		// Redirect kembali ke halaman keranjang
		redirect('keranjang');
	}

	// Menampilkan halaman checkout
	public function checkout()
	{
		
		$data['payment_methods'] = ['COD', 'Transfer Bank'];
		$data['user'] = $this->modelUser->getUserBySession();
		// Ambil data keranjang dari session\
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

		// Load views
		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('keranjang/checkout', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	public function processCheckout2() 
	{
        $cart = $this->session->userdata('keranjang');
        if (!$cart) {
            $this->session->set_flashdata('error', 'Keranjang Anda kosong.');
            redirect('keranjang/index');
        }

        $order_data = [
            'id_user' => $this->session->userdata('id_user'),
            'total_harga' => array_sum(array_column($cart, 'subtotal')),
            'metode_pembayaran' => $this->input->post('payment_method'),
            'status_pembayaran' => 'Belum Bayar',
            'status_pesanan' => 'Diproses',
            'tanggal_order' => date('Y-m-d H:i:s')
        ];

        // Simpan data order dan dapatkan id_order
        $id_order = $this->modelKeranjang->insert_order($order_data);

        // Simpan data ke order_item
        foreach ($cart as $item) {
            $order_item_data = [
                'id_order' => $id_order,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga_produk']
            ];
            $this->modelKeranjang->insert_order_item($order_item_data);
        }

        // Jika metode bayar bukan COD, simpan ke tabel payment
        if ($order_data['metode_pembayaran'] === 'Transfer Bank') {
            $payment_data = [
                'id_order' => $id_order,
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'metode_bayar' => 'Transfer Bank',
                'status_bayar' => 'Menunggu Pembayaran'
            ];
            $this->modelKeranjang->insert_payment($payment_data);
        }

        // Kosongkan keranjang
        $this->session->unset_userdata('keranjang');
        $this->session->set_flashdata('success', 'Pesanan Anda berhasil diproses.');
        redirect('keranjang/index');
    }







	
	public function processCheckout() 
	{
		$cart = $this->session->userdata('keranjang');
		if (!$cart || empty($cart)) {
			$this->session->set_flashdata('error', 'Keranjang Anda kosong.');
			redirect('keranjang/index');
			return;
		}

		$payment_method = $this->input->post('payment_method');
		if (!$payment_method) {
			$this->session->set_flashdata('error', 'Metode pembayaran harus dipilih.');
			redirect('keranjang/index');
			return;
		}

		// Hitung total harga
		$total_harga = 0;
		foreach ($cart as $item) {
			$total_harga += $item['harga_produk'] * $item['jumlah'];
		}

		// Simpan data order ke database
		$order_data = [
			'id_user' => $this->session->userdata('id_user'),
			'total_harga' => $total_harga,
			'metode_pembayaran' => $payment_method,
			'status_pembayaran' => 'Belum Bayar',
			'status_pesanan' => 'Diproses',
			'tanggal_order' => date('Y-m-d H:i:s')
		];

		$id_order = $this->modelKeranjang->insert_order($order_data);

		// Simpan data ke order_item
		foreach ($cart as $item) {
			$order_item_data = [
				'id_order' => $id_order,
				'id_produk' => $item['id_produk'],
				'jumlah' => $item['jumlah'],
				'harga' => $item['harga_produk']
			];
			$this->modelKeranjang->insert_order_item($order_item_data);
		}

		// Data untuk request API Payment Gateway
		$transaction_details = [
			'order_id' => 'ORDER-' . $id_order,
			'gross_amount' => $total_harga
		];

		$customer_details = [
			'first_name' => $this->session->userdata('nama'),
			'email' => $this->session->userdata('email'),
			'phone' => $this->session->userdata('no_telp')
		];

		$items = [];
		foreach ($cart as $item) {
			$items[] = [
				'id' => $item['id_produk'],
				'price' => $item['harga_produk'],
				'quantity' => $item['jumlah'],
				'name' => $item['nama_produk']
			];
		}

		// Data payload untuk Payment Gateway
		$payload = [
			'transaction_details' => $transaction_details,
			'customer_details' => $customer_details,
			'item_details' => $items
		];

		// Kirim request ke API Payment Gateway
		$response = $this->sendToPaymentGateway($payload);

		// Tangani respons Payment Gateway
		if ($response['status_code'] === "201") {
			$payment_url = $response['redirect_url'];

			// Kosongkan keranjang
			$this->session->unset_userdata('keranjang');

			// Redirect ke halaman pembayaran
			redirect($payment_url);
		} else {
			$this->session->set_flashdata('error', 'Gagal memproses pembayaran.');
			redirect('keranjang/checkout');
		}
	}

	/**
	 * Fungsi untuk mengirim request ke Payment Gateway
	 */
	private function sendToPaymentGateway($payload)
	{
		$server_key = 'SB-Mid-server-xX70uHe3LF6wf9YFO-pHuWNv'; // Ganti dengan Server Key Anda
		$url = 'https://api.sandbox.midtrans.com/v2/charge'; // Ganti dengan URL API Payment Gateway

		$headers = [
			'Content-Type: application/json',
			'Authorization: Basic ' . base64_encode($server_key . ':')
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result, true);
	}



}