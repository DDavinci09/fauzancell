<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Midtrans\Config;
use Midtrans\Snap;

class Midtrans {

    public function __construct() {
        // Load konfigurasi Midtrans dari config
        $CI =& get_instance();
        $CI->config->load('midtrans');

        // Setup Midtrans
        Config::$serverKey = $CI->config->item('midtrans_server_key');
        Config::$isProduction = $CI->config->item('midtrans_is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken($params) {
        try {
            return Snap::getSnapToken($params);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}