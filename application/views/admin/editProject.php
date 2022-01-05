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
      <small>Add / Edit Project</small>
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
          <form role="form" id="editProject" action="<?php echo base_url() ?>admin/updateProject" method="post" role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="name">Category <span class="required">*</span></label>
                <select class="form-control" id="cat_name" name="cat_name">
                  <option value="<?php echo $proInfo->cat_id; ?> <?php echo $proInfo->cat_name; ?>"><?php echo $proInfo->cat_name; ?></option>
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
                <input type="number" class="form-control" value="<?php echo $proInfo->proj_id; ?>" id="proj_id" name="proj_id">
                <input type="hidden" class="form-control" value="<?php echo $proInfo->id; ?>" id="id" name="id">
              </div>
              <div class="form-group">
                <label for="proj_name">Project Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $proInfo->proj_name; ?>" id="proj_name" name="proj_name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="proj_order">Project Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="<?php echo $proInfo->proj_order; ?>" id="proj_order" name="proj_order">
              </div>
              <div class="form-group">
                <label for="online">Project Online</label>
                <input type="number" class="form-control" value="<?php echo $proInfo->online; ?>" id="online" name="online">
              </div>
              <div class="form-group">
                <label for="pict_id">Picture Id <span class="required">*</span></label>
                <input type="number" class="form-control" value="<?php echo $proInfo->pict_id; ?>" id="pict_id" name="pict_id">
              </div>
              <div class="form-group">
                <label for="pict_name">Picture Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $proInfo->pict_name; ?>" id="pict_name" name="pict_name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="pict_order">Picture Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="<?php echo $proInfo->pict_order; ?>" id="pict_order" name="pict_order">
              </div>
              <div class="form-group">
                <label for="pict_online">Picture Online</label>
                <input type="number" class="form-control" value="<?php echo $proInfo->pict_online; ?>" id="pict_online" name="pict_online">
              </div>
              <div class="form-group">
                <label for="pict_url">Picture Url <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $proInfo->pict_url; ?>" id="pict_url" name="pict_url" maxlength="128">
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" class="btn btn-primary" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
    </div>    
  </section>

</div>
<script type="text/javascript">
  $(document).ready(function(){  
    var editProjectForm = $("#editProject");
    
    var validator = editProjectForm.validate({
      
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