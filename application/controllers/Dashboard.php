<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['buku'] = $this->admin->count('buku');
        $data['buku_masuk'] = $this->admin->count('buku_masuk');
        $data['buku_keluar'] = $this->admin->count('buku_keluar');
        $data['stok'] = $this->admin->sum('buku', 'stok');
        $data['buku_min'] = $this->admin->min('buku', 'stok', 10);
        // $data['transaksi'] = [
        //     'buku_masuk' => $this->admin->getBukuMasuk(5),
        //     'buku_keluar' => $this->admin->getBukuKeluar(5)
        // ];

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
