<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Rak extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_rak');
        if ($id == '') {
            $this->db->select('id_rak, nama_rak');
            $this->db->from('tbl_rak');
            $rak = $this->db->get()->result();
        } else {
            $this->db->select('id_rak, nama_rak');
            $this->db->from('tbl_rak');
            $rak = $this->db->get()->result();
        }
        $this->response($rak, 200);
    }

    function index_post()
    {
        $id = $this->get('id_rak');
        $data = array(
            'nama_rak' => $this->post('nama_rak')
        );
        $insert = $this->db->insert('tbl_rak', $data);
        if($id){
            $this->response(['status' => 'fail', 'message' => 'id tidak boleh !', 'data' => $data], 502);
        }
        elseif ($insert) {
            $this->response(['status' => 'success', 'message' => 'rak Berhasil Ditambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_rak');
        $data = array(
            'nama_rak' => $this->put('nama_rak')
        );
        $this->db->where('id_rak', $id);
        $update = $this->db->update('tbl_rak', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'rak UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_rak');
        $this->db->where('id_rak', $id);
        $delete = $this->db->delete('tbl_rak');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'rak has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
