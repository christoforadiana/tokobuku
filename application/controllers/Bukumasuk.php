<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bukumasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Buku Masuk";
        $data['bukumasuk'] = $this->admin->getBukuMasuk();
        $this->template->load('templates/dashboard', 'buku_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('buku_id', 'Buku', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Buku Masuk";
            $data['buku'] = $this->admin->get('buku');

            // Mendapatkan dan men-generate kode transaksi buku masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('buku_masuk', 'id_buku_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_buku_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'buku_masuk/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('buku_masuk', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('bukumasuk');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('bukumasuk/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('buku_masuk', 'id_buku_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('bukumasuk');
    }
}
