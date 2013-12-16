<!DOCTYPE html>
<html lang="en">
  <head>
    <? $this->load->view("includes/header"); ?>

    <!--Modernizr 3.0-->
    <script src="<?=base_url()?>assets/lib/modernizr-build.min.js"></script>
  </head>
  <body>
    <div id="wrap">
      <div id="top">

        <!-- .navbar -->
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
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-warning">5</span>
                </a>
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-comments"></i>
                  <span class="label label-danger">4</span>
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

        

        <!-- end header.head -->
      </div><!-- /#top -->
      <div id="left">
        <div class="media user-media">
          <a class="user-link" href="">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?=base_url()?>assets/img/user.gif">
          </a>
          <div class="media-body">
            <?
              $userprofile = $this->session->userdata('logged_in');
            ?>
            <h5 class="media-heading"><?=ucwords($userprofile['username'])?></h5>
            <ul class="list-unstyled user-info">
              <li> <a href=""><?=ucwords($userprofile['group_name'])?></a> </li>
              <li>Last Access :
                <br>
                <small>
                  <i class="fa fa-calendar"></i>&nbsp;<?=format_date("d M H:i",$userprofile['last_login'])?></small>
              </li>
            </ul>
          </div>
        </div>

        <? $this->load->view("includes/sidebar"); ?>
      </div><!-- /#left -->
      <div id="content">
        <!-- header.head -->
        <header class="head">
          <?=print_notification()?>
          <!-- ."main-bar -->
          <div class="main-bar" style="margin-left:0px;">
              <h3>
              <i class="fa <?=get_menu_icon($page_title)?>"></i>&nbsp;<?=$page_title?></h3>
          </div><!-- /.main-bar -->
        </header>
        <div class="outer">
          <? $this->load->view($content); ?>
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    </div><!-- /#wrap -->
    <div id="footer">
      <p>2013 &copy; Madani Soft HMS</p>
    </div>

    
    <script src="<?=base_url()?>assets/lib/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/style-switcher.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/lib/fullcalendar-1.6.2/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?=base_url()?>assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="<?=base_url()?>assets/lib/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?=base_url()?>assets/lib/flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>assets/lib/flot/jquery.flot.selection.js"></script>
    <script src="<?=base_url()?>assets/lib/flot/jquery.flot.resize.js"></script>
    <script src="<?=base_url()?>assets/js/main.min.js"></script>
    <script>
      $(function() {
        dashboard();
      });
    </script>
    <script type="text/javascript">
      (function($) {
        setInterval(function(){
          $("#myNotif").fadeOut("slow");
        },10000);
      })(jQuery);
    </script>
    <script type="text/javascript">
      function pagination (formx,page) {
        $("#"+formx).attr("action",$("#"+formx).attr("action")+"?page="+page);
        $("#"+formx).submit();
      }
    </script>
  </body>
</html>