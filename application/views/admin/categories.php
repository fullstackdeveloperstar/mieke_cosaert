<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Category Management
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
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
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addCategory"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Categories List</h3>
            <div class="box-tools">
              <form action="<?php echo base_url() ?>admin/categoryListing" method="POST" id="searchList">
                <div class="input-group">
                  <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table text-center table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Order</th>
                  <th>Online</th>
                  <th>Pic Url</th>
                  <th class="text-center">Actions</th>
                </tr>                
              </thead>
              <tbody>
                <?php
                  foreach ($categoryRecords as $key => $category) {
                ?>
                <tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><?php echo $category->cat_name; ?></td>
                  <td><?php echo $category->cat_order; ?></td>
                  <td><?php echo $category->online; ?></td>
                  <td><?php echo $category->picture_url; ?></td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editCategory/'.$category->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm btn-danger deleteCat" href="#" data-id="<?php echo $category->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>                  
                <?php  
                  }
                ?>
              </tbody>
            </table>

          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('ul.pagination li a').click(function (e) {
      e.preventDefault();            
      var link = jQuery(this).get(0).href;            
      var value = link.substring(link.lastIndexOf('/') + 1);
      jQuery("#searchList").attr("action", baseURL + "admin/categoryListing/" + value);
      jQuery("#searchList").submit();
    });

    jQuery(document).on("click", ".deleteCat", function(){
      var id = $(this).data("id"),
        hitURL = baseURL + "admin/deleteCategory",
        currentRow = $(this);
      var confirmation = confirm("Are you sure to delete this category ?");
      
      if(confirmation)
      {
        jQuery.ajax({
        type : "POST",
        dataType : "json",
        url : hitURL,
        data : { id : id } 
        }).done(function(data){
          console.log(data);
          currentRow.parents('tr').remove();
          if(data.status = true) { alert("Category successfully deleted"); }
          else if(data.status = false) { alert("Category deletion failed"); }
          else { alert("Access denied..!"); }
        });
      }
    });
  });
</script>
