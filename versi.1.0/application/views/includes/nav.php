<nav class="navbar navbar-inverse navbar-static-top">

  <!-- Brand and toggle get grouped for better mobile display -->
  <header class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="index.html" class="navbar-brand">
      <img src="<?=base_url()?>assets/img/logo.png" alt="">
    </a>
  </header>
  <div class="topnav">
    <div class="btn-toolbar">
      <div class="btn-group">
        <a data-placement="bottom" data-original-title="Show / Hide Sidebar" data-toggle="tooltip" class="btn btn-success btn-sm" id="changeSidebarPos">
          <i class="fa fa-expand"></i>
        </a>
      </div>
      <div class="btn-group">
        <a data-placement="bottom" data-original-title="Message" data-toggle="tooltip" class="btn btn-default btn-sm">
          <i class="fa fa-envelope"></i>
          <span class="label label-warning">5</span>
        </a>
        <a data-placement="bottom" data-original-title="Alert" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
          <i class="fa fa-bell"></i>
          <span class="label label-danger">4</span>
        </a>
        <a data-placement="bottom" data-original-title="Account Setting" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <div class="btn-group">
        <a href="<?=site_url()?>logout" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </div>
  </div><!-- /.topnav -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <h3>
      <strong style="color:#23f">Madani</strong>
      <small style="color:#f44">Hotel Management System</small>
    </h3>
  </div>
</nav><!-- /.navbar -->