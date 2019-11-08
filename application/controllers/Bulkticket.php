<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkticket extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // $this->load->database();
        // $this->load->model('backlog_model');
    }
	public function index()
	{
		
		// $data['backlog'] = $this->backlog_model->get_backlog();
		$data['title'] = __CLASS__;
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('tools/freshdesk/bulkticket_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
