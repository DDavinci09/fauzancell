<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
		
	public function index()
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$data['produkBaru'] = $this->modelProduk->get_newproduk(8);
		$data['produkRecent'] = $this->modelProduk->get_recently_purchased_products(4);
		$data['kategori'] = $this->modelKategori->getAll();

		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('layoutHome/footer', $data);
	}
	
	public function shop()
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$data['produk'] = $this->modelProduk->getAll();
		$data['title'] = "Semua Produk";
        $data['totalproduk'] = count($data['produk']);

		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('home/shop', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	public function Pencarian()
    {
        $data['user'] = $this->modelUser->getUserBySession();
        $keyword = $this->input->get('keyword');
        
        $data['produk'] = $this->modelProduk->cariProduk($keyword);
        $data['totalproduk'] = count($data['produk']);
        $data['title'] = "Hasil Pencarian : " .$keyword;

        $this->load->view('layoutHome/header', $data);
        $this->load->view('layoutHome/navbar', $data);
        $this->load->view('home/shop', $data);
        $this->load->view('layoutHome/footer', $data);
    }    

	public function getKategoriProduk($id_kategori)
    {
		$data['user'] = $this->modelUser->getUserBySession();
        $data['nama_kategori'] = $this->modelKategori->getidKategori($id_kategori);
        $data['produk'] = $this->modelProduk->getKategoriProduk($id_kategori);
        $data['title'] = "Kategori : " . $data['nama_kategori']['nama_kategori'];
        $data['totalproduk'] = count($data['produk']);

        $this->load->view('layoutHome/header', $data);
        $this->load->view('layoutHome/navbar', $data);
        $this->load->view('home/shop', $data);
        $this->load->view('layoutHome/footer', $data);
    }
	
	public function produk($id_produk)
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$data['item'] = $this->modelProduk->getProdukId($id_produk);

		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('home/produk', $data);
		$this->load->view('layoutHome/footer', $data);
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
        redirect('keranjang/orders');
    }
}