<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('session');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'admin'){
			echo'<script>alert("Sorry, You dont have permission");</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin',
			'link' => 'pendaftaran',
			'country' => $this->Model->list_data_all('tb_ref_negara'),
			'script' => 'script/pendaftaran',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function list_pendaftar(){
		$data = array(
			'page' => 'list',
			'link' => 'list',
			'data' => $this->Model->list_data_all('tb_pendaftar'),
			'script' => 'script/list',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function detail_pendaftar($id){
		 $query = $this->Model->ambil_new(array('id_pendaftar' => $id), 'tb_pendaftar');
        $topics = $this->Model->list_data_all('tb_topics');
        $data = array(
            'page' => 'profile_pendaftar',
            'link' => 'list',
            'topics' => $topics,
            'data' => $query,
            'script' => 'script/list',
        );
        $this->load->view('template/wrapper', $data);
	}

	public function simpan_verifikasi(){
		// if(!$_POST){
		// 	$return = array(
		// 		'status' => 'failed',
		// 		'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>'
		// 	);
		// 	echo json_encode($return);
		// 	exit();
		// }
		$this->load->library('Rest','rest');
		$cek_status = $this->Model->ambil_new(array('id_pendaftar' => $this->input->post('id_pendaftar', true)), 'tb_pendaftar');
		if($cek_status->row()->status_verifikasi == 'Accepted' || $cek_status->row()->status_verifikasi == 'Rejected'){
			$return = array(
				'status' => 'failed',
				'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Tidak diperbolehkan karena paper sudah disetujui atau ditolak !</div>'
			);
			echo json_encode($return);
			exit();
		}

		if($this->input->post('status_nya', true) == 'Major Revision' || $this->input->post('status_nya', true) == 'Minor Revision'){
			if (!is_uploaded_file($_FILES['file_direvisi']['tmp_name'])) {
				$return = array(
					'status' => 'failed',
					'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> File revision must be filled !</div>'
				);
				echo json_encode($return);
				exit();
			}else{
				$config ['upload_path'] = './assets/file_upload/foto/';
		        $config ['allowed_types'] = 'PDF|pdf';
		        $config ['max_size'] = '3000';
		        $config ['file_name'] = date("YmdHis");
		        $this->upload->initialize($config);

		        if(!$this->upload->do_upload('file_direvisi')){
		            $msg = array('status' => 'failed', 'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Your file is not PDF</div>' );
		            echo json_encode($msg);
		            exit();
		        }else{
		        	$this->upload->do_upload('file_direvisi');
		        	$upload_data = $this->upload->data();
		        	$file = $upload_data['file_name'];
		        }
			} 
		}else{
			$file = NULL;
		}

        $data = array(
        	'status_verifikasi' => $this->input->post('status_nya', true),
			'status_absnya' => $this->input->post('status_absnya', true),
        	'file_revisi' => $file,
        	'komentar' => $this->input->post('komentar', true),
        );

        $msg = 'We are pleased to inform you that your abstract has been reviewed and '.$this->input->post('status_absnya', true).'. Please, download your letter of acceptance <a href="">here</a>. Please check your SEAAN account <a href="'.base_url().'">here</a>';

        // $kirim_email = $this->rest->send_request('http://sso.itera.ac.id/mails', 'POST', array('to' => $cek_status->row()->email, 'subject' => 'Paper review', 'message' => $msg));
        $this->send($cek_status->row()->email, $msg, 'ICGC Paper review');

   //      if($kirim_email === false){
   //      	$return = array(
			// 	'status' => 'failed',
			// 	'msg' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> system error occurred !</div>'
			// );
			// echo json_encode($return);
			// exit();
   //      }

        $simpan = $this->Model->update('id_pendaftar', $this->input->post('id_pendaftar', true), 'tb_pendaftar', $data);
        if($simpan){
			$return = array(
				'status' => 'success',
				'msg' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> success !</div>'
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

	public function send($email_to, $message, $subject){  
   		$ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "icgc.abkinpdlampung@gmail.com";
        $config['smtp_pass'] = "icgc123456";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('icgc.abkinpdlampung@gmail.com', 'ICGC');
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