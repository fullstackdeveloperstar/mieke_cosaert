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

<div class="container">
	<div class="row">
		<?php
			if ($this->uri->segment(2)) {
		?>
		<div class="col-md-12">
			<h5 class="float-left"><?php echo $category->cat_name; ?></h5>
			<p class="float-right"><i class="fa fa-close" style="color: gray;font-size: 20px;"></i></p>
		</div>	
		<?php
			}
		?>		
	</div>
	<div class="row">
		<?php
		foreach($projects as $project)
      {
  	?>
  	<div class="col-md-6 p-2">
  		<img class="project-iamge w-100" style="height: 50vh;" src="<?php echo base_url() ?>assets/images/<?php echo $project->pict_url; ?>" alt="project">
  		<div class="project-link">
        <h5><?php echo $project->proj_name; ?></h5>
        <a href="<?php echo base_url(); ?>project_detail/<?php echo $project->proj_id; ?>" type="button" class="btn btn-sm btn-outline-light">VIEW THIS PROJECT</a>
      </div>
  	</div>	  	
  	<?php
  		}
  	?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".project-iamge").hover(
			function() {
				$(this).css("filter", "brightness(70%)");
				$(this).next().css("display", "block");
			},

			function() {
				$(this).css("filter", "brightness(100%)");
				$(this).next().css("display", "none");
			}
		);

		$(".project-link").hover(
			function() {
				$(this).prev().css("filter", "brightness(70%)");
				$(this).css("display", "block");
			},

			function() {
				$(this).prev().css("filter", "brightness(100%)");
				$(this).css("display", "none");
			}
		);

		$(".nav-link").first().css('font-weight', 'bold');	
	});	
</script>  	