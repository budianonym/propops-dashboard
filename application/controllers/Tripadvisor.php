<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tripadvisor extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // $this->load->database();
        // $this->load->model('backlog_model');

    function issetbutton($a){
if( isset($_POST['submit']) ) {
  echo ($_POST["$a"]);
} else {
echo "";
};

};
    }
	public function index()
	{
		// $data['backlog'] = $this->backlog_model->get_backlog();
		$data['title'] = __CLASS__;
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('tripadvisor', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
