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
        <title>Error 404</title>
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
        <link rel="apple-touch-icon" sizes="180x180" href="<?php  echo config_item("base_url").'assets/'; ?>raa.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php  echo config_item("base_url").'assets/'; ?>raa.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php  echo config_item("base_url").'assets/'; ?>raa.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?php  echo config_item("base_url")."assets/";  ?>assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="<?php  echo config_item("base_url")."assets/";  ?>assets/vendors/css/base/elisyam-1.5.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body>

        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?php  echo config_item("base_url")."assets/";  ?>ra.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
      
        <div class="container-fluid no-padding h-100">
            <div class="row justify-content-center align-items-center h-100">
                <!-- Begin Left Content -->
                <div class="col-xl-12 collg-12 no-padding d-flex justify-content-center">
                    <!-- Begin Error -->
                    <div class="error-02 mx-auto mb-3 text-center">
                        <img src="<?php  echo config_item("base_url").'assets/'; ?>ra.png">
                        <h1 class="text-gradient-03">404</h1>
                        <h2>This page cannot be found! </h2>
                        
                        <a href="<?php  echo config_item("base_url");  ?>" class="btn btn-gradient-01">
                            Go to Dashboard
                        </a>
                    </div>
                    <!-- End Error -->                        
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
  
                <!-- End Right Content -->
            </div> 
            <!-- End Row -->
        </div>
        <!-- End Container -->
        <!-- Begin Vendor Js -->
        <script src="<?php  echo config_item("base_url")."assets/";  ?>assets/vendors/js/base/jquery.min.js"></script>
        <script src="<?php  echo config_item("base_url")."assets/";  ?>assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="<?php  echo config_item("base_url")."assets/";  ?>assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>