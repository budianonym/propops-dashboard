<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('cron_model');

        function inputSet($a){
	if ($a!=array ()) {

																													
$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code, description) VALUE ";
	foreach ($a as $key) {
		$ha .= "(".$key['nid'].", '".$key['category']."', '".$key['state_name']."', '".$key['channel']."', '".$key['production_severity']."', '".$key['code']."', '".$key['description']."')";
		if ($counter != count($a)-1){
			$ha .= ",";
		}
		$counter++;
	}
return $ha;
	}
}
    }
	public function index()
	{
		$data['expedia'] = $this->cron_model->expedia();
		$aa = inputSet($data['expedia']);
		// var_dump($aa);
		$this->cron_model->local($aa);
		// $data['title'] = __CLASS__;
		// $this->slice->view('template/header', $data);
		// $this->slice->view('allstatus_view', $data);
		// $this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
