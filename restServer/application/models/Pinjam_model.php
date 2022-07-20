<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Pinjam_Model extends CI_Model
{
    private $_tabel_pinjam = 'tbl_pinjam';

    public function DataPinjam($id)
    {
        if (!$id) {
            $this->db->select('p.pinjam_id, p.status, p.lama_pinjam, p.tgl_pinjam, p.lama_pinjam, p.tgl_kembali, b.title, l.nama');
            $this->db->from('tbl_pinjam p');
            $this->db->join('tbl_buku b ', 'b.buku_id=p.buku_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $pinjaman = $this->db->get()->result();
        } else {
            $this->db->where('p.pinjam_id', $id);
            $this->db->select('p.pinjam_id, p.status, p.lama_pinjam, p.tgl_pinjam, p.lama_pinjam, p.tgl_kembali, b.title, l.nama');
            $this->db->from('tbl_pinjam p');
            $this->db->join('tbl_buku b ', 'b.buku_id=p.buku_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $pinjaman = $this->db->get('tbl_pinjam')->result();
        }
        return $pinjaman;
    }
    //fungsi untuk menambahkan data
    public function insertPinjam($data)
    {
        $this->db->insert($this->_table_mhs, $data);
        return $this->db->affected_rows();
    }
    //fungsi untuk mengubah data
    public function updateMahasiswa($data, $npm)
    {
        $this->db->update($this->_table_mhs, $data, ['npm' => $npm]);
        return $this->db->affected_rows();
    }
    //fungsi untuk menghapus data
    public function deleteMahasiswa($npm)
    {
        $this->db->delete($this->_table_mhs, ['npm' => $npm]);
        return $this->db->affected_rows();
    }
    }
?>