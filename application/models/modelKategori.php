<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelKategori extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id_kategori', 'DESC');
    return $this->db->get('kategori')->result_array();
  }

  public function tambah()
  {
    $data = [
      "nama_kategori" => $this->input->post('nama_kategori', true),
      "keterangan_kategori" => $this->input->post('keterangan_kategori', true)
    ];

    $this->db->insert('kategori', $data);
  }

  public function edit($id_kategori)
  {
    $data = [
      "nama_kategori" => $this->input->post('nama_kategori', true),
      "keterangan_kategori" => $this->input->post('keterangan_kategori', true)
    ];

    $this->db->where('id_kategori', $id_kategori);
    $this->db->update('kategori', $data);
  }
  
  public function hapus($id_kategori)
  {
    $this->db->delete('kategori', ['id_kategori' => $id_kategori]);
  }

}