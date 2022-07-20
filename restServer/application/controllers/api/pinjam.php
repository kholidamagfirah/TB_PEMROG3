<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Pinjam extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $status = $this->get('status');
        $pinjam_id = $this->get('pinjam_id');
        if ($status == '' AND $pinjam_id == '') {
            $this->db->select('p.pinjam_id, p.buku_id, p.anggota_id, p.status, p.lama_pinjam, p.tgl_pinjam,p.tgl_balik, p.lama_pinjam, p.tgl_kembali, b.title, l.nama');
            $this->db->from('tbl_pinjam p');
            $this->db->join('tbl_buku b ', 'b.buku_id=p.buku_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $pinjaman = $this->db->get()->result();
        } elseif($status) {
            $this->db->select('p.pinjam_id, p.buku_id, p.anggota_id, p.status, p.lama_pinjam, p.tgl_pinjam,p.tgl_balik, p.lama_pinjam, p.tgl_kembali, b.title, l.nama');
            $this->db->from('tbl_pinjam p');
            $this->db->join('tbl_buku b ', 'b.buku_id=p.buku_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $this->db->where('p.status', $status);
            $pinjaman = $this->db->get()->result();
        }elseif($pinjam_id){
            $this->db->select('p.pinjam_id,p.buku_id, p.anggota_id, p.status, p.lama_pinjam, p.tgl_pinjam,p.tgl_balik, p.lama_pinjam, p.tgl_kembali, b.title, l.nama');
            $this->db->from('tbl_pinjam p');
            $this->db->join('tbl_buku b ', 'b.buku_id=p.buku_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $this->db->where('p.pinjam_id', $pinjam_id);
            $pinjaman = $this->db->get()->result();
        }
        $this->response($pinjaman, 200);
    }

    function pinjamanBuku_get()
    {
        $buku_id = $this->get('buku_id');
        $multiClause = array('buku_id' => $buku_id, 'status' => 'dipinjam' );
        $this->db->select('*');
        $this->db->from('tbl_pinjam p');
        $this->db->where($multiClause);
        $pinjamanBuku = $this->db->get()->result();
        $this->response($pinjamanBuku, 200);
    }


    function kembalianBuku_get()
    {
        $pinjam_id = $this->get('pinjam_id');
        $multiClause = array('pinjam_id' => $pinjam_id, 'status' => 'dikembalikan' );
        $this->db->select('*');
        $this->db->from('tbl_pinjam p');
        $this->db->where($multiClause);
        $pinjamanBuku = $this->db->get()->result();
        $this->response($pinjamanBuku, 200);
    }

    function index_post()
    {
        $id = $this->get('pinjam_id');
        $data = array(
            'pinjam_id' =>  $this->post('pinjam_id'),
            'anggota_id' => $this->post('anggota_id'),
            'buku_id' => $this->post('buku_id'),
            'status' => $this->post('status'),
            'tgl_pinjam' => $this->post('tgl_pinjam'),
            'lama_pinjam' => $this->post('lama_pinjam'),
            'tgl_balik' => $this->post('tgl_balik'),
            'tgl_kembali' => $this->post('tgl_kembali')
        );
        $insert = $this->db->insert('tbl_pinjam', $data);
        if($id){
            $this->response(['status' => 'fail', 'message' => 'id tidak boleh !', 'data' => $data], 502);
        }
        elseif ($insert) {
            $this->response(['status' => 'success', 'message' => 'Pinjaman Berhasil Ditambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('pinjam_id');
        $data = array(
            'pinjam_id' => $this->put('pinjam_id'),
            'anggota_id' => $this->put('anggota_id'),
            'nama_buku' => $this->put('nama_buku'),
            'status' => $this->put('status'),
            'tgl_pinjam' => $this->put('tgl_pinjam'),
            'lama_pinjam' => $this->put('lama_pinjam'),
            'tgl_balik' => $this->put('tgl_balik'),
            'tgl_kembali' => $this->put('tgl_kembali')
        );
        $this->db->where('pinjam_id', $npm);
        $update = $this->db->update('tbl_pinjam', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Pinjaman UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('pinjam_id');
        $this->db->where('pinjam_id', $id);
        $delete = $this->db->delete('tbl_pinjam');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Pinjaman has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
