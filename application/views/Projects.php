<style type="text/css">
	.project-link {
    position: absolute;
    display: none;
    right: 15%;
    bottom: 35%;
    left: 15%;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #fff;
    text-align: center;
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

<div class="container mt-3">
	<div class="row">
		<?php
			if ($this->uri->segment(2)) {
		?>
		<div class="col-md-12 title mb-1">
			<h5 class="float-left"><?php echo $category->cat_name; ?></h5>
		</div>	
		<?php
			}
		?>
		<?php
		foreach($projects as $key => $project)
    {
  	?>
  	<div class="col-md-12 p-2 project-image" data-key="<?php echo $key; ?>">
  	<a href="<?php echo base_url(); ?>project_detail/<?php echo $project->proj_id; ?>">
		  <div class="img project-iamge w-100" style="background-image: url(<?php echo base_url() ?>assets/images/<?php echo $project->pict_url; ?>); background-size: cover;"></div>
	</a>
  		<!-- <div class="project-link"> -->
        <!-- <h5><?php echo $project->proj_name; ?></h5> -->
        <!-- <a href="<?php echo base_url(); ?>project_detail/<?php echo $project->proj_id; ?>" class="btn btn-sm btn-outline-light">VIEW THIS PROJECT</a> -->
	  <!-- </div> -->
	  <h5 class="text-right" style="font-size: 15px; font-weight: normal;"><?php echo $project->proj_name; ?></h5>
  	</div>	  	
  	<?php
  		}
  	?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var length = $(".project-image").length;
		var length = Math.ceil(length/6);
		for (var i=0; i<length; i++) {
			$(".project-image ").eq(0+i*6).attr('class','col-md-6 p-2 project-image');
			$(".project-image > a > .img").eq(0+i*6).css('height','250px');
			$(".project-image").eq(1+i*6).attr('class','col-md-6 p-2 project-image');
			$(".project-image > a > .img").eq(1+i*6).css('height','250px');
			$(".project-image").eq(2+i*6).attr('class','col-md-5 p-2 project-image');
			$(".project-image > a > .img").eq(2+i*6).css('height','400px');
			$(".project-image").eq(3+i*6).attr('class','col-md-7 p-2 project-image');
			$(".project-image > a > .img").eq(3+i*6).css('height','400px');
			$(".project-image").eq(4+i*6).attr('class','col-md-7 p-2 project-image');
			$(".project-image > a > .img").eq(4+i*6).css('height','250px');
			$(".project-image").eq(5+i*6).attr('class','col-md-5 p-2 project-image');
			$(".project-image > a > .img").eq(5+i*6).css('height','250px');
		}		

		// $(".project-iamge").hover(
		// 	function() {
		// 		$(this).css("filter", "brightness(80%)");
		// 		$(this).next().css("display", "block");
		// 	},

		// 	function() {
		// 		$(this).css("filter", "brightness(100%)");
		// 		$(this).next().css("display", "none");
		// 	}
		// );

		$(".project-link").hover(
			function() {
				$(this).prev().css("filter", "brightness(80%)");
				$(this).css("display", "block");
			},

			function() {
				$(this).prev().css("filter", "brightness(100%)");
				$(this).css("display", "none");
			}
		);

		$('.project-iamge').on('touchstart', function (e) {
	    'use strict'; //satisfy code inspectors
	    var link = $(this); //preselect the link
	    $(this).css("filter", "brightness(80%)");
			$(this).next().css("display", "block");
		});

		$(".nav-link").first().css('font-weight', 'bold');	
	});
</script>