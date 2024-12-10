<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelKeranjang extends CI_Model
{
  // Menambahkan produk ke dalam keranjang
  public function tambah_ke_keranjang($produk_id, $jumlah)
  {
      // Mengambil data produk berdasarkan id_produk
      $this->db->where('id_produk', $produk_id);
      $query = $this->db->get('produk');
      $produk = $query->row_array();

      // Menambahkan produk ke session keranjang
      $keranjang = $this->session->userdata('keranjang');
      if (!$keranjang) {
          $keranjang = [];
      }

      // Memeriksa apakah produk sudah ada dalam keranjang
      $produk_ditemukan = false;
      foreach ($keranjang as &$item) {
          if ($item['id_produk'] == $produk_id) {
              // Update jumlah produk jika sudah ada di keranjang
              $item['jumlah'] += $jumlah;
              $produk_ditemukan = true;
              break;
          }
      }

      // Jika produk belum ada di keranjang, tambahkan produk baru
      if (!$produk_ditemukan) {
          $keranjang[] = [
              'id_produk' => $produk_id,
              'nama_produk' => $produk['nama_produk'],
              'harga_produk' => $produk['harga_produk'],
              'jumlah' => $jumlah,
              'image' => $produk['image']
          ];
      }

      // Simpan kembali data keranjang ke session
      $this->session->set_userdata('keranjang', $keranjang);
  }


  public function insert_order($data) {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function insert_order_item($data) {
        $this->db->insert('order_item', $data);
    }

    public function insert_payment($data) {
        $this->db->insert('payment', $data);
    }

}