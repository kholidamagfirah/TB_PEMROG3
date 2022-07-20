<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Kategori extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_kategori');
        if ($id == '') {
            $this->db->select('id_kategori, nama_kategori');
            $this->db->from('tbl_kategori');
            $kategori = $this->db->get()->result();
        } else {
            $this->db->select('id_kategori, nama_kategori');
            $this->db->from('tbl_kategori');
            $kategori = $this->db->get()->result();
        }
        $this->response($kategori, 200);
    }

    function index_post()
    {
        $id = $this->get('id_kategori');
        $data = array(
            'nama_kategori' => $this->post('nama_kategori')
        );
        $insert = $this->db->insert('tbl_kategori', $data);
        if($id){
            $this->response(['status' => 'fail', 'message' => 'id tidak boleh !', 'data' => $data], 502);
        }
        elseif ($insert) {
            $this->response(['status' => 'success', 'message' => 'kategori Berhasil Ditambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_kategori');
        $data = array(
            'nama_kategori' => $this->put('nama_kategori')
        );
        $this->db->where('id_kategori', $id);
        $update = $this->db->update('tbl_kategori', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'kategori UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_kategori');
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('tbl_kategori');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'kategori has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
