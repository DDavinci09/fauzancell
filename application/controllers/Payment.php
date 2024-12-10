<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Midtrans\Snap;
use Midtrans\Config;

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Midtrans config
        $this->load->config('midtrans');

        // Set Midtrans configuration
        Config::$serverKey = $this->config->item('midtrans_server_key');
        Config::$clientKey = $this->config->item('midtrans_client_key');
        Config::$isProduction = $this->config->item('midtrans_is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index() {
        // Data transaksi
        $transaction_details = [
            'order_id' => uniqid(), // Order ID unik
            'gross_amount' => 200000, // Total transaksi dalam rupiah
        ];

        // Data item (opsional)
        $item_details = [
            [
                'id' => 'item1',
                'price' => 80000,
                'quantity' => 1,
                'name' => 'Produk A',
            ],
            [
                'id' => 'item2',
                'price' => 120000,
                'quantity' => 1,
                'name' => 'Produk B',
            ],
        ];

        // Data pelanggan (opsional)
        $customer_details = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone' => '08123456789',
        ];

        // Gabungkan semua data ke parameter Snap
        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        // Buat token Snap
        try {
            $snapToken = Snap::getSnapToken($params);
            $data['snap_token'] = $snapToken; // Kirim token ke view
            $this->load->view('payment_view', $data);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function create_payment_link() {
    // Data transaksi
    $transaction_details = [
        'order_id' => uniqid(), // Order ID unik
        'gross_amount' => 200000, // Total transaksi dalam rupiah
    ];

    // Data item (opsional)
    $item_details = [
        [
            'id' => 'item1',
            'price' => 80000,
            'quantity' => 1,
            'name' => 'Produk A',
        ],
        [
            'id' => 'item2',
            'price' => 120000,
            'quantity' => 1,
            'name' => 'Produk B',
        ],
    ];

    // Data pelanggan (opsional)
    $customer_details = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@example.com',
        'phone' => '08123456789',
    ];

    // Gabungkan semua data ke parameter Snap
    $params = [
        'transaction_details' => $transaction_details,
        'item_details' => $item_details,
        'customer_details' => $customer_details,
    ];

    // Buat transaksi dan ambil redirect_url
    try {
        $transaction = \Midtrans\Snap::createTransaction($params);
        $payment_url = $transaction->redirect_url; // URL virtual pembayaran
        echo "Link Pembayaran: <a href='{$payment_url}' target='_blank'>{$payment_url}</a>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


    // Method to create payment
    public function create_payment() {
        $transaction_details = array(
            'order_id' => 'ORDER12345',
            'gross_amount' => 100000, // Amount in IDR
        );

        $customer_details = array(
            'first_name'    => 'Budi',
            'last_name'     => 'Santoso',
            'email'         => 'budi@example.com',
            'phone'         => '081234567890',
        );

        // Prepare the transaction data
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );

        // Get Snap URL
        try {
            $snap_token = Snap::getSnapToken($transaction_data);
            echo json_encode(['snap_token' => $snap_token]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}