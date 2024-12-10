<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelProduk extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id_produk', 'DESC');
    return $this->db->get('produk')->result_array();
  }

  public function getProdukId($id_produk)
  {
    return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
  }

  public function tambah()
  {
    $data = [
      "id_kategori" => $this->input->post('id_kategori', true),
      "nama_produk" => $this->input->post('nama_produk', true),
      "harga_produk" => $this->input->post('harga_produk', true),
      "stok_produk" => $this->input->post('stok_produk', true),
      "keterangan_produk" => $this->input->post('keterangan_produk', true),
      "create_at" => date('Y-m-d H:i:s'),
      "rating_produk" => 0
    ];

    $this->db->insert('produk', $data);
  }

  public function tambahfile($file)
  {
    $data = [
      "id_kategori" => $this->input->post('id_kategori', true),
      "nama_produk" => $this->input->post('nama_produk', true),
      "harga_produk" => $this->input->post('harga_produk', true),
      "stok_produk" => $this->input->post('stok_produk', true),
      "keterangan_produk" => $this->input->post('keterangan_produk', true),
      "create_at" => date('Y-m-d H:i:s'),
      "image" => $file['file_name'],
      "rating_produk" => 0
    ];

    $this->db->insert('produk', $data);
  }
  
  public function editfile($id_produk, $newFile)
  {
    $data = [
      "id_kategori" => $this->input->post('id_kategori', true),
      "nama_produk" => $this->input->post('nama_produk', true),
      "harga_produk" => $this->input->post('harga_produk', true),
      "stok_produk" => $this->input->post('stok_produk', true),
      "keterangan_produk" => $this->input->post('keterangan_produk', true),
      "create_at" => date('Y-m-d H:i:s'),
      "image" => $newFile,
      "rating_produk" => 0
    ];

    $this->db->where('id_produk', $id_produk);
    $this->db->update('produk', $data);
  }
  
  public function edit($id_produk)
  {
    $data = [
      "id_kategori" => $this->input->post('id_kategori', true),
      "nama_produk" => $this->input->post('nama_produk', true),
      "harga_produk" => $this->input->post('harga_produk', true),
      "stok_produk" => $this->input->post('stok_produk', true),
      "keterangan_produk" => $this->input->post('keterangan_produk', true),
      "create_at" => date('Y-m-d H:i:s'),
      "rating_produk" => 0
    ];

    $this->db->where('id_produk', $id_produk);
    $this->db->update('produk', $data);
  }

  public function hapus($id_produk)
  {
    $this->db->delete('produk', ['id_produk' => $id_produk]);
  }
  
  

}