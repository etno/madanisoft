<!DOCTYPE html>
<html>
  
<!-- Mirrored from www.bublinastudio.com/flattybs3/charts.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:39:02 GMT -->
<head>
    <link href="<?=base_url()?>assets/component/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url()?>assets/component/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <!-- <link href="<?=base_url()?>assets/component/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" /> -->
    <!-- / demo file [not required!] -->
    <link href="<?=base_url()?>assets/component/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url()?>assets/component/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url()?>assets/component/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-red '>
    <div id='wrapper' style="margin-left:50px;margin-right:50px;">
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              
              <div class='row'>
                <div class='col-sm-6'>
                  <div class='box'>
                    <div class='box-header'>
                      <div class='title'>
                        Total Guest Check in
                      </div>
                    </div>
                    <div class='box-content'>
                      <div id='stats-chart7'></div>
                    </div>
                  </div>
                </div>
                <div class='col-sm-6'>
                  <div class='box'>
                    <div class='box-header'>
                      <div class='title'>
                        Room Type Check In
                      </div>
                    </div>
                    <div class='box-content'>
                      <div id='stats-chart8'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- / jquery [required] -->
    <script src="<?=base_url()?>assets/component/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url()?>assets/component/javascripts/plugins/flot/excanvas.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/plugins/flot/flot.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/plugins/flot/flot.resize.js" type="text/javascript"></script>
     <script src="<?=base_url()?>assets/component/javascripts/plugins/sparklines/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/plugins/flot/flot.pie.js" type="text/javascript"></script>
    <script>
      var data, dataset, gd, options, previousLabel, previousPoint, showTooltip, ticks;
      var blue, data, datareal, getRandomData, green, i, newOrders, options, orange, orders, placeholder, plot, purple, randNumber, randSmallerNumber, red, series, totalPoints, update, updateInterval;
      var red = "#f34541";
      var orange = "#f8a326";
      var blue = "#00acec";
      var purple = "#9564e2";
      var green = "#49bf67";
      randNumber = function() {
        return ((Math.floor(Math.random() * (1 + 50 - 20))) + 20) * 800;
      };
      randSmallerNumber = function() {
        return ((Math.floor(Math.random() * (1 + 40 - 20))) + 10) * 200;
      };
    </script>
    <script>
      datareal = [];
      totalPoints = 300;
      getRandomData = function() {
        var i, prev, res, y;
        if (datareal.length > 0) {
          datareal = datareal.slice(1);
        }
        while (datareal.length < totalPoints) {
          prev = (datareal.length > 0 ? datareal[datareal.length - 1] : 50);
          y = prev + Math.random() * 10 - 5;
          if (y < 0) {
            y = 0;
          }
          if (y > 100) {
            y = 100;
          }
          datareal.push(y);
        }
        res = [];
        i = 0;
        while (i < datareal.length) {
          res.push([i, datareal[i]]);
          ++i;
        }
        return res;
      };
      options = {
        series: {
          shadowSize: 0
        },
        yaxis: {
          min: 0,
          max: 100
        },
        xaxis: {
          show: false
        }
      };
      plot = $.plot($("#stats-chart7"), [getRandomData()], options);
      // update();
      
      
      <?
        $room_types = get_room_types("active");
        $series = array();
        $idx = 0;
        if(!empty($room_types)){
          foreach ($room_types as $type) {
            $series[$idx] = $type->type_name;
            $idx++;
          }
        }
        $dataseries = json_encode($series);
      ?>
      data = [];
        dataseries = <?=$dataseries?>;
          series = <?=$idx?>;
          i = 0;
          while (i < series) {
            data[i] = {
              label: dataseries[i],
              data: Math.floor(Math.random() * 100) + 1
            };
            i++;
          }
          placeholder = $("#stats-chart8");
          $.plot(placeholder, data, {
            series: {
              pie: {
                show: true
              }
            }
          });
      
      
      gd = function(year, month, day) {
        return new Date(year, month, day).getTime();
      };
      showTooltip = function(x, y, color, contents) {
        return $("<div id=\"tooltip\">" + contents + "</div>").css({
          position: "absolute",
          display: "none",
          top: y - 40,
          left: x - 120,
          border: "2px solid " + color,
          padding: "3px",
          "font-size": "9px",
          "border-radius": "5px",
          "background-color": "#fff",
          "font-family": "Verdana, Arial, Helvetica, Tahoma, sans-serif",
          opacity: 0.9
        }).appendTo("body").fadeIn(200);
      };
      data = [[0, Math.round(Math.random()*100)], 
              [1, Math.round(Math.random()*100)], 
              [2, Math.round(Math.random()*100)], 
              [3, Math.round(Math.random()*100)], 
              [4, Math.round(Math.random()*100)], 
              [5, Math.round(Math.random()*100)], 
              [6, Math.round(Math.random()*100)], 
              [7, Math.round(Math.random()*100)], 
              [8, Math.round(Math.random()*100)], 
              [9, Math.round(Math.random()*100)], 
              [10, Math.round(Math.random()*100)], 
              [11, Math.round(Math.random()*100)]];
      dataset = [
        {
          label: "Total Guest",
          data: data,
          color: "#5482FF"
        }
      ];
      ticks = [[0, "Jan"], [1, "Feb"], [2, "Mar"], [3, "Apr"], [4, "May"], [5, "Jun"], [6, "Jul"], [7, "Aug"], [8, "Sep"], [9, "Oct"], [10, "Nov"], [11, "Dec"]];
      options = {
        series: {
          bars: {
            show: true
          }
        },
        bars: {
          align: "center",
          barWidth: 0.5
        },
        xaxis: {
          axisLabel: "World Cities",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: "Verdana, Arial",
          axisLabelPadding: 10,
          ticks: ticks
        },
        yaxis: {
          axisLabel: "Average Temperature",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: "Verdana, Arial",
          axisLabelPadding: 3,
          tickFormatter: function(v, axis) {
            if(v>0)
            return v + "00";
            else
            return v ;
          }
        },
        legend: {
          noColumns: 0,
          labelBoxBorderColor: "#000000",
          position: "nw"
        },
        grid: {
          hoverable: true,
          borderWidth: 2,
          backgroundColor: {
            colors: ["#ffffff", "#EDF5FF"]
          }
        }
      };
      $(document).ready(function() {
        $.plot($("#stats-chart7"), dataset, options);
        return $("#stats-chart7").UseTooltip();
      });
      previousPoint = null;
      previousLabel = null;
      $.fn.UseTooltip = function() {
        return $(this).bind("plothover", function(event, pos, item) {
          var color, x, y;
          if (item) {
            if ((previousLabel !== item.series.label) || (previousPoint !== item.dataIndex)) {
              previousPoint = item.dataIndex;
              previousLabel = item.series.label;
              $("#tooltip").remove();
              x = item.datapoint[0];
              y = item.datapoint[1];
              color = item.series.color;
              return showTooltip(item.pageX, item.pageY, color, "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x].label + " 2013 : <strong>" + y + "00</strong>");
            }
          } else {
            $("#tooltip").remove();
            return previousPoint = null;
          }
        });
      };
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>

<!-- Mirrored from www.bublinastudio.com/flattybs3/charts.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:39:03 GMT -->
</html>
