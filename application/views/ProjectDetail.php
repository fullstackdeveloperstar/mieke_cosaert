<style type="text/css">
  .navbar {
    position: fixed;
    width: 100%;
    z-index: 10;
  }
  .nav-link {
    color: white !important;
  }
  
  .project-link {
    position: absolute;
    top: 90px;
    left: 5%;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #fff;
    text-align: center;
  }

  .carousel-caption {
    bottom: 43vh !important;
  }
  .carousel-control-prev-icon {
    background-image: url("<?php echo base_url(); ?>assets/images/prev.png");
    width: 30px;
    height: 45px;
  }
  .carousel-control-next-icon {
    background-image: url("<?php echo base_url(); ?>assets/images/next.png");
    width: 30px;
    height: 45px;
  }
</style>
 
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php 
      foreach($project_details as $key => $project_detail)
      {
    ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>"></li>
    <?php
      }
    ?>
  </ol>
  <div class="carousel-inner">
    <?php 
      foreach($project_details as $project_detail)
      {
    ?>
    <div class="carousel-item">
      <div style="background-image: url(<?php echo base_url() ?>assets/images/<?php echo $project_detail->pict_url; ?>); height: 100vh; background-size: cover;    background-position: center;" ></div>
      
    </div>
    <?php
      }
    ?>
    
    <div class="col-md-4 project-link title">
      <h5 class="float-left"><?php echo $project_details[0]->proj_name; ?></h5>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<script>
  $(document).ready(function() {
    $(".carousel-item:first-child").addClass("active");
    $(".nav-link").first().css('font-weight', 'bold');

    $(".navbar-toggler").click(function() {
      if ($(".navbar-toggler").attr("aria-expanded") == "false") {
        $(".project-link").css("top", "210px");
        $("#navbarDropdown").click(function() {
          if ($("#navbarDropdown").attr("aria-expanded") == "false") {
            $(".project-link").css("top", "360px");
          } else {
            $(".project-link").css("top", "210px");
          }
        });
      } else {
        $(".project-link").css("top", "90px");
      }
    });    
  });
</script> 