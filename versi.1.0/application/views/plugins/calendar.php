<!DOCTYPE html>
<html>
  
<!-- Mirrored from www.bublinastudio.com/flattybs3/calendar.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:39:14 GMT -->
<head>
    <link href="<?=base_url()?>assets/component/stylesheets/plugins/fullcalendar/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url()?>assets/component/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url()?>assets/component/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url()?>assets/component/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url()?>assets/component/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url()?>assets/component/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url()?>assets/component/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-red '>
    <div id='wrapper'> 
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header'>
                      <div class='title'>Home and work</div>
                    </div>
                    <div class='box-content'>
                      <div class='full-calendar-demo'></div>
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
    <script src="<?=base_url()?>assets/component/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url()?>assets/component/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url()?>assets/component/javascripts/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/component/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script>
      (function() {
        var cal, calendarDate, d, m, y;
      
        this.setDraggableEvents = function() {
          return $("#events .external-event").each(function() {
            var eventObject;
            eventObject = {
              title: $.trim($(this).text())
            };
            $(this).data("eventObject", eventObject);
            return $(this).draggable({
              zIndex: 999,
              revert: true,
              revertDuration: 0
            });
          });
        };
      
        setDraggableEvents();
      
        calendarDate = new Date();
      
        d = calendarDate.getDate();
      
        m = calendarDate.getMonth();
      
        y = calendarDate.getFullYear();
      
        cal = $(".full-calendar-demo").fullCalendar({
          header: {
            center: "title",
            left: "basicDay,basicWeek,month",
            right: "prev,today,next"
          },
          buttonText: {
            prev: "<span class=\"icon-chevron-left\"></span>",
            next: "<span class=\"icon-chevron-right\"></span>",
            today: "Today",
            basicDay: "Day",
            basicWeek: "Week",
            month: "Month"
          },
          droppable: true,
          editable: true,
          selectable: true,
          select: function(start, end, allDay) {
            return bootbox.prompt("Event title", function(title) {
              if (title !== null) {
                cal.fullCalendar("renderEvent", {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                }, true);
                return cal.fullCalendar('unselect');
              }
            });
          },
          eventClick: function(calEvent, jsEvent, view) {
            return bootbox.dialog({
              message: $("<form class='form'><label>Change event name</label></form><input id='new-event-title' class='form-control' type='text' value='" + calEvent.title + "' /> "),
              buttons: {
                success: {
                  label: "<i class='icon-remove'></i> Close",
                  className: "btn-default",
                  callback: function() {
                    calEvent.title = $("#new-event-title").val();
                    return cal.fullCalendar('updateEvent', calEvent);
                  }
                }
              }
            });
          },
          events: [
             {
              id: "event4",
              title: "Meeting",
              start: new Date(y, m, d, 0, 0),
              allDay: false,
              className: "event-orange"
            }, {
              id: "event5",
              title: "Lunch",
              start: new Date(y, m, d),
              end: new Date(y, m, d),
              allDay: false,
              className: "event-red"
            }, {
              id: "event5",
              title: "Lunch",
              start: new Date(y, m, d),
              end: new Date(y, m, d),
              allDay: false,
              className: "event-red"
            }
          ]
        });
      
      }).call(this);
    </script>
    <script>
      $("#new-event").live('submit', function(e) {
        var value;
        e.preventDefault();
        value = $("#new-event-input").val();
        if (value.length > 0) {
          $("#events .box-content").prepend("<div class='label label-important external-event'>" + value + "</div>");
          $("#new-event-input").val("");
          return setDraggableEvents();
        }
      });
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>

<!-- Mirrored from www.bublinastudio.com/flattybs3/calendar.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:39:14 GMT -->
</html>
