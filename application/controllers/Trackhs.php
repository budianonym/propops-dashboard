<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trackhs extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('trackhs_model');
    }
	public function index()
	{
		$data['result'] = $this->trackhs_model->get_allstatus();
		$data['title'] = 'TrackHS';
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('trackhs_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
