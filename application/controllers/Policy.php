<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('policy_model');

        function checkif ($cek, $row){
if ($row["$cek"]!= null) {
	return "<font color='green'>Yes</font>";
} else {return "<font color='red'>No</font>";};
};
function checkifnull ($cek, $row){
if ($row["$cek"]!= null) {
	return $row["$cek"];
} else {return "<font color='red'>NULL</font>";};
};

function issetbutton($a){
if( isset($_POST['find']) ) {
  echo ($_POST["$a"]);
} else {
echo "";
};

};
    }
	public function index()
	{
		if( isset($_POST['find']) ) {
	$keyword = $_POST['keyword'];
		

	}else{
$keyword = 00000000000000;
	}
	$data['policy'] = $this->policy_model->policy($keyword);
		$data['title'] = __CLASS__;
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('tools/redawning/policy_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
