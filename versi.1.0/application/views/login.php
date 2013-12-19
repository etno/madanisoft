<!DOCTYPE html>
<html lang="en">
  <head>
    <?
    	$this->load->view("includes/header");
    ?>
  </head>
  <body class="login">
    <div class="container">
      <?=print_notification()?>
      <div class="text-center">
        <img src="<?=base_url()?>assets/img/logo.png" alt="Metis Logo">
      </div>

            
      <div class="tab-content">
        
        <div id="login" class="tab-pane active">
          
          <form action="<?=$this->uri->uri_string()?>" class="form-signin" method="post">
            
            <input name="usernameemail" type="text" placeholder="Username or Email" class="form-control">
            <input name="userpassword" type="password" placeholder="Password" class="form-control">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
        <div id="forgot" class="tab-pane">
          <form action="index.html" class="form-signin">
            <input type="email" placeholder="mail@domain.com" required="required" class="form-control">
            <br>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
          </form>
        </div>
      </div>
      <div class="text-center">
        <ul class="list-inline">
          <li> <a class="text-muted" href="#login" data-toggle="tab">Login</a> </li>
          <li> <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a> </li>
        </ul>
      </div>
    </div><!-- /container -->
    <script src="<?=base_url()?>assets/lib/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.js"></script>
    <script>
      $('.list-inline li > a').click(function() {
        var activeForm = $(this).attr('href') + ' > form';
        //console.log(activeForm);
        
        $(activeForm).addClass('magictime swap');

        //set timer to 1 seconds, after that, unload the magic animation
        setTimeout(function() {
          $(activeForm).removeClass('magictime swap');
        }, 1000);

      });
    </script>

    <script type="text/javascript">
      (function($) {
        setInterval(function(){
          $("#myNotif").fadeOut("slow");
        },3000);
      })(jQuery);
    </script>
  </body>
</html>
