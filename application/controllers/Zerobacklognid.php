<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zerobacklognid extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('zerobacklognid_model');

        function checkzero($a){
        	if ($a!=null) {
        		return $a;
        	}else{return 0;}
        }
    }
	public function index()
	{
		// $data['zerobacklognid'] = $this->zerobacklognid_model->local();
		$data['zerobacklognidcount'] = $this->zerobacklognid_model->localcount();
		// var_dump($data['backlog']);
		$data['title'] = "Backlog for Daily Operation";
		$data['i'] = 1;
 $data['timestamp'] = [];
 $data['redawning'] = [];
 $data['expedia'] = []; 
 $data['homeaway'] = []; 
 $data['airbnb'] = [];
		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/nid_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}

	public function nid()
	{

		$data['zerobacklognidajax'] = $this->zerobacklognid_model->local($_GET['channel'], $_GET['date']);
		$data['zerobacklognidvalidation'] = $this->zerobacklognid_model->validation($_GET['channel'], $_GET['date']);
		$data['codenya'] = $this->zerobacklognid_model->codenya();
//var_dump($data['codenya']);
		// var_dump($data['backlog']);
		$data['i'] = 1;
		$this->slice->view('zerobacklog/nidajax_view', $data);
		
		// $this->load->view('welcome_message');
	}


	public function validation()
	{

		$data['zerobacklognidvalidationall'] = $this->zerobacklognid_model->validationall();
		// var_dump($data['backlog']);
		$data['title'] = "Validation Backlog";
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/zerobacklogvalidation_view', $data);
		$this->slice->view('template/footer', $data);
		
		// $this->load->view('welcome_message');
	}
		public function dailyAssignment()
	{

		$data['dailyAssignment'] = $this->zerobacklognid_model->dailyAssignment();
		// var_dump($data['backlog']);
		$data['title'] = "Daily Assignment Numbers";
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/dailyassignment_view', $data);
		$this->slice->view('template/footer', $data);
		
		// $this->load->view('welcome_message');
	}
		public function livenotreview()
	{

		$data['dailyAssignment'] = $this->zerobacklognid_model->get_livenotreview();
		// var_dump($data['backlog']);
		$data['title'] = "Daily backlog (LiveNotReviewed";
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/livenotreviewed_view', $data);
		$this->slice->view('template/footer', $data);
		
		// $this->load->view('welcome_message');
	}	
}
