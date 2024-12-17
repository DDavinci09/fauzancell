<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$data['user'] = $this->modelUser->getUserBySession();

		$this->load->view('layoutHome/header', $data);
		$this->load->view('layoutHome/navbar', $data);
		$this->load->view('home/userprofile', $data);
		$this->load->view('layoutHome/footer', $data);
	}

	public function editProfile()
    {
        $data['user'] = $this->modelUser->getUserBySession();
        
        $data = [
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'no_telp' => $this->input->post('no_telp', true),
            'alamat' => $this->input->post('alamat', true)
        ];
        // Update data di database
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user', $data);
        
		$this->session->set_flashdata('message', 'Data Profile berhasil di Update!');
        redirect('User/index');
    }

	public function editUsernamePassword()
    {
		$data['user'] = $this->modelUser->getUserBySession();
		
        // Validasi form input
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
                'is_unique' => 'This username has already registered!'
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Passwords do not match!',
                'min_length' => 'Password is too short!'
            ]);
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan modal kembali dengan error
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $username = $this->input->post('username');
            $new_password = $this->input->post('password1');

            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];

            // Update data di database
            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->update('user', $data);

            $this->session->set_userdata($data);

            $this->session->set_flashdata('message', 'Data Username & Password berhasil di Update!');
        }
		
		redirect('User/index');
    }
}