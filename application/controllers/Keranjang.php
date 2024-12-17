<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {
	
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
        redirect($_SERVER['HTTP_REFERER']);
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
		// Cek apakah user sudah login dan apakah levelnya admin
        if (!$this->session->userdata('username')) {
            // Redirect ke halaman login jika tidak memenuhi syarat
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Login terlebih dahulu!
			</div>');
            redirect('auth');
        }
		
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

	public function orders() 
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$id_user = $data['user']['id_user'];
		// Ambil semua data orders termasuk items
		$data['orders'] = $this->modelKeranjang->get_orders_by_user($id_user);

		// Load view dan kirim data orders
		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('keranjang/orders', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	public function recentProduk() {
        // Ambil id_user dari session atau parameter
        $data['user'] = $this->modelUser->getUserBySession(); // Mengambil id_user dari session

		// Ambil data produk yang pernah dibeli
		$data['recent_products'] = $this->modelProduk->get_recent_products();

		// Load view dan kirim data orders
		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('keranjang/recent', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	


	

}