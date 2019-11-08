<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
	public function index()
	{
		$data['nama'] = "budi hermawan";
		$this->slice->view('login_view', $data);
		// $this->load->view('welcome_message');
	}

		public function logincheck()
	{
session_start();

// menghubungkan dengan koneksi


$koneksi = mysqli_connect("localhost","root","","ra");
 
// Check connection
if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
echo $username;
echo $password;
echo base_url();

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
var_dump($_SESSION['redirect_url']);
echo "string";
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
var_dump($cek);
if($cek > 0){
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";

    if (isset($_SESSION['redirect_url'])) {
    	redirect(base_url($_SESSION['redirect_url']));
    	unset($_SESSION['redirect_url']);
    }
    redirect(base_url());
}else{
    redirect(base_url('login?message=failed'));
}
	}

	public function logout()
	{
session_start();
 
// menghapus semua session
session_destroy();
 
// mengalihkan halaman sambil mengirim pesan logout
redirect(base_url('login?message=logout'));
	}
}
