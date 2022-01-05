<style type="text/css">
	.btn-outline-light {
		width: 150px;
		color: gray;
		border: 1px solid lightgray;
	}

	.title {
		font-family: Assistant ;
		font-style: normal;
		font-weight: normal;
		font-size : 22px;
		text-transform: uppercase;
	}

	.content {
		font-family: Assistant ;
		font-style: normal;
		font-weight: normal;
		font-size : 14px;
		text-transform: uppercase;
	}
</style>

<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-md-11 mx-auto">
			<p class="title">MIEKE COSAERT</p>
		</div>
		<div class="col-md-10 mt-5 mx-auto">
			<div class="row">
				<div class="col-md-4 content">
					<h6>Lorem ipsum dolor sit amet</h6>
					<p>Lorem straat, 68000 loremipsumcity</p>
					<p>info@mcosaert.be</p>
					<p>+32 350 50 50</p>
					<img class="img-fluid" src="<?php echo base_url(); ?>assets/images/map.jpg" alt="map" />
				</div>
				<div class="col-md-8">
					<form>
						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group-inline">
							    <label for="first_name">NAAM</label>
							    <input type="text" class="form-control" id="first_name">
							  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group-inline">
							    <label for="last_name">VOORNAAM</label>
							    <input type="text" class="form-control" id="last_name">
							  </div>
							</div>
						</div>					  
					  <div class="form-group-inline mb-4">
					    <label for="email">EMAIL</label>
					    <input type="email" class="form-control" id="email">
					  </div>
					  <div class="form-group-inline mb-4">
					    <label for="message">BERICHT</label>
					    <textarea id="issueinput8" rows="5" class="form-control" name="message" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="message"></textarea>
					  </div>
					  <button type="submit" class="float-right btn btn-outline-light btn-default">SEND</button>
					</form>
				</div>
			</div>
		</div>	
	</div>	
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".nav-link").eq(2).css('font-weight', 'bold');
	});
</script>