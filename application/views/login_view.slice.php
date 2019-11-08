<?php 
error_reporting(0);
session_start();

if ($_SESSION['username']!= NULL) {
    header(base_url());
}

 ?>
<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Property Operation's Dashboard</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
  <link rel="icon" href="{{ base_url('assets/raa.png')}}" type="image/png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ base_url('assets/assets/vendors/css/base/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ base_url('assets/assets/vendors/css/base/elisyam-1.5.min.css')}}">
        <link rel="stylesheet" href="{{ base_url('assets/assets/css/animate/animate.min.css')}}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-white">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="{{ base_url('assets/ra.png')}}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->

          <!-- cek pesan notifikasi -->

  <!--  -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <!-- <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12 no-padding">
                    <div class="elisyam-bg background-03">
                        <div class="elisyam-overlay overlay-08"></div>
                        <div class="authentication-col-content-2 mx-auto text-center">
                            <div class="logo-centered">
                                <a href="db-default.html">
                                    <img src="assets/img/logo.png" alt="logo">
                                </a>
                            </div>
                            <h1>Join Our Community</h1>
                            <span class="description">
                                Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas. 
                            </span>
                            <ul class="login-nav nav nav-tabs mt-5 justify-content-center" role="tablist" id="animate-tab">
                                <li><a class="active" data-toggle="tab" href="#singin" role="tab" id="singin-tab" data-easein="zoomInUp">Sign In</a></li>
                                <li><a data-toggle="tab" href="#signup" role="tab" id="signup-tab" data-easein="zoomInRight">Sign Up</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-12 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form-2 mx-auto">
                        <div class="tab-content" id="animate-tab-content">
                            <!-- Begin Sign In -->
                            <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">
                                <?php 
  if(isset($_GET['message'])){
    if($_GET['message'] == "failed"){
      echo "<div class='alert alert-danger alert-dissmissible fade show' role='alert'>Login Failed! username and password wrong!</div>";
    }else if($_GET['message'] == "logout"){
      echo "<div class='alert alert-secondary alert-dissmissible fade show' role='alert'>You are succesfully logout</div>";
    }else if($_GET['message'] == "need_login"){
      echo "<div class='alert alert-info alert-dissmissible fade show' role='alert'>You have to login to access</div>";
    }
  }
  ?>


                                <img src="{{ base_url('assets/ra.png')}}" style="display: block; margin: auto; max-height: 80px;"><br>
                                <h3 style="text-align: center;">Property Operation's Dashboard</h3><br><br>
                                <h3 align="center">Sign In</h3>
                                <form method="post" action="{{ base_url('login/logincheck') }}">
                                    <div class="group material-input">
                          <input type="text" name="username" required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Email</label>
                                    </div>
                                    <div class="group material-input">
                          <input type="password" name="password" required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Password</label>
                                    </div>

                                                                    <div class="sign-btn text-center">
                                  <input type="submit" value="Sign In" class="btn btn-lg btn-gradient-01">
<!--                                     <a href="login-check.php" class="btn btn-lg btn-gradient-01">
                                        Sign In
                                    </a -->
                                </div>
                                </form>
                                <div class="row">
                                    <!-- <div class="col text-left">
                                        <div class="styled-checkbox">
                                            <input type="checkbox" name="checkbox" id="remeber">
                                            <label for="remeber">Remember me</label>
                                        </div>
                                    </div> -->
                                   <!--  <div class="col text-right">
                                        <a href="pages-forgot-password.html">Forgot Password ?</a>
                                    </div> -->
                                </div>

                            </div>
                            <!-- End Sign In -->
                            <!-- Begin Sign Up -->
                            <div role="tabpanel" class="tab-pane" id="signup" aria-labelledby="signup-tab">
                                <h3>Create An Account</h3>
                                <form>
                                    <div class="group material-input">
                                        <input type="text" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email</label>
                                    </div>
                                    <div class="group material-input">
                                        <input type="password" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Password</label>
                                    </div>
                                    <div class="group material-input">
                                        <input type="password" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Confirm Password</label>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col text-left">
                                        <div class="styled-checkbox">
                                            <input type="checkbox" name="checkbox" id="agree">
                                            <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <a href="db-default.html" class="btn btn-lg btn-gradient-01">
                                        Sign Up
                                    </a>
                                </div>
                            </div>
                            <!-- End Sign Up -->
                        </div>
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->    
        <!-- Begin Vendor Js -->
        <script src="{{ base_url('assets/assets/vendors/js/base/jquery.min.js') }}"></script>
        <script src="{{ base_url('assets/assets/vendors/js/base/core.min.js') }}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{ base_url('assets/assets/vendors/js/app/app.min.js') }}"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <script src="{{ base_url('assets/assets/js/components/tabs/animated-tabs.min.js') }}"></script>
        <!-- End Page Snippets -->
    </body>
</html>