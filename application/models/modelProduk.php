<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelProduk extends CI_Model
{
  public function getAll()
  {
    $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
    $this->db->order_by('id_produk', 'DESC');
    return $this->db->get('produk')->result_array();
  }
  
  public function get_newproduk($limit)
  {
    $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
    $this->db->order_by('id_produk', 'DESC');
    $this->db->limit($limit);
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

  public function get_recent_products() {
        $this->db->from('produk p');
        $this->db->join('order_item oi', 'p.id_produk = oi.id_produk');
        $this->db->join('orders o', 'oi.id_order = o.id_order');
        $this->db->where('o.id_user', $this->session->userdata('id_user'));
        $this->db->where('o.status_pesanan', 'Selesai');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_recently_purchased_products($limit) {
      $this->db->select('produk.id_produk, produk.nama_produk, produk.harga_produk, produk.stok_produk, produk.image, kategori.nama_kategori, MAX(orders.tanggal_order) as latest_order');
      $this->db->from('order_item');
      $this->db->join('orders', 'orders.id_order = order_item.id_order');
      $this->db->join('produk', 'produk.id_produk = order_item.id_produk');
      $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
      $this->db->where('orders.status_pesanan', 'Selesai');
      $this->db->where('orders.id_user', $this->session->userdata('id_user'));
      $this->db->group_by('produk.id_produk');
      $this->db->order_by('latest_order', 'DESC'); // Urutkan berdasarkan tanggal order terbaru
      $this->db->limit($limit); // Batasi hasil hanya 10 produk terbaru
      $query = $this->db->get();

      return $query->result_array();
  }





    public function getKategoriProduk($id_kategori)
  {
    $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
    $this->db->where('produk.id_kategori', $id_kategori);
    $this->db->order_by('id_produk', 'DESC');
    return $this->db->get('produk')->result_array();
  }

  public function cariProduk($keyword = null)
  {
    $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
    
    if ($keyword) {
        $this->db->like('produk.nama_produk', $keyword);
        $this->db->or_like('produk.keterangan_produk', $keyword);
        $this->db->or_like('kategori.nama_kategori', $keyword);
    }

    $this->db->order_by('produk.id_produk', 'DESC');
    
    return $this->db->get('produk')->result_array();
  }
  
  

}