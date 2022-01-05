<style type="text/css">
  .carousel-caption h5 {
    font-family: Assistant;
    font-style: normal;
    font-weight: bold;
    font-size : 28px;
    text-transform: uppercase;
  }

  .carousel-caption a {
    font-family: Assistant ;
    font-style: normal;
    font-weight: normal;
    font-size : 16px;
    text-transform: uppercase;
  }
</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php 
      foreach($categories as $key => $category)
      {
    ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>"></li>
    <?php
      }
    ?>
  </ol>
  <div class="carousel-inner">
    <?php 
      foreach($categories as $category)
      {
    ?>
    <div class="carousel-item">
      <img class="d-block w-100" style="height: 100vh;" src="<?php echo base_url() ?>assets/images/<?php echo $category->picture_url; ?>" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $category->cat_name; ?></h5>
        <a href="<?php echo base_url(); ?>projects/<?php echo $category->cat_id; ?>" type="button" class="btn btn-outline-light">VIEW PROJECTS</a>
      </div>
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

<script>
  $(document).ready(function() {
    $(".carousel-item:first-child").addClass("active");
  });
</script> 