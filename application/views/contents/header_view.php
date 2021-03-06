<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mieke Cosaert</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/MiekeLogo.png">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="<?php echo base_url(); ?>assets/bower_components/Assistant_web/stylesheet.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .nav-link {
      font-family: 'Assistant';
      font-style: normal;
      font-weight: normal;
      font-size: 15px;
      text-transform: uppercase;
    }

    <?php
    if (!$this->uri->segment(1)) {
    ?>.navbar {
      position: fixed;
      width: 100%;
      z-index: 10;
    }

    .nav-link {
      color: white !important;
    }

    .carousel-caption {
      /*bottom: 43vh !important;*/
    }

    .carousel-control-prev-icon {
      width: 30px;
      height: 45px;
    }

    .carousel-control-next-icon {
      width: 30px;
      height: 45px;
    }

    <?php
    }
    ?>.carousel-indicators li {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    @font-face {
      font-family: 'Gotham';
      src: url('<?=base_url()?>assets/Gotham/Gotham Book.otf');
    }

    body, *{
      font-family: Gotham !important;
    }
    
    .navbar-toggler{
        padding: 5px!important;
    }
  </style>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light pt-4 pl-5">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">
      <?php
      if (!$this->uri->segment(1)) {
      ?>
        <img class="d-block" src="<?php echo base_url(); ?>assets/images/MiekeLogo_white.png" style="width: 70px;" alt="Logo">
      <?php
      } elseif ($this->uri->segment(1) == "project_detail") {
      ?>
        <img class="d-block" src="<?php echo base_url(); ?>assets/images/MiekeLogo_white.png" style="width: 70px;" alt="Logo">
      <?php
      } else {
      ?>
        <img class="d-block" src="<?php echo base_url(); ?>assets/images/MiekeLogo_black.png" style="width: 70px;" alt="Logo">
      <?php
      }
      ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="justify-content: flex-end;">
      <ul class="navbar-nav mt-2 mt-lg-0 mr-1">
        <li class="nav-item dropdown mr-1">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PROJECTEN
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            foreach ($categories as $category) {
            ?>
              <a class="dropdown-item" href="<?php echo base_url(); ?>projects/<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></a>
            <?php
            }
            ?>
          </div>
        </li>
        <li class="nav-item mr-1">
          <a class="nav-link" href="<?php echo base_url(); ?>about">OVER ONS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>contact">CONTACT</a>
        </li>
      </ul>
    </div>
  </nav>