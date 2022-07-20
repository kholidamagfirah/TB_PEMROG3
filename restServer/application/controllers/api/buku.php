<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Buku extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('buku_id');
        if ($id == '') {
            $this->db->select('b.buku_id, b.id_kategori, b.sampul, b.isbn, b.lampiran, b.title, b.penerbit, b.pengarang, b.thn_buku, b.isi, b.jml, b.tgl_masuk, r.nama_rak, k.nama_kategori');
            $this->db->from('tbl_buku b');
            $this->db->join('tbl_rak r', 'r.id_rak=b.id_rak');
            $this->db->join('tbl_kategori k', 'b.id_kategori=k.id_kategori');
            $buku = $this->db->get()->result();
        } else {
            $this->db->where('buku_id', $id);
            $this->db->select('b.buku_id, b.sampul, b.isbn, b.lampiran, b.title, b.penerbit, b.pengarang, b.thn_buku, b.isi, b.jml, b.tgl_masuk, r.nama_rak, k.nama_kategori');
            $this->db->from('tbl_buku b');
            $this->db->join('tbl_rak r', 'r.id_rak=b.id_rak');
            $this->db->join('tbl_kategori k', 'b.id_kategori=k.id_kategori');
            $buku = $this->db->get()->result();
        }
        $this->response($buku, 200);
    }
    function index_post()
    {
        $data = array(
            'id_kategori' => $this->post('id_kategori'),
            'id_rak' => $this->post('id_rak'),
            'sampul' => $this->post('sampul'),
            'isbn' => $this->post('isbn'),
            'lampiran' => $this->post('lampiran'),
            'title' => $this->post('title'),
            'penerbit' => $this->post('penerbit'),
            'pengarang' => $this->post('pengarang'),
            'thn_buku' => $this->post('thn_buku'),
            'isi' => $this->post('isi'),
            'jml' => $this->post('jml'),
            'tgl_masuk' => $this->post('tgl_masuk')
        );
        $insert = $this->db->insert('tbl_buku', $data);
        if ($insert) {
            $this->response(['status' => 'success', 'message' => 'Buku berhasil fitambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('buku_id');
        $data = array(
            'id_kategori' => $this->put('id_kategori'),
            'id_rak' => $this->put('id_rak'),
            'sampul' => $this->put('sampul'),
            'isbn' => $this->put('isbn'),
            'lampiran' => $this->put('lampiran'),
            'title' => $this->put('title'),
            'penerbit' => $this->put('penerbit'),
            'pengarang' => $this->put('pengarang'),
            'thn_buku' => $this->put('thn_buku'),
            'isi' => $this->put('isi'),
            'jml' => $this->put('jml'),
            'tgl_masuk' => $this->put('tgl_masuk')
        );
        $this->db->where('buku_id', $npm);
        $update = $this->db->update('tbl_buku', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Buku UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('buku_id');
        $this->db->where('buku_id', $id);
        $delete = $this->db->delete('tbl_buku');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Buku has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
