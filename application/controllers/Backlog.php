<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backlog extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('backlog_model');
    }
	public function index()
	{
		$data['backlog'] = $this->backlog_model->get_backlog();
		$theNid = "";
		foreach ($data['backlog'] as $key) {
			$theNid .= $key['nid'].',';
		}
		$theNid = substr($theNid, 0, -1);
		// var_dump($theNid);
		$data['nids'] = $this->backlog_model->get_nids($theNid);
		// var_dump($data['nids']);
		$data['title'] = __CLASS__;
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('backlog_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
		public function livenotreview()
	{

		$data['livenotreviewed'] = $this->backlog_model->get_livenotreview();
		// var_dump($data['backlog']);
		$data['title'] = "Daily Backlog (LiveNotReviewed)";
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/livenotreviewed', $data);
		$this->slice->view('template/footer', $data);
		
		// $this->load->view('welcome_message');
	}		
}
