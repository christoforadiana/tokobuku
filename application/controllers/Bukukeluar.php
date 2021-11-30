<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bukukeluar extends CI_Controller
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
        $data['title'] = "Buku keluar";
        $data['bukukeluar'] = $this->admin->getBukukeluar();
        $this->template->load('templates/dashboard', 'buku_keluar/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('buku_id', 'Buku', 'required');

        $input = $this->input->post('buku_id', true);
        $stok = $this->admin->get('buku', ['id_buku' => $input])['stok'];
        $stok_valid = $stok + 1;

        $this->form_validation->set_rules(
            'jumlah_keluar',
            'Jumlah Keluar',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
            ]
        );
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Buku Keluar";
            $data['buku'] = $this->admin->get('buku', null, ['stok >' => 0]);

            // Mendapatkan dan men-generate kode transaksi buku keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('buku_keluar', 'id_buku_keluar', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_buku_keluar'] = $kode . $number;

            $this->template->load('templates/dashboard', 'buku_keluar/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('buku_keluar', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('bukukeluar');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('bukukeluar/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('buku_keluar', 'id_buku_keluar', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('bukukeluar');
    }
}
