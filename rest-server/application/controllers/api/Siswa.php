<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class Siswa extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model', 'siswa');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $siswa = $this->siswa->getSiswa();
        } else {
            $siswa = $this->siswa->getSiswa($id);
        }
        
        if ($siswa) {
            // Set the response and exit
            $this->response([
                'status' => true,
                'data' => $siswa
            ], REST_Controller::HTTP_OK);
        } else {
             // Set the response and exit
             $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function index_delete()
    {
        $id = $this->delete('id');

        if($id === null){
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->siswa->deleteSiswa($id) > 0 ) {
                // ok
                $this->response([
                    'status' => true,
                    'nis' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }


    public function index_post()
    {
        $data = [
            'nis' => $this->post('nis'),
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat')
        ];

        if($this->siswa->createSiswa($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new siswa has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data.'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nis' => $this->put('nis'),
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat')
        ];

        if($this->siswa->updateSiswa($data, $id)) {
            $this->response([
                'status' => true,
                'message' => 'siswa has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data.'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}