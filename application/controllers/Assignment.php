<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('assignment_model');
    }
	public function index()
	{
		$data['number'] = $this->assignment_model->get_allnumber();
		// var_dump($data['number']);
		$data['i'] = 1;
		$data['title'] = __CLASS__;
		if( isset($_GET['find']) ) {
			$data['propertiesPerUser'] = $this->assignment_model->propertiesPerUser($_GET['reviewer']);
		$theNid = "";
		foreach ($data['propertiesPerUser'] as $key) {
			$theNid .= $key['nid'].',';
		}
		$theNid = substr($theNid, 0, -1);
		// var_dump($theNid);
		if ($theNid=="") {
			$data['nids'] = array();
		}else{
		$data['nids'] = $this->assignment_model->get_nids($theNid);
			}

		}else{
			$data['propertiesPerUser'] = array();
			
		}
		// var_dump($data['propertiesPerUser']);
		$this->slice->view('template/header', $data);
		$this->slice->view('assignment_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
