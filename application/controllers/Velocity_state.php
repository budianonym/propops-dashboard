<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Velocity_state extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('velocity_model');
        function searchDuration($a, $result, $nid){
        	global $resultt;
        	$resultt="";
foreach ($result as $key) {
  if ($key['nid'] == $nid && $key['state'] == "$a") {
    $resultt = $key['duration in hour'];
    echo $resultt;
  }
}
  if ($resultt==null) {
    echo '-';
  }

}
    }
	public function index()
	{
		if (isset($_GET['submit'])){
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
		$this->slice->view('highvelocity/velo_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
