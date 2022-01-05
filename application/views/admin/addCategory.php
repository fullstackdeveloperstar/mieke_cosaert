<style type="text/css">
  .required {
    color: red;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Category Management
      <small>Add / New Category</small>
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
            <h3 class="box-title">Enter Category Details</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <?php $this->load->helper("form"); ?>
          <form role="form" id="addCategory" action="<?php echo base_url() ?>admin/addNewCategory" method="post" role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="name">Category Id <span class="required">*</span></label>
                <input type="text" class="form-control" value="" id="catId" name="catId" maxlength="128">
              </div>                               
              <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="" id="name" name="name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="order">Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="" id="order" name="order">
              </div>
              <div class="form-group">
                <label for="online">Online</label>
                <input type="number" class="form-control" value="" id="online" name="online">
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
  
    var addCategoryForm = $("#addCategory");
    
    var validator = addCategoryForm.validate({
      
      rules:{
        catId: { required : true },
        name :{ required : true },
        order :{ required : true },
        pict_url :{ required : true }
      },
      messages:{
        catId :{ required : "This field is required" },
        name :{ required : "This field is required" },
        order :{ required : "This field is required" },
        pict_url :{ required : "This field is required" }
      }
    });
  });
</script>