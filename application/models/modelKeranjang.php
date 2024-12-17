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

  public function getOrderId($order_id)
  {
    return $this->db->get_where('orders', ['id_order' => $order_id])->row_array();
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

    // Model: Orders_model.php
    public function get_order_by_id($id_order) {
        // Ambil data order
        $this->db->from('orders');
        $this->db->join('user', 'user.id_user = orders.id_user');
        $this->db->where('orders.id_order', $id_order);
        $query = $this->db->get();
        $order = $query->row_array();

        // Ambil data item untuk order ini
        if ($order) {
            $order['items'] = $this->get_order_items($id_order);
        }

        return $order;
    }

    // Ambil semua orders untuk admin
    public function get_all_orders() {
        $this->db->from('orders');
        $this->db->join('user', 'user.id_user = orders.id_user');
        $this->db->order_by('tanggal_order', 'DESC');
        $query = $this->db->get();

        $orders = $query->result_array();

        // Ambil order_item untuk setiap order
        foreach ($orders as &$order) {
            $order['items'] = $this->get_order_items($order['id_order']);
        }

        return $orders;
    }
    
    // Ambil semua orders berdasarkan id_user
    public function get_orders_by_user($id_user) {
        $this->db->from('orders');
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal_order', 'DESC');
        $query = $this->db->get();

        $orders = $query->result_array();

        // Ambil order_item untuk setiap order
        foreach ($orders as &$order) {
            $order['items'] = $this->get_order_items($order['id_order']);
        }

        return $orders;
    }

    // Ambil order items berdasarkan id_order
    public function get_order_items($id_order) {
        $this->db->select('produk.nama_produk, order_item.jumlah, order_item.harga');
        $this->db->from('order_item');
        $this->db->join('produk', 'produk.id_produk = order_item.id_produk');
        $this->db->where('order_item.id_order', $id_order);
        $query = $this->db->get();

        return $query->result_array();
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
    }

    public function get_total_pendapatan() {
    // Membuat query untuk menghitung total pendapatan dari kolom total_harga di tabel orders
    $this->db->select_sum('orders.total_harga', 'total_pendapatan');  // Menjumlahkan total_harga di tabel orders
    $this->db->from('orders');
    $this->db->where('orders.status_pesanan', 'Selesai');  // Hanya pesanan dengan status selesai
    $this->db->where('orders.id_user', $this->session->userdata('id_user'));  // Untuk pengguna yang sedang login
    $query = $this->db->get();

    // Mengambil hasil dan mengembalikan total pendapatan
    $result = $query->row();
    return $result->total_pendapatan;
}

    

}