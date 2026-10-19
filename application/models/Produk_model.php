<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function get_all_produk() {
        $this->db->select('produk.*, kategori.nama AS nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->order_by('produk.id_produk', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function update_produk($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('produk', $data);
    }

    public function delete_produk($id) {
        // Hapus fisik file gambar terkait dari server
        $gambar = $this->db->get_where('produk_gambar', ['produk_id' => $id])->result_array();
        foreach ($gambar as $g) {
            if (file_exists('./assets/images/produk/' . $g['nama_gambar'])) {
                unlink('./assets/images/produk/' . $g['nama_gambar']);
            }
        }
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

    // --- FITUR PRODUK GAMBAR ---
    public function get_gambar_by_produk($produk_id) {
        return $this->db->get_where('produk_gambar', ['produk_id' => $produk_id])->result_array();
    }

    public function get_gambar_by_id($id_gambar) {
        return $this->db->get_where('produk_gambar', ['id_gambar' => $id_gambar])->row_array();
    }

    public function insert_gambar($data) {
        return $this->db->insert('produk_gambar', $data);
    }

    public function update_gambar($id_gambar, $data) {
        $this->db->where('id_gambar', $id_gambar);
        return $this->db->update('produk_gambar', $data);
    }

    public function delete_gambar($id_gambar) {
        $gambar = $this->get_gambar_by_id($id_gambar);
        if ($gambar && file_exists('./assets/images/produk/' . $gambar['nama_gambar'])) {
            unlink('./assets/images/produk/' . $gambar['nama_gambar']);
        }
        $this->db->where('id_gambar', $id_gambar);
        return $this->db->delete('produk_gambar');
    }
}