<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelUser extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id_user', 'DESC');
    return $this->db->get('user')->result_array();
  }

  // Fungsi untuk mendapatkan user berdasarkan username
  public function getUserByUsername($username)
  {
    // Menggunakan query builder untuk memilih data berdasarkan username
    $this->db->where('username', $username);
    $query = $this->db->get('user'); // Nama tabel user

    // Mengembalikan hasil query jika ada data
    if ($query->num_rows() > 0) {
        return $query->row_array(); // Mengambil satu baris data
    } else {
        return null; // Jika tidak ada data
    }
  }

  // Fungsi untuk mengambil data pengguna berdasarkan username yang ada di sesi
  public function getUserBySession()
  {
    // Ambil username dari sesi
    $username = $this->session->userdata('username');

    // Cek apakah username tersedia di sesi
    if ($username) {
        // Mengambil data pengguna dari tabel user berdasarkan username
        $this->db->where('username', $username);
        $query = $this->db->get('user'); // Nama tabel user

        // Periksa apakah data pengguna ditemukan
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan satu baris data pengguna
        } else {
            return null; // Tidak ada data pengguna ditemukan
        }
    } else {
        return false; // Tidak ada sesi
    }
  }

  public function hapus($id_user)
  {
    $this->db->delete('user', ['id_user' => $id_user]);
  }
  
  
}