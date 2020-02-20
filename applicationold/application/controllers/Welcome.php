<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('recaptcha');
	}

	public function index(){

		$data = array(
			'page' => 'user/pandaftaran',
			'link' => 'pendaftaran',
			'country' => $this->Model->list_data_all('tb_ref_negara'),
			'script' => 'script/pendaftaran',
			'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
		);
		$this->load->view('template/wrapper', $data);
	}

	public function simpan_pendaftaran(){
		$this->load->library('Rest','rest');
		// $recaptcha = $this->input->post('g-recaptcha-response');
  //       $response = $this->recaptcha->verifyResponse($recaptcha);
  //       if (!isset($response['success']) || $response['success'] <> true) {
  //           // $this->index();
  //           $return = array(
		// 		'status' => 'failed_captcha',
		// 		'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Wrong captcha ! reload your browser, please...</div>'
		// 	);
		// 	echo json_encode($return);
		// 	exit();
  //       }
		if (!is_uploaded_file($_FILES['photo']['tmp_name'])) {
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> Photo must be filled !</div>'
			);
			echo json_encode($return);
			exit();
		} 
		if (!$_POST){
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> all data must be filled !</div>'
			);
			echo json_encode($return);
			exit();
		}else{
			$query = $this->Model->ambil_new(array('email' => $this->input->post('email', true)), 'tb_pendaftar');
			if($query->num_rows() > 0){
				$return = array(
					'status' => 'failed',
					'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i> You have already registered !</div>'
				);
				echo json_encode($return);
				exit();
			}
			$config ['upload_path'] = './assets/file_upload/foto/';
            $config ['allowed_types'] = 'jpg|jpeg|png|PNG|JPG|JPEG';
            $config ['max_size'] = '2000';
            $config ['file_name'] = date("YmdHis");
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('photo')){
                $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
                echo json_encode($msg);
                exit();
            }

            $this->upload->do_upload('photo');
            $upload_data = $this->upload->data();
			$password = password_hash($this->input->post('tgl_lahir', true), PASSWORD_DEFAULT);

			$data = array(
				'nama_pendaftar' => $this->input->post('nama_pendaftaran', true),
				'id_negara' => $this->input->post('country_pendaftaran', true),
				'nama_negara' => $this->input->post('others_country', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'affiliation' => $this->input->post('affiliation', true),
				'no_hp' => $this->input->post('no_hp', true),
				'email' => $this->input->post('email', true),
				'id_jenis_peserta' => $this->input->post('participant', true),
				'paper' => $this->input->post('paper_submission', true),
				'photo' => $upload_data['file_name'],
				'jenis_kelamin' => $this->input->post('jk', true),
				'join_excursion' => $this->input->post('join_excursion', true),
			);
			$data_user = array(
				'username' => $this->input->post('email', true),
				'password' => $password,
				'level' => 'pendaftar'
			);
			$simpan = $this->Model->simpan_data($data, 'tb_pendaftar');
			$simpan_user = $this->Model->simpan_data($data_user, 'tb_user');
			if($simpan){
				$message = 'Thanks for registration, This is your ICGC account & please complete your profile<br/>Username: '.$this->input->post('email', true).'<br/>password: '.$this->input->post('tgl_lahir', true).'<br/>login <a href="'.base_url().'">here</a>';
				$this->send($this->input->post('email', true), $message, 'ICGC account');
				// $this->rest->send_request('http://sso.itera.ac.id/mails', 'POST', array('to' => $this->input->post('email', true), 'subject' => 'Username dan Password', 'message' => $message));
				$return = array(
					'status' => 'success',
					'text' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><i class="fa fa-check" aria-hidden="true"></i>success, please check your email  !</div>'
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
	}

	public function procedure(){
		$data = array(
			'page' => 'user/procedure',
			'link' => 'procedure',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function counselee(){
		$data = array(
			'page' => 'user/counselee',
			'link' => 'counselee',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function ct(){
		$data = array(
			'page' => 'user/ct',
			'link' => 'ct',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function sc(){
		$data = array(
			'page' => 'user/sc',
			'link' => 'sc',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function oc(){
		$data = array(
			'page' => 'user/oc',
			'link' => 'oc',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function ks(){
		$data = array(
			'page' => 'user/ks',
			'link' => 'ks',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function mp(){
		$data = array(
			'page' => 'user/mp',
			'link' => 'mp',
		);
		$this->load->view('template/wrapper', $data);
	}

	public function send_mail(){
		// Konfigurasi email
        // $config = [
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_user' => 'icgc.abkinpdlampung@gmail.com',  // Email gmail
        //     'smtp_pass'   => 'icgc123456',  // Password gmail
        //     'smtp_crypto' => 'ssl',
        //     'smtp_port'   => 465,
        //     'crlf'    => "\r\n",
        //     'newline' => "\r\n"
        // ];

        // Load library email dan konfigurasinya
        // $this->load->library('email', $config);


		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'pilopaokta@gmail.com',
		    'smtp_pass' => '1011080037',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

        // Email dan nama pengirim
        $this->email->from('pilopaokta@gmail.com', 'ICGC');

        // Email penerima
        $this->email->to('icgc.abkinpdlampung@gmail.com'); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | MasRud.com');

        // Isi email
        $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/post/kirim-email-dengan-smtp-gmail' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

        // Tampilkan pesan sukses atau error
        var_dump($this->email->send());exit();
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
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
