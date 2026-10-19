<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kategori_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('produk_kategori_model');
    }

    // ===================== READ =====================
    public function index()
    {
        $data['title'] = 'Kategori';
        $data['list_kategori'] = $this->produk_kategori_model->get_all();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // ===================== CREATE =====================
    public function tambah_kategori()
    {
        $data['title'] = 'Tambah Kategori';

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('deskripsi_kategori', 'Deskripsi', 'trim');

        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_kategori();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/kategori/tambah_kategori');
            $this->load->view('administrator/templates/footer');
        }
    }

    private function _simpan_kategori()
    {
        $data = [
            'nama'      => ucwords($this->input->post('nama_kategori', TRUE)),
            'deskripsi' => ucfirst($this->input->post('deskripsi_kategori', TRUE))
        ];

        if ($this->produk_kategori_model->tambah($data)) {
            $this->_alert('success', 'Berhasil menambahkan kategori!!');
        } else {
            $this->_alert('danger', 'Gagal menambahkan kategori!!');
        }
        redirect('admin/kategori');
    }

    // ===================== DELETE =====================
    public function hapus_kategori($id)
    {
        // cek apakah kategori dengan id tersebut ada
        $kategori = $this->produk_kategori_model->get_by_id($id);

        if ($kategori) {
            if ($this->produk_kategori_model->hapus($id)) {
                $this->_alert('success', 'Berhasil menghapus kategori!!');
            } else {
                $this->_alert('danger', 'Gagal menghapus kategori!!');
            }
        } else {
            $this->_alert('danger', 'Kategori tidak ditemukan!!');
        }
        redirect('admin/kategori');
    }

    // ===================== UPDATE =====================
    public function ubah_kategori($id)
    {
        // cek dulu apakah id dengan kategori ada
        $kategori = $this->produk_kategori_model->get_by_id($id);

        if ($kategori) {
            $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('deskripsi_kategori', 'Deskripsi', 'trim');

            if ($this->form_validation->run() !== FALSE) {
                $this->_ubah_kategori($id);
            } else {
                $data['title']    = 'Ubah Kategori';
                $data['kategori'] = $kategori;

                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/kategori/ubah_kategori', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->_alert('danger', 'Kategori tidak ditemukan!!');
            redirect('admin/kategori');
        }
    }

    private function _ubah_kategori($id)
    {
        $data = [
            'nama'      => ucwords($this->input->post('nama_kategori', TRUE)),
            'deskripsi' => ucfirst($this->input->post('deskripsi_kategori', TRUE))
        ];

        if ($this->produk_kategori_model->ubah($data, $id)) {
            $this->_alert('success', 'Berhasil mengubah kategori!!');
        } else {
            $this->_alert('danger', 'Gagal mengubah kategori!!');
        }
        redirect('admin/kategori');
    }

    // ===================== HELPER NOTIFIKASI =====================
    // Satu fungsi untuk semua pesan, supaya tidak menulis HTML alert berulang-ulang.
    private function _alert($type, $message)
    {
        $icon = ($type === 'success') ? 'fa-check-circle' : 'fa-exclamation-triangle';
        $this->session->set_flashdata('message', '
            <div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                <i class="fas ' . $icon . ' mr-2"></i>' . $message . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ');
    }
}
