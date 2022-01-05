<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
      <small>Control panel</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $count_category; ?></h3>
            <p>Categories</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $count_project; ?></h3>
            <p>Projects</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>