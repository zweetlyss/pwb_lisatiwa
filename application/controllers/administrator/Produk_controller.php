<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    private function _alert($pesan, $tipe = 'success') {
        $html = '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">' .
                    $pesan .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
                </div>';
        $this->session->set_flashdata('pesan', $html);
    }

    // 1. TAMPILKAN SEMUA PRODUK
    public function index() {
        $data['title']  = 'Data Produk';
        $data['produk'] = $this->Produk_model->get_all_produk();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // 2. TAMBAH PRODUK
    public function tambah_produk() {
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('categori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title']    = 'Tambah Produk';
            $data['kategori'] = $this->db->get('kategori')->result_array();

            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        } else {
            $data_insert = [
                'nama'        => $this->input->post('nama', TRUE),
                'deskripsi'   => $this->input->post('deskripsi', TRUE),
                'categori_id' => $this->input->post('categori_id', TRUE),
                'harga'       => $this->input->post('harga', TRUE),
                'stok'        => $this->input->post('stok', TRUE)
            ];

            if ($this->Produk_model->insert_produk($data_insert)) {
                $this->_alert('Berhasil menambahkan produk.');
            } else {
                $this->_alert('Gagal menambahkan produk.', 'danger');
            }
            redirect('admin/produk');
        }
    }

    // 3. UBAH PRODUK & UNGGAH GAMBAR (SESUAI TUGAS MODUL)
    public function ubah_produk($id) {
        $produk = $this->Produk_model->get_produk_by_id($id);
        if (!$produk) {
            $this->_alert('Data produk tidak ditemukan.', 'danger');
            redirect('admin/produk');
        }

        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('categori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title']   = 'Ubah Produk';
            $data['produk']  = $produk;
            $data['kategori']= $this->db->get('kategori')->result_array();
            $data['gambar']  = $this->Produk_model->get_gambar_by_produk($id);

            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/produk/ubah_produk', $data);
            $this->load->view('administrator/templates/footer');
        } else {
            // Update data teks produk
            $data_update = [
                'nama'        => $this->input->post('nama', TRUE),
                'deskripsi'   => $this->input->post('deskripsi', TRUE),
                'categori_id' => $this->input->post('categori_id', TRUE),
                'harga'       => $this->input->post('harga', TRUE),
                'stok'        => $this->input->post('stok', TRUE)
            ];
            $this->Produk_model->update_produk($id, $data_update);

            // Unggah gambar baru jika dipilih
            if (!empty($_FILES['nama_gambar']['name'])) {
                $config['upload_path']   = './uploads/produk/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']      = 2048;
                $config['file_name']     = 'prod_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('nama_gambar')) {
                    $fileData = $this->upload->data();
                    $data_gambar = [
                        'produk_id'   => $id,
                        'nama_gambar' => $fileData['file_name']
                    ];
                    $this->Produk_model->insert_gambar($data_gambar);
                } else {
                    $this->_alert('Berhasil memperbarui data produk.');
                    redirect('admin/produk'); // <-- Diubah ke 'admin/produk' agar otomatis kembali ke daftar produk
                }
            }
            $this->_alert('Berhasil memperbarui data produk.');
            redirect('admin/produk'); // <-- Diubah ke 'admin/produk' agar otomatis kembali ke daftar produk
        }
    }

    // 4. HAPUS PRODUK
    public function hapus_produk($id) {
        if ($this->Produk_model->delete_produk($id)) {
            $this->_alert('Berhasil menghapus produk.');
        } else {
            $this->_alert('Gagal menghapus produk.', 'danger');
        }
        redirect('admin/produk');
    }

    // 5. HAPUS GAMBAR INDIVIDUAL
    public function hapus_gambar_produk($id_gambar) {
        $gambar = $this->Produk_model->get_gambar_by_id($id_gambar);
        if ($gambar) {
            $produk_id = $gambar['produk_id'];
            $this->Produk_model->delete_gambar($id_gambar);
            $this->_alert('Gambar berhasil dihapus.');
            redirect('admin/produk/ubah/' . $produk_id);
        } else {
            redirect('admin/produk');
        }
    }
}