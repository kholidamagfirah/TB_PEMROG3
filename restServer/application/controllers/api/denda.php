<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Denda extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $nama = $this->get('nama');
        if ($nama == '') {
            $this->db->select('d.denda, d.lama_waktu, d.tgl_denda, l.nama, l.alamat');
            $this->db->from('tbl_denda d');
            $this->db->join('tbl_pinjam p', 'd.pinjam_id=p.pinjam_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $denda = $this->db->get()->result();
        } elseif(!$nama) {
            $this->response(array('Message' => 'Data Tidak Ditemukan', 400));
        }else{
            $this->db->where('nama', $nama);
            $this->db->select('d.denda, d.lama_waktu, d.tgl_denda, l.nama, l.alamat');
            $this->db->from('tbl_denda d');
            $this->db->join('tbl_pinjam p', 'd.pinjam_id=p.pinjam_id');
            $this->db->join('tbl_login l', 'p.anggota_id=l.anggota_id');
            $denda = $this->db->get()->result();
        }
        $this->response($denda, 200);
    }
    function index_post()
    {
        $data = array(
            'pinjam_id' => $this->post('pinjam_id'),
            'denda' => $this->post('denda'),
            'lama_waktu' => $this->post('lama_waktu'),
            'tgl_denda' => $this->post('tgl_denda')
        );
        $insert = $this->db->insert('tbl_denda', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_transaksi');
        $data = array(
            'id_denda' => $this->put('id_denda'),
            'pinjam_id' => $this->put('pinjam_id'),
            'denda' => $this->put('denda'),
            'lama_waktu' => $this->put('lama_waktu'),
            'tgl_denda' => $this->put('tgl_denda')
        );
        $this->db->where('id_denda', $npm);
        $update = $this->db->update('tbl_denda', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Denda UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_denda');
        $this->db->where('id_denda', $id);
        $delete = $this->db->delete('tbl_denda');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Denda has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
