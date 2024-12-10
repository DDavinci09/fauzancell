<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private function _Auth()
	{
		// Ambil input dari form
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// Cek apakah user ada berdasarkan username
		$user = $this->modelUser->getUserByUsername($username);

		// Jika usernya ada
		if ($user) {
			// Cek password
			if (password_verify($password, $user['password'])) {
				// Jika password benar, set session berdasarkan level
				$data = [
					'id_user' => $user['id_user'],
					'username' => $user['username'],
					'level' => $user['level'] // Level user langsung diambil dari database
				];

				// Set session
				$this->session->set_userdata($data);

				// Cek level dan redirect sesuai level
				if ($user['level'] == 'user') {
					// Jika level user
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Login berhasil, Selamat Datang User!
						</div>');
					redirect('User/index');
				} elseif ($user['level'] == 'admin') {
					// Jika level admin
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Login berhasil, Selamat Datang Admin!
						</div>');
					redirect('Admin/index');
				} else {
					// Jika level tidak dikenali (misalnya, alumni atau level lain yang tidak didefinisikan)
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Level user tidak dikenali!
						</div>');
					redirect('Auth');
				}
			} else {
				// Jika password salah
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Password salah!
					</div>');
				redirect('Auth');
			}
		} else {
			// Jika username tidak terdaftar
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Username tidak terdaftar!
				</div>');
			redirect('Auth');
		}
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layoutHome/authheader');
            $this->load->view('auth/index');
            $this->load->view('layoutHome/authfooter');
        } else {
            $this->_Auth();
        }
	}
	
	public function registerUser()
    {
        //Form Validation
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('layoutHome/authheader');
            $this->load->view('auth/registerUser');
            $this->load->view('layoutHome/authfooter');
        } else {
            $data = [
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'no_telp' => $this->input->post('no_telp', true),
                'alamat' => $this->input->post('alamat', true),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => "user",
                'status' => 0
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Anda Berhasil Dibuat!</div>');
            redirect('Auth');
        }
    }

	// Proses Logout
    public function logout()
    {
        session_destroy();
        // Hapus data sesi tanpa menghancurkan seluruh sesi
        // $this->session->unset_userdata($data);

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        Anda telah Logout!
        </div>');
        redirect('Home');
    }

	
}