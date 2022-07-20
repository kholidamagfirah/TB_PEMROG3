    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    require APPPATH . "libraries/Format.php";
    require APPPATH . "libraries/RestController.php";

    use chriskacerguis\RestServer\RestController;

    class User extends RESTController
    {
        function __construct($config = 'rest')
        {
            parent::__construct($config);
            $this->load->database();
        }
        function index_get()
        {
            $id = $this->get('anggota_id');
            if ($id == '') {
                $this->db->select('id_login, anggota_id, nama, pass,user, jenkel, alamat, foto, level, telepon, tgl_lahir, email, tgl_bergabung');
                $this->db->from('tbl_login');
                $user = $this->db->get()->result();
            } else {
                $this->db->select('anggota_id, nama, pass, user, jenkel, alamat, telepon,  tgl_lahir, email, tgl_bergabung');
                $this->db->from('tbl_login');
                $user = $this->db->get()->result();
            }
            $this->response($user, 200);
        }

        function index_post()
        {
            $id = $this->get('anggota_id');
            $data = array(
                'anggota_id' => $this->post('anggota_id'),
                'user' => $this->post('user'),
                'pass' => $this->post('pass'),
                'level' => $this->post('level'),
                'nama' => $this->post('nama'),
                'tempat_lahir' => $this->post('tempat_lahir'),
                'tgl_lahir' => $this->post('tgl_lahir'),
                'jenkel' => $this->post('jenkel'),
                'alamat' => $this->post('alamat'),
                'telepon' => $this->post('telepon'),
                'email' => $this->post('email'),
                'tgl_bergabung' => $this->post('tgl_bergabung'),
                'foto' => $this->post('foto'),
            );
            $insert = $this->db->insert('tbl_login', $data);
            if($id){
                $this->response(['status' => 'fail', 'message' => 'id tidak boleh !', 'data' => $data], 502);
            }
            elseif ($insert) {
                $this->response(['status' => 'success', 'message' => 'User Berhasil Ditambahkan !', 'data' => $data], 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
        function index_put()
        {
            $npm = $this->put('anggota_id');
            $data = array(
                'anggota_id' => $this->put('anggota_id'),
                'user' => $this->put('user'),
                'pass' => $this->put('pass'),
                'level' => $this->put('level'),
                'nama' => $this->put('nama'),
                'tempat_lahir' => $this->put('tempat_lahir'),
                'tgl_lahir' => $this->put('tgl_lahir'),
                'jenkel' => $this->put('jenkel'),
                'alamat' => $this->put('alamat'),
                'telepon' => $this->put('telepon'),
                'email' => $this->put('email'),
                'tgl_bergabung' => $this->put('tgl_bergabung'),
                'foto' => $this->put('foto'),
            );
            $this->db->where('anggota_id', $npm);
            $update = $this->db->update('tbl_login', $data);
            if ($update) {
                if ($this->db->affected_rows() == 1) {
                    $this->response(['status' => 'success', 'message' => 'user UPDATED !', 'data' => $data], 200);
                } else {
                    $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
                }
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
        function index_delete()
        {
            $id = $this->delete('anggota_id');
            $this->db->where('anggota_id', $id);
            $delete = $this->db->delete('tbl_login');
            if ($delete) {
                $this->response(array('status' => true, 'message' => 'user has been DELETED !!!'), 202);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }
