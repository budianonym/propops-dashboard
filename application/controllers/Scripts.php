<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scripts extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // $this->load->database();
        // $this->load->model('allstatus_model');
    }
	public function index()
	{
		// $data['result'] = $this->allstatus_model->get_allstatus();
		$data['title'] = 'Scripts';
		$this->slice->view('template/header', $data);
		$this->slice->view('scripts_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
