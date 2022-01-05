<style type="text/css">
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

  .project-link h5 {
    font-family: Assistant;
    font-style: normal;
    font-weight: bold;
    font-size : 28px;
    text-transform: uppercase;
  }

  .project-link a {
    font-family: Assistant;
    font-style: normal;
    font-weight: normal;
    font-size : 16px;
    text-transform: uppercase;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-11 mx-auto mt-2">
      <h5 class="float-left"><?php echo $project_details[0]->proj_name; ?></h5>
      <p class="float-right"><i class="fa fa-close" style="color: gray;font-size: 20px;"></i></p>
    </div>
  </div>  
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
        <img class="d-block w-90 mx-auto" style="height: 70vh;" src="<?php echo base_url() ?>assets/images/<?php echo $project_detail->pict_url; ?>" alt="First slide">
      </div>
      <?php
        }
      ?>
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
  <p></p>
</div>

<script>
  $(document).ready(function() {
    $(".carousel-item:first-child").addClass("active");
    $(".nav-link").first().css('font-weight', 'bold');
  });
</script> 