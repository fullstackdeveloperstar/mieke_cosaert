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

  .carousel-caption h5 {
    font-family: Assistant;
    font-style: normal;
    font-weight: bold;
    font-size : 20px;
    text-transform: none;
  }

  .carousel-caption a {
    font-family: Assistant ;
    font-style: normal;
    font-weight: normal;
    font-size : 16px;
    text-transform: uppercase;
    margin-left: -11px;
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
  
 .chevron::before {
	border-style: solid;
	border-width: 0.25em 0.25em 0 0;
	content: '';
	display: inline-block;
	height: 1.5em;
	left: 0.15em;
	position: relative;
	top: 0.15em;
	transform: rotate(-45deg);
	vertical-align: top;
	width: 1.5em;
}

.chevron.bottom:before {
	top: 0;
	transform: rotate(135deg);
}

.view-project{
    position: fixed;
    bottom: 20px;
    color: white;
}


.carousel-custom{
    height: 100vh;
    position: relative;
}

.carousel-item{
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: block;
    opacity: 0;
    transition: all 3s ease;
    text-align: center;
    background-size: cover;
    background-position: center;
}

.carousel-item.active{
    opacity: 1;
    transition: all 3s ease;
}

.project-title{
    position: absolute;
    bottom: 50px;
    text-align: center;
    width: 100%;
    color: white;
}
</style>

<div class="carousel-custom">
    <?php 
        foreach($categories as $key => $category)
        {
      ?>
       <div class="carousel-item carousel-item-<?=$key?> <?php echo $key == 0 ? 'active' :  ''?>" style="background-image: url(<?php echo base_url() ?>assets/images/<?php echo $category->picture_url; ?>);">
           
           <!--<h5 class="project-title"><?php echo $category->cat_name; ?></h5>-->
          <a href="<?php echo base_url(); ?>projects/<?php echo $category->cat_id; ?>"  class="view-project">
             <span class="chevron bottom"></span>
          </a>
           </div>
      <?php
        }
      ?>
</div>

<script>
  $(document).ready(function() {
    var activeKey = 1;
    setInterval(function(){
        $(".carousel-item").removeClass("active");
        $('.carousel-item-' + activeKey).addClass("active");
        activeKey ++;
        activeKey = activeKey % 4;
    }, 4000);
  });
</script> 