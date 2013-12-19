<!DOCTYPE html>
<html>
  
<!-- Mirrored from www.bublinastudio.com/flattybs3/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:36:57 GMT -->
<head>
    <title>Dashboard | Flatty - Flat Administration Template</title>
    <?
      $this->load->view("admin/script");
    ?>
  </head>
  <body class="<?=get_setting('theme')?> ">
    <?
        $this->load->view($content);
        $this->load->view("admin/script2");
    ?>
  </body>

<!-- Mirrored from www.bublinastudio.com/flattybs3/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 04 Dec 2013 01:38:02 GMT -->
</html>
