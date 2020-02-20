<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('session');
    }

    public function generate_pdf($id = '', $key = ''){
    	$find = $this->Model->ambil_new(array('id_pendaftar' => $id), 'tb_pendaftar');
    	if($find->num_rows() == 0){
    		echo 'you dont have permission';
    	}else{
    		$tittle = $find->row()->tittle;
    		$session = $this->Model->ambil_new(array('id_topics' => $find->row()->id_topics), 'tb_topics')->row()->title;
    		$author = $find->row()->nama_pendaftar;
    		$status = $find->row()->status_absnya;
		    $data = array(
		    	'tanggal' => date('Y-m-d'),
		    	'tittle' => $tittle,
		    	'session' => $session,
		    	'author' => $author,
		    	'status' => $status
		    );
		    $this->load->view('tmpseaanloa', $data);
	    }
    }


}