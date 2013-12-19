<script src="<?=base_url()?>assets/lib/jquery.min.js"></script>
<script src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/lib/uniform/jquery.uniform.min.js"></script>
<script src="<?=base_url()?>assets/lib/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?=base_url()?>assets/lib/chosen/chosen.jquery.min.js"></script>
<script src="<?=base_url()?>assets/lib/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?=base_url()?>assets/lib/tagsinput/jquery.tagsinput.min.js"></script>
<script src="<?=base_url()?>assets/lib/validVal/js/jquery.validVal.min.js"></script>
<script src="<?=base_url()?>assets/lib/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>assets/lib/daterangepicker/moment.min.js"></script>
<script src="<?=base_url()?>assets/lib/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/lib/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url()?>assets/lib/switch/static/js/bootstrap-switch.min.js"></script>
<script src="<?=base_url()?>assets/lib/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="<?=base_url()?>assets/lib/autosize/jquery.autosize.min.js"></script>
<script src="<?=base_url()?>assets/lib/jasny/js/jasny-bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/main.min.js"></script>
<script>
  $(function() {
    formGeneral();
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