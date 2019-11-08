<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // $this->load->database();
        // $this->load->model('validation_model');
    }
	public function index()
	{
		function tomvol($ge,$que1,$que2){
			if ($ge==""){
			$di = "";
			}else{$di = "$que1".str_replace(",","','",$ge)."$que2";
				};
			return $di;

			}

	function issetbutton($a){
if( isset($_POST['submit']) ) {
  echo ($_POST["$a"]);
} else {
echo "";
};

};


function fatal($channel,$fatal){

global $row;
if ($channel==$fatal) {
	echo $row["description"];
}else {echo "No Fatal";}


}

function check($apa){
	global $key;
if( (array_search($key['date'],array_column($apa, 'timestamp1')))===false){
return "0";
}else{
return $apa[array_search($key['date'], array_column($apa, 'timestamp1'))]["total"];
};

}
if( isset($_POST['submit']) ) {
		    $this->load->database();
	        $this->load->model('validation_model');
			$nid = tomvol($_POST['nid'],"where n.nid in ('", "')" );
			$nidvalidation = tomvol($_POST['nid'],"and c.nid in ('", "')" );
			$data['optincolor'] = $this->validation_model->optincolor($nid );
			$data['validation'] = $this->validation_model->validation($nid, $nidvalidation );

		}else{
			$data['optincolor'] = array();
			$data['validation'] = array();
		}
		$data['title'] = __CLASS__;
		$data['i'] = 1;
		$this->slice->view('template/header', $data);
		$this->slice->view('tools/redawning/validation_view', $data);
		$this->slice->view('template/footer', $data);
		// $this->load->view('welcome_message');
	}
}
