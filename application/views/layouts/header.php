<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <!-- CSS bootstrap 4.5 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- FONTAWESOME 5 CDN -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
  <!-- MAIN / GLOBAL CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
  <!-- SITE_URL to be used in JS -->
  <div id="baseUrl" data-url="<?php echo site_url(); ?>"></div>

</head>
<body>
  
<div class="container mt-4">
  
  <!-- makeshift navbar lol -->
  <div class="navbar-stripe mb-4">
    <div class="row">
      <div class="col">
        <a href="<?php echo site_url(); ?>" class="btn btn-primary"><i class="fas fa-home"></i></a>
        <span class="navbar-title text-uppercase font-weight-bold px-2"><?php echo $title; ?></span>
      </div>
    </div>
  </div>
  
<?php $this->load->view('layouts/success_display'); ?>
<?php $this->load->view('layouts/error_display'); ?>