<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allstatus extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('allstatus_model');
    }
	public function index()
	{
		$data['result'] = $this->allstatus_model->get_allstatus();
		$data['title'] = __CLASS__;
		$this->slice->view('template/header', $data);
		$this->slice->view('allstatus_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
