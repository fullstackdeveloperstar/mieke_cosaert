<style type="text/css">
  .required {
    color: red;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Project Management
      <small>Add / New Project</small>
    </h1>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-md-2"></div>
      <!-- left column -->
      <div class="col-md-8" style="margin:0 auto;">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Enter Project Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <?php $this->load->helper("form"); ?>
          <form role="form" id="addProject" action="<?php echo base_url() ?>admin/addNewProject" method="post" role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="name">Category <span class="required">*</span></label>
                <select class="form-control" id="cat_name" name="cat_name">
                  <option value=""></option>
                  <?php
                  foreach ($categories as $category) {
                  ?>
                  <option value="<?php echo $category->cat_id; ?> <?php echo $category->cat_name;?>">
                    <?php echo $category->cat_name; ?>
                  <?php } ?>
                </select>
              </div> 
              <div class="form-group">
                <label for="proj_id">Project Id <span class="required">*</span></label>
                <input type="number" class="form-control" value="" id="proj_id" name="proj_id">
              </div>                               
              <div class="form-group">
                <label for="proj_name">Project Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="" id="proj_name" name="proj_name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="proj_order">Project Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="" id="proj_order">
              </div>
              <div class="form-group">
                <label for="online">Project Online</label>
                <input type="number" class="form-control" value="" id="online" name="online">
              </div>
              <div class="form-group">
                <label for="pict_id">Picture Id <span class="required">*</span></label>
                <input type="number" class="form-control" value="" id="pict_id" name="pict_id">
              </div>
              <div class="form-group">
                <label for="pict_name">Picture Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="" id="pict_name" name="pict_name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="pict_order">Picture Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="" id="pict_order" name="pict_order">
              </div>
              <div class="form-group">
                <label for="pict_online">Picture Online</label>
                <input type="number" class="form-control" value="" id="pict_online" name="pict_online">
              </div>
              <div class="form-group">
                <label for="pict_url">Picture Url <span class="required">*</span></label>
                <input type="text" class="form-control" value="" id="pict_url" name="pict_url" maxlength="128">
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" class="btn btn-primary" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
          ?>
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error'); ?>                    
          </div>
        <?php } ?>
        <?php  
        $success = $this->session->flashdata('success');
        if($success)
        {
          ?>
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-md-12">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
          </div>
        </div>
      </div>
    </div>    
  </section>

</div>
<script type="text/javascript">
  $(document).ready(function(){
  
    var addProjectForm = $("#addProject");
    
    var validator = addProjectForm.validate({
      
      rules:{
        cat_name: { required : true },
        proj_id: { required : true },
        proj_name :{ required : true },
        proj_order :{ required : true },
        pict_id :{ required : true },
        pict_name :{ required : true },
        pict_order :{ required : true },
        pict_url :{ required : true }
      },
      messages:{
        cat_name :{ required : "This field is required" },
        proj_id :{ required : "This field is required" },
        proj_name :{ required : "This field is required" },
        proj_order :{ required : "This field is required" },
        pict_id :{ required : "This field is required" }
        pict_name :{ required : "This field is required" }
        pict_order :{ required : "This field is required" }
        pict_url :{ required : "This field is required" }
      }
    });
  });
</script>