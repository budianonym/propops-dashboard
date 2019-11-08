<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Damagewaiver extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('damagewaiver_model');

    }
	public function index()
	{

		if( isset($_POST['submit']) ) {
		$data['dw'] = $this->damagewaiver_model->cek_damagewaiver($_POST['nid']);
		} else{
			$data['dw'] = Array();
		}
		$data['title'] = "Damage Waiver";
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('tools/redawning/damagewaiver_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
