<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
        $data['title'] = "Buku";
        $data['buku'] = $this->admin->getBuku();
        $this->template->load('templates/dashboard', 'buku/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Buku";

            // Mengenerate ID Buku
            $kode_terakhir = $this->admin->getMax('buku', 'id_buku');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_buku'] = 'B' . $number;
            // $data['id_buku'] = $this->admin->get('buku', 'id_buku');

            $this->template->load('templates/dashboard', 'buku/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('buku', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('buku');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('buku/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Buku";
            $data['buku'] = $this->admin->get('buku', ['id_buku' => $id]);
            $this->template->load('templates/dashboard', 'buku/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('buku', 'id_buku', $id, $input);

            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('buku');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('buku/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('buku', 'id_buku', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('buku');
    }

}
