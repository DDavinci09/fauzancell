<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Midtrans');
    }

    public function createTransaction() {
        // Contoh parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . rand(),
                'gross_amount' => 200000, // Total pembayaran
            ],
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
                'phone' => '08123456789',
            ],
        ];

        // Dapatkan token Snap
        $snapToken = $this->midtrans->getSnapToken($params);

        // Kirim token ke view
        $data['snapToken'] = $snapToken;
        $this->load->view('payment', $data);
    }
}