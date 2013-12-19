<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#5bc0de">
    <meta name="msapplication-TileImage" content="<?=base_url()?>assets/img/metis-tile.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>assets/lib/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/lib/Font-Awesome/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/theme.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/lib/fullcalendar-1.6.2/fullcalendar/fullcalendar.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
      <script src="<?=base_url()?>assets/lib/html5shiv/html5shiv.js"></script>
	      <script src="<?=base_url()?>assets/lib/respond/respond.min.js"></script>
	    <![endif]-->

    <!--Modernizr 3.0-->
    <script src="<?=base_url()?>assets/lib/modernizr-build.min.js"></script>
  </head>
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
        <header class="head">
          <?=print_notification()?>
          <!-- ."main-bar -->
          <div class="main-bar" style="margin-left:0px;">
              <h3>
              <i class="fa <?=get_menu_icon($page_title)?>"></i>&nbsp;<?=$page_title?></h3>
          </div><!-- /.main-bar -->
        </header>

        <div class="outer">
          <div class="inner">
            <div class="text-center">
              <ul class="stats_box">
                <li>
                  <div class="sparkline bar_week"></div>
                  <div class="stat_text">
                    <strong>2.345</strong>Weekly Visit
                    <span class="percent down"> <i class="fa fa-caret-down"></i> -16%</span>
                  </div>
                </li>
                <li>
                  <div class="sparkline line_day"></div>
                  <div class="stat_text">
                    <strong>165</strong>Daily Visit
                    <span class="percent up"> <i class="fa fa-caret-up"></i> +23%</span>
                  </div>
                </li>
                <li>
                  <div class="sparkline pie_week"></div>
                  <div class="stat_text">
                    <strong>$2 345.00</strong>Weekly Sale
                    <span class="percent"> 0%</span>
                  </div>
                </li>
                <li>
                  <div class="sparkline stacked_month"></div>
                  <div class="stat_text">
                    <strong>$678.00</strong>Monthly Sale
                    <span class="percent down"> <i class="fa fa-caret-down"></i> -10%</span>
                  </div>
                </li>
              </ul>
            </div>
            <hr>
            <div class="text-center">
              <a class="quick-btn" href="#">
                <i class="fa fa-bolt fa-2x"></i>
                <span>default</span>
                <span class="label label-default">2</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-check fa-2x"></i>
                <span>danger</span>
                <span class="label label-danger">2</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-building-o fa-2x"></i>
                <span>No Label</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-envelope fa-2x"></i>
                <span>success</span>
                <span class="label label-success">-456</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-signal fa-2x"></i>
                <span>warning</span>
                <span class="label label-warning">+25</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-external-link fa-2x"></i>
                <span>π</span>
                <span class="label btn-metis-2">3.14159265</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-lemon-o fa-2x"></i>
                <span>é</span>
                <span class="label btn-metis-4">2.71828</span>
              </a>
              <a class="quick-btn" href="#">
                <i class="fa fa-glass fa-2x"></i>
                <span>φ</span>
                <span class="label btn-metis-3">1.618</span>
              </a>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-8">
                <div class="box">
                  <header>
                    <h5>Line Chart</h5>
                  </header>
                  <div class="body" id="trigo" style="height: 250px;"></div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="box">
                  <div class="body">
                    <table class="table table-condensed table-hovered sortableTable">
                      <thead>
                        <tr>
                          <th>Country
                            <i class="fa fa-sort"></i>
                            <i class="fa fa-sort-asc"></i>
                            <i class="fa fa-sort-desc"></i>
                          </th>
                          <th>Visit
                            <i class="fa fa-sort"></i>
                            <i class="fa fa-sort-asc"></i>
                            <i class="fa fa-sort-desc"></i>
                          </th>
                          <th>Time
                            <i class="fa fa-sort"></i>
                            <i class="fa fa-sort-asc"></i>
                            <i class="fa fa-sort-desc"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="active">
                          <td>Andorra</td>
                          <td>1126</td>
                          <td>00:00:15</td>
                        </tr>
                        <tr>
                          <td>Belarus</td>
                          <td>350</td>
                          <td>00:01:20</td>
                        </tr>
                        <tr class="danger">
                          <td>Paraguay</td>
                          <td>43</td>
                          <td>00:00:30</td>
                        </tr>
                        <tr class="warning">
                          <td>Malta</td>
                          <td>547</td>
                          <td>00:10:20</td>
                        </tr>
                        <tr>
                          <td>Australia</td>
                          <td>560</td>
                          <td>00:00:10</td>
                        </tr>
                        <tr>
                          <td>Kenya</td>
                          <td>97</td>
                          <td>00:20:00</td>
                        </tr>
                        <tr class="success">
                          <td>Italy</td>
                          <td>2450</td>
                          <td>00:10:00</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <h5>Calendar</h5>
                  </header>
                  <div id="calendar_content" class="body">
                    <div id='calendar'></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    </div><!-- /#wrap -->
    <div id="footer">
      <p>2013 &copy; Metis Admin</p>
    </div>

    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
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
  </body>
</html>