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
      <small>Edit Project</small>
    </h1>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-md-2"></div>
      <!-- left column -->
      <div class="col-md-12" style="margin:0 auto;">
        <!-- general form elements -->
        <!-- form start -->
        <?php $this->load->helper("form"); ?>
        <form role="form" id="editProject" action="<?php echo base_url(); ?>admin/updateProject" method="post">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Edit Project Details</h3>
            </div><!-- /.box-header -->          
            <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="id" value="<?=$proInfo->id?>" />
                  <input type="hidden" name="cat_property" value="" />
                  <label for="name">Category <span class="required">*</span></label>
                  <select class="form-control edit-cat" id="cat_name" name="cat_name">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                    <option value="<?php echo $category->cat_id; ?> <?php echo $category->cat_name;?>" <?php echo $category->cat_id == $proInfo->cat_id ? "selected": ""?>>
                      <?php echo $category->cat_name; ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6"> 
                <div class="form-group">
                  <label for="proj_id">Project Id <span class="required">*</span></label>
                  <input type="number" class="form-control edit-cat" value="<?php echo $proInfo->proj_id; ?>" id="proj_id" name="proj_id">
                </div> 
              </div>               
              <div class="col-md-4">
                <div class="form-group">
                  <label for="proj_name">Project Name <span class="required">*</span></label>
                  <input type="text" class="form-control edit-cat" value="<?php echo $proInfo->proj_name; ?>" id="proj_name" name="proj_name" maxlength="128">
                </div>
              </div>                              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="proj_order">Project Order <span class="required">*</span></label>
                  <input type="number" class="form-control edit-cat" value="<?php echo $proInfo->proj_order; ?>" id="proj_order" name="proj_order">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="online">Project Online</label>
                  <input type="number" class="form-control edit-cat" value="<?php echo $proInfo->online; ?>" id="online" name="proj_online">
                </div>
              </div>             
            </div><!-- /.box-body -->                     
          </div>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Enter Picture Details</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-responsive text-center">
                <thead>
                  <th>Picture Id</th>
                  <th>Picture Name</th>
                  <th>Picture Order</th>
                  <th>Picture Online</th>
                  <th>Picture Url</th>
                  <th>Action</th>
                </thead>
                <tbody id="properties">
                  <tr>
                    <td>
                      <input type="number" class="form-control" value="" name="pict_id" id="pict_id">
                      <span class="error error_message error_id error_id_new"></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" value="" id="pict_name" name="pict_name" maxlength="128">
                      <span class="error error_message error_name error_name_new"></span>
                    </td>
                    <td>
                      <input type="number" class="form-control" value="" name="pict_order" id="pict_order">
                      <span class="error error_message error_order error_order_new"></span>
                    </td>
                    <td>
                      <input type="number" class="form-control" value="" id="pict_online" name="pict_online">
                      <span class="error error_message error_online error_online_new"></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" value="" id="pict_url" name="pict_url" maxlength="128">
                      <span class="error error_message error_url error_url_new"></span>
                    </td>
                    <td>
                      <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                  <?php
                    foreach ($picInfo as $key => $pic) {
                  ?>
                  <tr>
                    <td>
                      <input type="hidden" name="picture_property-<?php echo $key; ?>" value="">
                      <input type="number" class="form-control edit-pict" value="<?php echo $pic->pict_id; ?>" name="pict_id-<?php echo $key; ?>">
                      <span class="error error_message error_id"></span>
                    </td>
                    <td>
                      <input type="text" class="form-control edit-pict" value="<?php echo $pic->pict_name; ?>" name="pict_name-<?php echo $key; ?>" maxlength="128">
                      <span class="error error_message error_name"></span>
                    </td>
                    <td>
                      <input type="number" class="form-control edit-pict" value="<?php echo $pic->pict_order; ?>" name="pict_order-<?php echo $key; ?>">
                      <span class="error error_message error_order"></span>
                    </td>
                    <td>
                      <input type="number" class="form-control edit-pict" value="<?php echo $pic->online; ?>" name="pict_online-<?php echo $key; ?>">
                      <span class="error error_message error_online"></span>
                    </td>
                    <td>
                      <input type="text" class="form-control edit-pict" value="<?php echo $pic->picture_url; ?>" name="pict_url-<?php echo $key; ?>" maxlength="128">
                      <span class="error error_message error_url"></span>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger delete-btn" data-key="<?=$pic->pict_id?>"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>                            
            </div>
          </div>
          <div>
            <input type="hidden" id="row" name="row" value="0" />
            <input type="submit" class="btn btn-primary" value="Submit" />
            <input type="reset" class="btn btn-default" value="Reset" />
          </div>  
        </form>
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
    $("#cat_name").children("option:selected").text("<?php echo $proInfo->cat_name; ?>");
    $("#cat_name").children("option:selected").val("<?php echo $proInfo->cat_id; ?> <?php echo $proInfo->cat_name; ?>"); 
    var editProjectForm = $("#editProject");
    
    var validator = editProjectForm.validate({
      
      rules:{
        cat_name: { required : true },
        proj_id: { required : true },
        proj_name :{ required : true },
        proj_order :{ required : true },
        // pict_id :{ required : true },
        // pict_name :{ required : true },
        // pict_order :{ required : true },
        // pict_url :{ required : true }
      },
      messages:{
        cat_name :{ required : "This field is required" },
        proj_id :{ required : "This field is required" },
        proj_name :{ required : "This field is required" },
        proj_order :{ required : "This field is required" },
        // pict_id :{ required : "This field is required" },
        // pict_name :{ required : "This field is required" },
        // pict_order :{ required : "This field is required" },
        // pict_url :{ required : "This field is required" }
      }
    });
  });

  $(document).on("change", "#cat_name", function(){
    var projId = $(this).children("option:selected").val().split(" ")[0];
    $("#proj_id").val(projId);
  });

  $(document).on("change", "#proj_id", function(){
    var pictId = $(this).val();
    $("#pict_id").val(pictId);
  });

  var number = $("#properties tr").length - 1;
  $('#row').val(number);

  $(document).on("click", ".btn-success", function() {
    var valid_status = true;
    
    if ($('#pict_id').val() == "") {
      valid_status = false;
      $('.error_id_new').html("This field is required.");
    } else {
      $('#pict_id ~ span').html("");
    }
    if ($('#pict_name').val() == "") {
      valid_status = false;
      $('.error_name_new').html("This field is required.");
    } else {
      $('#pict_name ~ span').html("");
    }
    if ($('#pict_order').val() == "") {
      valid_status = false;
      $('.error_order_new').html("This field is required.");
    } else {
      $('#pict_order ~ span').html("");
    }
    if ($('#pict_online').val() == "") {
      valid_status = false;
      $('.error_online_new').html("This field is required.");
    } else {
      $('#pict_online ~ span').html("");
    }
    if ($('#pict_url').val() == "") {
      valid_status = false;
      $('.error_url_new').html("This field is required.");
    } else {
      $('#pict_url ~ span').html("");
    }
    if (valid_status == true){
      var new_row = '<tr>' +
        '<td><input type="hidden" name="picture_property-'+number+'" value="new"><input type="number" name="pict_id-'+number+'" class="form-control"  readonly="readonly" value="' + $("#pict_id").val() + '"></td>' +
        '<td><input type="text" name="pict_name-'+number+'" class="form-control"  readonly="readonly" value="' + $("#pict_name").val() + '" ></td>' +
        '<td><input type="number" name="pict_order-'+number+'" class="form-control" readonly="readonly"  value="' + $("#pict_order").val() + '" ></td>' +
        '<td><input type="number" name="pict_online-'+number+'" class="form-control"  readonly="readonly" value="' + $("#pict_online").val() + '"></td>' +
        '<td><input type="text" name="pict_url-'+number+'" class="form-control" readonly="readonly" value="' + $("#pict_url").val() + '"></td>' +
        '<td><button type="buttton" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>' +
        '</tr>';
      $('#properties').append(new_row);
      number++;
      $('#row').val(number);
    }    
  });

  $(document).on("click", ".delete-btn", function() {
    $(this).parent().parent().remove();
    $('#row').val(number);
    number--;

    var pic_key = $(this).data("key");
    // alert(pic_key);

    $.ajax({
      type: "GET",
      url: "/admin/deletepic/" + pic_key
    });
  });

  $(document).on("change", ".edit-cat", function() {
    $("input[name='cat_property']").val("edit");
  });

  $(document).on("change", ".edit-pict", function() {
    $(this).parent().parent().children().eq(0).children().eq(0).val("edit");
  });
</script>