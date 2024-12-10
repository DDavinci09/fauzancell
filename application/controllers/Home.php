<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
		
	public function index()
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$data['produk'] = $this->modelProduk->getAll();

		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('layoutHome/footer', $data);
	}
	
	public function shop()
	{
		$data['user'] = $this->modelUser->getUserBySession();
		$data['produk'] = $this->modelProduk->getAll();

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
}