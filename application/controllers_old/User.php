<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('session');
        if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'pendaftar'){
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
    }

    public function index(){
        $query = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');
        $data = array(
            'page' => 'user/profile',
            'link' => 'profile',
            'script' => 'script/login',
            'data' => $query,
        );
        $this->load->view('template/wrapper', $data);
    }

    public function paper_submission(){
        $query = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');
        $file = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_file_upload');
        $topics = $this->Model->list_data_all('tb_topics');
        $data = array(
            'page' => 'user/paper_submission',
            'link' => 'paper_submission',
            'script' => 'script/paper_submission',
            'topics' => $topics,
            'data' => $query,
            'file' => $file

        );
        $this->load->view('template/wrapper', $data);
    }

    public function simpan_paper_submission(){
        $cek_paper = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');

        if($cek_paper->row()->abstract === NULL || $cek_paper->row()->abstract == ''){
            $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                    <h4>Failed</h4>
                    <p>Please Upload Abstract!</p>
                </div>');
            echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
            exit();
        }
        
        // if($cek_paper->row()->full_paper === NULL || $cek_paper->row()->full_paper === ''){
        //     $this->session->set_flashdata('msg', 
        //         '<div class="alert alert-danger">
        //             <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
        //             <h4>Failed</h4>
        //             <p>Abstract must be upload!</p>
        //         </div>');
        //     echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
        //     exit();
        // }

        if($cek_paper->row()->status_verifikasi == 'Waiting For Verification' || $cek_paper->row()->status_verifikasi == 'Accepted' || $cek_paper->row()->status_verifikasi == 'Rejected'){
            $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                    <h4>Failed</h4>
                    <p>Sorry, You cannot edit!</p>
                </div>');
            echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
            exit();
        }

        if(!$_POST){
            $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                    <h4>Failed</h4>
                    <p>all data must be filled!</p>
                </div>');
            echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
            exit();
        }else{
            $data = array(
                'tittle' => $this->input->post('title', true),
                'abstract_text' => $this->input->post('abstract_text', true),
                'id_topics' => $this->input->post('category', true),
                'keyword_abstract' => $this->input->post('keyword', true),
                'status_verifikasi' => 'Waiting For Verification'
            );
            $simpan = $this->Model->update('email', $this->session->userdata('username'), 'tb_pendaftar', $data);
            if($simpan){
                $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                    <h4>Success</h4>
                    <p>Data save!</p>
                </div>');
                echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
                exit();
            }else{
                $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                    <h4>Failed</h4>
                    <p>system error occurred!</p>
                </div>');
                echo'<script>window.location.href="'.base_url().'user/paper_submission";</script>';
                exit();
            }
        }
    }

    public function simpan_file_full_paper(){
        $this->load->library('image_lib');
        $this->load->library('upload');
        $cek_paper = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');

        $hari_ini = strtotime(date('Y-m-d H:i:s'));
        $tgl_upload = strtotime('2018-02-02 23:59:59');

        if($hari_ini < $tgl_upload){
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Sorry, You cannot upload full paper now !</div>'
            );
            echo json_encode($return);
            exit();
        }

        // if($cek_paper->row()->status_verifikasi == 'Waiting For Verification' || $cek_paper->row()->status_verifikasi == 'Accepted' || $cek_paper->row()->status_verifikasi == 'Rejected'){
        //     $return = array(
        //         'status' => 'failed',
        //         'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Sorry, You cannot edit !</div>'
        //     );
        //     echo json_encode($return);
        //     exit();
        // }

        if (!is_uploaded_file($_FILES['file_nya_full_paper']['tmp_name'])) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> FIle must be filled !</div>'
            );
            echo json_encode($return);
            exit();
        } 

        if(!$_POST){
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $config ['upload_path'] = './assets/file_upload/foto/';
        $config ['allowed_types'] = 'DOC|DOCX|doc|docx';
        $config ['max_size'] = '3000';
        $config ['file_name'] = date("YmdHis");
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file_nya_full_paper')){
            $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
            echo json_encode($msg);
            exit();
        }

        $this->upload->do_upload('file_nya_full_paper');
        $upload_data = $this->upload->data();

        $data = array(
            'full_paper' => $upload_data['file_name'],
        );
        $simpan = $this->Model->update('email', $this->session->userdata('username'), 'tb_pendaftar', $data);
        if($simpan){
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i>success !</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> system error occurred !</div>'
            );
            echo json_encode($return);
            exit();
        }

    }

    public function simpan_file_abstract(){
        $this->load->library('image_lib');
        $this->load->library('upload');

        $cek_paper = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');

        // if($cek_paper->row()->status_verifikasi == 'Waiting For Verification' || $cek_paper->row()->status_verifikasi == 'Accepted' || $cek_paper->row()->status_verifikasi == 'Rejected'){
        //     $return = array(
        //         'status' => 'failed',
        //         'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Sorry, You cannot edit !</div>'
        //     );
        //     echo json_encode($return);
        //     exit();
        // }

        if (!is_uploaded_file($_FILES['file_nya_abstract']['tmp_name'])) {
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> FIle must be filled !</div>'
            );
            echo json_encode($return);
            exit();
        } 

        if(!$_POST){
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $config ['upload_path'] = './assets/file_upload/foto/';
        $config ['allowed_types'] = 'DOC|DOCX|doc|docx';
        $config ['max_size'] = '3000';
        $config ['file_name'] = date("YmdHis");
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file_nya_abstract')){
            $msg = array('status' => 'failed', 'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
            echo json_encode($msg);
            exit();
        }

        $this->upload->do_upload('file_nya_abstract');
        $upload_data = $this->upload->data();

        $data = array(
            'abstract' => $upload_data['file_name'],
        );
        $simpan = $this->Model->update('email', $this->session->userdata('username'), 'tb_pendaftar', $data);
        if($simpan){
            $return = array(
                'status' => 'success',
                'msg' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i>success !</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> system error occurred !</div>'
            );
            echo json_encode($return);
            exit();
        }

    }

    public function information(){
        $query = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');
        $data = array(
            'page' => 'user/information',
            'link' => 'information',
            'data' => $query,
        );
        $this->load->view('template/wrapper', $data);
    }

    public function revision(){
        $query = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');
        $data = array(
            'page' => 'user/revisi',
            'link' => 'revision',
            'data' => $query,
            'script' => 'script/revisi',
        );
        $this->load->view('template/wrapper', $data);
    }

    public function simpan_file_revisi(){
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('Rest','rest');
        // if(!$_POST){
        //     $return = array(
        //         'status' => 'failed',
        //         'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>'
        //     );
        //     echo json_encode($return);
        //     exit();
        // }

        $cek_status = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');

        if($cek_status->row()->status_verifikasi == 'Accepted' || $cek_status->row()->status_verifikasi == 'Rejected'){
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Tidak diperbolehkan karena paper sudah disetujui atau ditolak !</div>'
            );
            echo json_encode($return);
            exit();
        }

        if (!is_uploaded_file($_FILES['paper_revisi']['tmp_name'])) {
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> File must be filled !</div>'
            );
            echo json_encode($return);
            exit();
        } 

        $config ['upload_path'] = './assets/file_upload/foto/';
        $config ['allowed_types'] = 'PDF|pdf';
        $config ['max_size'] = '3000';
        $config ['file_name'] = date("YmdHis");
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('paper_revisi')){
            $msg = array('status' => 'failed', 'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
            echo json_encode($msg);
            exit();
        }

        $this->upload->do_upload('paper_revisi');
        $upload_data = $this->upload->data();

        $msg = '<a href="'.base_url().'admin/detail_pendaftar/'.$cek_status->row()->id_pendaftar.'">'.$cek_status->row()->nama_pendaftar.'</a> telah mengupload paper yang direvisi';

        // $kirim_email = $this->rest->send_request('http://sso.itera.ac.id/mails', 'POST', array('to' => 'seaan2018@itera.ac.id', 'subject' => 'Paper telah direvisi', 'message' => $msg));

        $this->send('icgc.abkinpdlampung@gmail.com', $msg, 'Paper telah direvisi');

        if($kirim_email === false){
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i>system error occurred ! !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $simpan = $this->Model->update('email', $this->session->userdata('username'), 'tb_pendaftar', array('file_after_revisi' => $upload_data['file_name']));
        if($simpan){
            $return = array(
                'status' => 'success',
                'msg' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i>success !</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'failed',
                'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> system error occurred !</div>'
            );
            echo json_encode($return);
            exit();
        }
    }

    public function payment_proof(){
        $query = $this->Model->ambil_new(array('email' => $this->session->userdata('username')), 'tb_pendaftar');
        $data = array(
            'page' => 'user/payment_proof',
            'link' => 'payment_proof',
            'script' => 'script/payment_proof',
            'data' => $query
        );
        $this->load->view('template/wrapper', $data);
    }

    public function simpan_bukti_bayar(){
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('Rest','rest');
        $config ['upload_path'] = './assets/file_upload/foto/';
        $config ['allowed_types'] = 'PDF|pdf|JPG|jpg|jpeg|JPEG';
        $config ['max_size'] = '3000';
        $config ['file_name'] = date("YmdHis");
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')){
            // set flash data
            $this->session->set_flashdata('msg', $this->upload->display_errors());
            redirect('user/payment_proof');
            exit();
        }

        $this->upload->do_upload('file');
        $upload_data = $this->upload->data();

        $simpan = $this->Model->update('email', $this->session->userdata('username'), 'tb_pendaftar', array('bukti_bayar' => $upload_data['file_name']));
        if($simpan){
            // set flash data
            $this->session->set_flashdata('msg', 'Success');
            redirect('user/payment_proof');
            exit();
        }else{
            // set flash data
            $this->session->set_flashdata('msg', 'Failed');
            redirect('user/payment_proof');
            exit();
        }
    }

    public function generateword(){
        
    }

   public function send($email_to='pilopaokta@gmail.com', $message='test', $subject='test'){  
   		$ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.abkin-pdlampung.org";
        $config['smtp_port'] = "587";
        $config['smtp_user'] = "admin@icgc.abkin-pdlampung.org";
        $config['smtp_pass'] = "goldroger27";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('admin@icgc.abkin-pdlampung.org', 'ICGC');
        // $list = array('pilopaokta@gmail.com');
        $ci->email->to($email_to);
        $ci->email->subject($subject);
        $ci->email->message($message);
        if ($this->email->send()) {
            // echo 'Email sent.';
            return true;
        } else {
            // show_error($this->email->print_debugger());
            return false;
        }
  	}  

}