<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zerobacklog extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('zerobacklog_model');
    }
	public function index()
	{
		$data['zerobacklog'] = $this->zerobacklog_model->local();
		// var_dump($data['backlog']);
		$data['title'] = "Backlog Statistic";
		$data['i'] = 1;
 $data['fatalra'] = [];
 $data['pendingra'] = [];
 $data['livenotra'] = [];
 $data['datechart'] = [];
 $data['backlogairbnb'] = [];
 $data['backlogbookingcom'] = [];
 $data['backlogexpedia'] = []; 
 $data['backloghomeaway'] = []; 
 $data['backlogtripadvisor'] = []; 

		$this->slice->view('template/header', $data);
		$this->slice->view('zerobacklog/statistic_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
