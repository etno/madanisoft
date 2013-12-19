<div class='container'>
  <div class="row">
    <div class="col-sm-12">
      <div id="pager-parent" class="box">
        <div class="box-header">
            <div class="title">
              <i class="icon-key"></i>
              Room Lists
            </div>
          </div>
        <div class="box-content">          
          <div class="btn-toolbar">
            <?
              if(!empty($room_lists)){
                $no=0;
                foreach ($room_lists as $room) {
                  $status = array("avalaible"=>"primary","booked"=>"info",'checkin'=>"success",'checkout'=>"danger",'cleaning'=>"warning",'repaired'=>"inverse");
            ?>
                  <div class="btn-group dropdown">
                    <button class="btn btn-lg btn-<?=$status[$room->status]?>" style="margin-bottom:5px;<?=($no++==0)?'margin-left:5px;':''?>">
                      <i class="icon-key"></i><?=$room->room_number?>
                    </button>
                    <button class="btn btn-lg btn-<?=$status[$room->status]?> dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                    </button>
                    <ul class='dropdown-menu'>
                      <li>
                        <a href='#'>Action</a>
                      </li>
                      <li>
                        <a href='#'>Another action</a>
                      </li>
                      <li>
                        <a href='#'>Something else here</a>
                      </li>
                      <li class='divider'></li>
                      <li>
                        <a href='#'>Separated link</a>
                      </li>
                    </ul>
                  </div>
            <?
                }
              }
            ?>
          </div>
          <div class='box-content'>
            <?
              foreach ($status as $key => $value) {
            ?>
                <input class="btn btn-xs btn-<?=$value?>" style="margin-bottom:5px" value="<?=ucwords($key)?>" type="button" />
            <?
              }
              if(!empty($pagination)) echo($pagination);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
