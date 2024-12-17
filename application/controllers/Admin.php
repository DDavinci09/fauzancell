<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        // Cek apakah user sudah login dan apakah levelnya admin
        if ($this->session->userdata('level') !== 'admin') {
            // Redirect ke halaman login jika tidak memenuhi syarat
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Login sebagai Admin!
			</div>');
            redirect('auth');
        }
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['users'] = $this->modelUser->getAll();
		$data['kategori'] = $this->modelKategori->getAll();
		$data['produk'] = $this->modelProduk->getAll();
		$data['orders'] = $this->modelKeranjang->get_all_orders();
		$data['profit'] = $this->modelKeranjang->get_total_pendapatan();


		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}
	
	public function v_users()
	{
		$data['title'] = "User";
		$data['user'] = $this->modelUser->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	public function hapus_users($id_user)
	{
		$this->modelUser->hapus($id_user);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		Data User Berhasil Dihapus!
		</div>');
		redirect('Admin/v_users');
	}
	
	public function v_kategori()
	{
		$data['title'] = "Kategori";
		$data['kategori'] = $this->modelKategori->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('kategori/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}
	
	public function tambah_kategori()
	{
		$this->modelKategori->tambah();
		$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
		Data Kategori Berhasil Ditambahkan!
		</div>');
		redirect('Admin/v_kategori');
	}
	
	public function edit_kategori($id_kategori)
	{
		$this->modelKategori->edit($id_kategori);
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
		Data Kategori Berhasil Diedit!
		</div>');
		redirect('Admin/v_kategori');
	}
	
	public function hapus_kategori($id_kategori)
	{
		$this->modelKategori->hapus($id_kategori);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		Data Kategori Berhasil Dihapus!
		</div>');
		redirect('Admin/v_kategori');
	}
	
	public function v_produk()
	{
		$data['title'] = "Produk";
		$data['kategori'] = $this->modelKategori->getAll();
		$data['produk'] = $this->modelProduk->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('produk/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	public function tambah_produk()
	{
		//konfigurasi upload file
		$config['upload_path'] = './assets/upload/produk';
		$config['allowed_types'] = 'jpg|jpeg|png|PNG';
		$config['max_size'] = '5000';

		$this->load->library('upload', $config);

		//Initiaze config upload
		$this->upload->initialize($config);

		if ($this->upload->do_upload('image')) {
			$this->modelProduk->tambahfile($this->upload->data());
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Produk Berhasil Ditambahkan!
			</div>');
			redirect('Admin/v_produk');
		}
	}

	public function edit_produk($id_produk)
	{
		// Ambil data produk lama berdasarkan ID
		$data['produk'] = $this->modelProduk->getProdukId($id_produk);

		// Konfigurasi upload file
		$config['upload_path'] = './assets/upload/produk/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 5000;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		// Proses upload file baru
		if ($this->upload->do_upload('image')) {
			$uploadData = $this->upload->data(); // Ambil data file baru
			$newFile = $uploadData['file_name'];

			// Hapus file lama jika ada
			$oldFile = './assets/upload/produk/' . $data['produk']['image'];
			if (is_readable($oldFile) && file_exists($oldFile)) {
				unlink($oldFile);
			}

			// Perbarui data produk dengan file baru
			$this->modelProduk->editfile($id_produk, $newFile);
			
		} else {
			// Jika upload file gagal atau tidak ada file baru
			if ($this->upload->display_errors() !== '') {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Error Upload: ' . $error . '
				</div>');
			}

			// Tetap perbarui data produk tanpa file baru
			$this->modelProduk->edit($id_produk);

		}
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			Data Produk Berhasil Diperbaharui!
		</div>');

		// Redirect ke halaman produk
		redirect('Admin/v_produk');
	}

	public function hapus_produk($id_produk)
	{
		// Ambil data produk berdasarkan ID
		$data['produk'] = $this->modelProduk->getProdukId($id_produk);
		$filePath = './assets/upload/produk/' . $data['produk']['image'];

		// Cek apakah file gambar ada dan bisa dibaca
		if (file_exists($filePath) && is_readable($filePath)) {
			if (unlink($filePath)) {
				// Jika file berhasil dihapus
				$this->modelProduk->hapus($id_produk);
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Data Produk dan File Gambar Berhasil Dihapus!
				</div>');
			} else {
				// Jika file tidak bisa dihapus
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					File Gambar Tidak Bisa Dihapus, Tapi Data Produk Berhasil Dihapus!
				</div>');
			}
		} else {
			// Jika file tidak ditemukan
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				File Gambar Tidak Ditemukan, Tapi Data Produk Berhasil Dihapus!
			</div>');
		}

		// Tetap hapus data produk dari database
		$this->modelProduk->hapus($id_produk);

		// Redirect ke halaman produk
		redirect('Admin/v_produk');
	}

	
	public function v_order()
	{
		$data['title'] = "Orders";
		$data['orders'] = $this->modelKeranjang->get_all_orders();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('order/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	public function editStatusPesanan()
    {
		$status_pesanan = $this->input->post('status_pesanan');
        
        $data = [
        "status_pesanan" => $status_pesanan,
        "keterangan" => $this->input->post('keterangan', true)
        ];

        // Jika status selesai, tambahkan tanggal_diterima
        if ($status_pesanan == 'Selesai') {
            $data['tanggal_diterima'] = date('Y-m-d H:i:s'); // Waktu sekarang
        }

        $this->db->where('id_order', $this->input->post('id_order'));
        $this->db->update('orders', $data);
        // $this->modelKeranjang->editStatusPesanan();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Status Pesanan Berhasil Diperbaharui!
        </div>');
        redirect('Admin/v_order');
    }

	// Controller: AdminController.php
	public function print_order($id_order) {
		$data['order'] = $this->modelKeranjang->get_order_by_id($id_order);

		// Tampilkan halaman untuk mencetak
		$this->load->view('order/print_order', $data);
	}

}