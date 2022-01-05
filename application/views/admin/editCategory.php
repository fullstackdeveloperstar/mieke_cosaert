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
      <small>Add / Edit Category</small>
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
          <form role="form" id="editCategory" action="<?php echo base_url() ?>admin/updateCategory" method="post" role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="catId">Cat Id <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $catInfo->cat_id; ?>" id="catId" name="catId" maxlength="128">
                <input type="hidden" class="form-control" value="<?php echo $catInfo->id; ?>" id="id" name="id">
              </div>                               
              <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $catInfo->cat_name; ?>" id="name" name="name" maxlength="128">
              </div>
              <div class="form-group">
                <label for="order">Order <span class="required">*</span></label>
                <input type="number" class="form-control" value="<?php echo $catInfo->cat_order; ?>" id="order" name="order">
              </div>
              <div class="form-group">
                <label for="online">Online</label>
                <input type="number" class="form-control" value="<?php echo $catInfo->online; ?>" id="online" name="online">
              </div>
              <div class="form-group">
                <label for="pict_url">Picture Url <span class="required">*</span></label>
                <input type="text" class="form-control" value="<?php echo $catInfo->picture_url; ?>" id="pict_url" name="pict_url" maxlength="128">
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
    var editCategoryForm = $("#editCategory");
    
    var validator = editCategoryForm.validate({
      
      rules:{
        catId :{ required : true },
        name :{ required : true },
        pict_name :{ required : true },
        pict_url :{ required : true }
      },
      messages:{
        catId :{ required : "This field is required" },
        name :{ required : "This field is required" },
        pict_name :{ required : "This field is required" },
        pict_url :{ required : "This field is required" }
      }
    });
  });
</script>