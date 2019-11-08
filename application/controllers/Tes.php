<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url');
        // $this->load->database();
        // $this->load->model('allstatus_model');
    }
	public function conn($a, $b)
	{
		echo 999;
		echo $a;
		echo $b;
		
		// $data['result'] = $this->allstatus_model->get_allstatus();
		// $data['title'] = __CLASS__;
		// $this->slice->view('template/header', $data);
		// $this->slice->view('allstatus_view', $data);
		// $this->slice->view('template/footer', $data);
		// $this->load->view('tes');
	}
	public function wow($i)
	{
		// echo 'controller';
		echo SELF;
		echo $i;
		// echo $num;
		// echo 999;
		// echo $a;
		// echo $b;
		
		// $data['result'] = $this->allstatus_model->get_allstatus();
		// $data['title'] = __CLASS__;
		// $this->slice->view('template/header', $data);
		// $this->slice->view('allstatus_view', $data);
		// $this->slice->view('template/footer', $data);
		// $this->load->view('tes');
	}
}
