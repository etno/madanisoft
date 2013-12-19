<!DOCTYPE html>
<html lang="en">
  <head>
    <? $this->load->view("includes/header"); ?>

    <!--Modernizr 3.0-->
    <script src="<?=base_url()?>assets/lib/modernizr-build.min.js"></script>
  </head>
  <!-- <body class="mini-sidebar"> -->
  <body>
    <div id="wrap">
      <div id="top">

        <!-- .navbar -->
      <?
        $this->load->view("includes/nav");
      ?>

        <!-- end header.head -->
      </div><!-- /#top -->
      <div id="left">
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

    <? $this->load->view("includes/footer"); ?>
    
  </body>
</html>