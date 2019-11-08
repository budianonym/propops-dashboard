<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // $this->load->database();
        // $this->load->model('backlog_model');
function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

    function colorr($a){
        if ($a=='Active') {
            echo "<font color='green'>".$a."</font>";
        }
        else if ($a=='Inactive'){
            echo "<font color='red'>".$a."</font>";
        } else{echo "<font style='color:#635c00;''>".$a."</font>";};


    }


    function issetbutton($a){
if( isset($_POST['submit']) ) {
  echo ($_POST["$a"]);
} else {
echo "";
};

};

function fontColor($a){
    if ($a == 'Active') {
        return 'green';
    }
    elseif ($a == 'Inactive') {
       return 'red';
    }
    else{
        return 'yellow';
    }
}
    }
    public function index()
	{
		// $data['backlog'] = $this->backlog_model->get_backlog();
		$data['title'] = 'Expedia Content Score';
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('score');
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
