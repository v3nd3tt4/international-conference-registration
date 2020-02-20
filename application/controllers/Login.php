<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('session');
    }

    public function index(){
        $data = array(
            'page' => 'user/login',
            'link' => 'login',
            'script' => 'script/login',
        );
        $this->load->view('template/wrapper', $data);
    }
    
    public function login_nya($user, $password){
        $ch = curl_init(); //buat resourcce cURL

        //set opsi URL dan opsi RETURNTRANSFER
        curl_setopt($ch, CURLOPT_URL, "http://192.168.6.16/ariefsso/?user=".$user."&password=".md5($password)."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //dapatkan halaman URL dan berikan ke variabel $output
        $output = curl_exec($ch);

        //tutup resource cURL
        curl_close($ch);
        
        //cetak output
        $output = json_decode($output);
        
        echo 'status = '.$output->status.'<br/>';
        echo 'user = '.$output->user.'<br/>';
        echo 'name = '.$output->name.'<br/>';
        echo 'occupation = '.$output->occupation.'<br/>';
    }

    public function proses_login(){
        $username = trim($this->input->post('username', true));
        $password = trim($this->input->post('password', true));
        $cek = $this->Model->ambil_new(array('username' => $username), 'tb_user');
        if(!$_POST){
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>';
            exit();
        }else{
            if($cek->num_rows() == 0){
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> User not found !</div>';
                exit();
            }else{
                $get_data = $this->Model->ambil_new(array('email' => $username), 'tb_pendaftar');

                $hash = $cek->row()->password;
                if(password_verify($password, $hash)){
                    if($cek->row()->level == 'admin'){

                        $data = array(
                            'is_login' => true,
                            'username'  => $cek->row()->username,
                            'level'     => $cek->row()->level,
                            'nama' => $cek->row()->username,
                            'photo' => NULL,
                            'paper' => NULL,
                            'revisi' => NULL
                        );
                        $this->session->set_userdata($data);
                        echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Success, connecting ...!</div>';
                        echo'<script>window.location.href="'.base_url().'admin";</script>';
                    }else{
                        $data = array(
                            'is_login' => true,
                            'username'  => $cek->row()->username,
                            'level'     => $cek->row()->level,
                            'nama' => $get_data->row()->nama_pendaftar,
                            'photo' => $get_data->row()->photo,
                            'paper' => $get_data->row()->paper,
                            'revisi' => $get_data->row()->status_verifikasi
                        );
                        $this->session->set_userdata($data);
                        echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Success, connecting ...!</div>';
                        echo'<script>window.location.href="'.base_url().'user";</script>';
                    }
                }else{
                    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> system error occurred !</div>';
                }

            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        //$this->session->unset_userdata();
        echo '<script>alert("logout");window.location.href = "'.base_url().'";</script>';
    }
    
}