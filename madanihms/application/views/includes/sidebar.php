<!-- #menu -->
<ul id="menu" class="collapse">
  <li class="nav-header">Menu</li>
  <li class="nav-divider"></li>
  <?
    $menus = get_menus();
    foreach ($menus as $menu) {
      if($menu->menu_url=="#"){
  ?>
        <li class='<?=($this->uri->segment(2)==$menu->menu_name)?"active":""?>' style="display:<?=$menu->menu_avalaible?>">
          <a href="javascript:;">
            <i class="fa <?=$menu->menu_icon?>"></i>
            <span class="link-title"><?=$menu->menu_display?></span>
            <span class="fa arrow"></span>
          </a>
          <ul>
            <?
              $submenus = get_menus($menu->menu_id);
              if(!empty($submenus)){
                foreach ($submenus as $submenu) {
  ?>
                  <li class='<?=($this->uri->segment(3)==$submenu->menu_name)?"active":""?>' style="display:<?=$submenu->menu_avalaible?>">
                    <a href="<?=site_url().$submenu->menu_url?>.html">
                      <i class="fa <?=$submenu->menu_icon?>"></i>&nbsp;<?=$submenu->menu_display?>
                    </a>
                  </li>
  <?
                }
              }
  ?>
          </ul>
        </li>      
  <?
      }else{
  ?>
        <li class='<?=($this->uri->segment(2)==$menu->menu_name)?"active":""?>' style="display:<?=$menu->menu_avalaible?>">
          <a href="<?=site_url().$menu->menu_url?>.html">
            <i class="fa <?=$menu->menu_icon?>"></i>&nbsp;<?=$menu->menu_display?></a>
        </li>
  <?
      }
    }
  ?>
</ul><!-- /#menu -->