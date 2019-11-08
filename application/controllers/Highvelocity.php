<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Highvelocity extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('highvelocity_model');
        function tomvol($ge,$que1,$que2){
			if ($ge==""){
			$di = "";
			}else{$di = "$que1".str_replace(",","','",$ge)."$que2";
			  };
			return $di;

			};


    }
	public function index()
	{
		if( isset($_GET['submit']) ) {
$pms = $_GET['pms'];
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$pmss = tomvol($pms,"and if(cff.field_calendar_feed_format_value like 'haapi_%', 'homeaway API',cff.field_calendar_feed_format_value) = '","'");

		$data['result'] = $this->highvelocity_model->get_all($pmss, $date1, $date2);
	} else {
$result=Array();}
		$data['title'] = __CLASS__;
		$this->slice->view('template/header', $data);
		$this->slice->view('highvelocity/highvelocity_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
