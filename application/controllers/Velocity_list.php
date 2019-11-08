<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Velocity_list extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('velocity_model');
    }
	public function index()
	{
		if (isset($_GET['submit'])){
			// var_dump($_GET['live']);
		$theDate1 = $_GET['theDate1'];
		$theDate2 = $_GET['theDate2'];

			if ($_GET['live']=="Post Live") {
				$data['nids'] = $this->velocity_model->get_nids($theDate1, $theDate2);
			}else {
				$data['nids'] = $this->velocity_model->get_nidscreated($theDate1, $theDate2);
			}

				
		$theNid = "";
		foreach ($data['nids'] as $key) {
			$theNid .= $key['nid'].',';
		}
		$theNid = substr($theNid, 0, -1);
		$data['result'] = $this->velocity_model->get_data($theNid);
		} else {
		$theNid = '000,000';
		$data['result'] = $this->velocity_model->get_data($theNid);
		}

		$data['title'] = __CLASS__;
		$this->slice->view('template/header', $data);
		$this->slice->view('highvelocity/velolist_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
		public function statenote()
	{
		$data['statenote'] = $this->velocity_model->get_statenote($_GET['nid']);
		$data['title'] = __CLASS__;
		$this->slice->view('highvelocity/statenoteajax_view', $data);
	}
}
