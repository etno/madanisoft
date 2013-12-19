<div class="inner">

  <!--Begin Datatables-->
  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <header>
          <div class="icons">
            <i class="fa fa-table"></i>
          </div>
          <h5><?=$page_title?></h5>
          <div class="toolbar">
            <div class="btn-group">
              <button class="btn btn-success btn-sm" onclick="adding_data()">
                <i class="fa fa-plus"></i>&nbsp;Add Group List
              </button>
            </div>
          </div>
        </header>
        <?
          $status = array("active"=>"primary",'not active'=>"danger");
          $filter = $this->session->userdata("user_list_filter");
          $group_list = get_user_groups();
          $user_level = get_user_levels();
        ?>
        <div id="collapse-form" class="body collapse" style="height: auto;">
          <div class="modal-header">
            <h4 class="modal-title">Add Room</h4>
          </div>
          <div class="modal-body" style="padding:7px;">
            <form class="form-horizontal" method="POST" action="<?=site_url('admin/user/room_list/add')?>">
              <div class="form-group">
                <label for="text1" class="control-label col-lg-2" style="text-align:left">Employee Id</label>
                <div class="col-lg-3">
                  <input type="emp_id" id="text1" placeholder="Employee Id" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="text1" class="control-label col-lg-2" style="text-align:left">Employee Name</label>
                <div class="col-lg-5">
                  <input type="first_name" id="text1" placeholder="First Name" class="form-control">
                </div>
                <div class="col-lg-5">
                  <input type="first_name" id="text1" placeholder="Last Name" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="level_filter" class="control-label col-lg-2" style="text-align:left">Employee Level</label>
                <div class="col-lg-3">
                  <select name="level_id" id="level_filter" class='select2 form-control'>
                    <option value="">All</option>
                    <?
                      if(!empty($user_level)){
                        foreach ($user_level as $level) {
                    ?>
                        <option value="<?=$level->level_id?>" <?=($level->level_id==$filter['level_id'])?'selected':''?> ><?=ucwords($level->level)?></option>
                    <?
                        }
                      }
                    ?>
                  </select>
                </div>
                <label for="gid_filter" class="control-label col-lg-2" style="text-align:left">Group</label>
                <div class="col-lg-3">
                  <select name="gid" id="gid_filter" class='select2 form-control'>
                    <option value="">All</option>
                    <?
                      if(!empty($group_list)){
                        foreach ($group_list as $group) {
                    ?>
                        <option value="<?=$group->gid?>" <?=($group->gid==$filter['gid'])?'selected':''?> ><?=ucwords($group->group_name)?></option>
                    <?
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class='modal-footer'>
                <button class='btn btn-default' type='button' onclick="hide_form()">Back</button>
                <button class='btn btn-success' type='submit'>Save</button>
              </div>
            </form>
          </div>
        </div>
        <div id="defaultTable" class="body in">
          <table class="table table-bordered table-striped responsive-table">
            <thead>
              <tr>
                <th style="width: 50px;">No</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>User Group</th>
                <th>Level</th>
                <th>Contact</th>
                <th>Status</th>
                <th style="width:200px;">Action</th>
              </tr>
              <form id="formSearch" action="<?=site_url('admin/user/user_list/search')?>" method="post">
                <tr>
                  <td align="right">#</td>
                  <th>
                      <input class="form-control" name="username" id="username_filter" value="<?=$filter['username']?>">
                  </th>
                  <th>
                      <input class="form-control" name="fullname" id="fullname_filter" value="<?=$filter['fullname']?>">
                  </th>
                  <th>
                      <select name="gid" id="gid_filter" class='select2 form-control'>
                        <option value="">All</option>
                        <?
                          if(!empty($group_list)){
                            foreach ($group_list as $group) {
                        ?>
                            <option value="<?=$group->gid?>" <?=($group->gid==$filter['gid'])?'selected':''?> ><?=ucwords($group->group_name)?></option>
                        <?
                            }
                          }
                        ?>
                      </select>
                  </th>
                  <th>
                      <select name="level_id" id="level_filter" class='select2 form-control'>
                        <option value="">All</option>
                        <?
                          if(!empty($user_level)){
                            foreach ($user_level as $level) {
                        ?>
                            <option value="<?=$level->level_id?>" <?=($level->level_id==$filter['level_id'])?'selected':''?> ><?=ucwords($level->level)?></option>
                        <?
                            }
                          }
                        ?>
                      </select>
                  </th>
                  <th>
                      <input class="form-control" name="contact" id="fullname_filter" value="<?=$filter['contact']?>">
                  </th>
                  <th>
                      <select name="status" id="status_filter" class='select2 form-control'>
                        <option value="">All</option>
                        <?
                          foreach ($status as $key => $value) {
                        ?>
                          <option value="<?=$key?>" <?=($key==$filter['status'])?'selected':''?> ><?=ucwords($key)?></option>
                        <?
                          }
                        ?>
                      </select>
                  </th>
                  <th>
                    <button value="cari" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</button>
                  </th>
                </tr>
              </form>
            </thead>
            <tbody>
              <?
                $no=0;
                if(!empty($user_lists)){
                  $no += $offset;
                  foreach ($user_lists as $user) {
                    if($user->people_phone!='-'){
                      $phone = json_decode($user->people_phone);
                      $phone = implode(", ", $phone);
                    }else $phone="";
              ?>
                    <tr>
                      <td align="right"><?=++$no?></td>
                      <td><?=ucwords($user->username)?></td>
                      <td><?=ucwords($user->people_first_name).' '.ucwords($user->people_last_name)?></td>
                      <td><?=ucwords($user->group_name)?></td>
                      <td><?=ucwords($user->level)?></td>
                      <td><?='email : '.$user->email.(!empty($phone)?'<br>phone : '.$phone:'')?></td>
                      <td align="center">
                        <button class="btn btn-xs btn-<?=$status[$user->user_status]?>"><?=ucwords($user->user_status)?></button>
                      </td>
                      <td class=" ">
                        <div class="text-right">
                          <a class="btn btn-info btn-xs" onclick="editing_data(<?=$user->gid?>)">
                            <i class="fa fa-edit"></i>&nbsp;Edit
                          </a>
                          <a class="btn btn-danger btn-xs" role="button" onclick="deleting_data(<?=$user->gid?>,'<?=ucwords($user->group_name)?>')">
                            <i class="glyphicon glyphicon-remove"></i>&nbsp;Delete
                          </a>
                        </div>
                      </td>
                    </tr>
              <?
                  }
                }else{
              ?>
                <tr>
                  <td colspan="7">
                    Data Not Found
                  </td>
                </tr>
              <?
                }
              ?>
            </tbody>
          </table>
          <?
            print_pagination($total_rows,$limit,$offset,$no);
          ?>
        </div>
      </div>
    </div>
  </div><!-- /.row -->

  <!--End Datatables-->
</div>

<!-- Modal -->
    <div class='modal fade' id='modal-delete' tabindex='-1'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button aria-hidden='true' class='close' data-dismiss='modal' room='button'>×</button>
            <h4 class='modal-title' id='myModalLabel'>Confirmation</h4>
          </div>
          <form id="form-delete" method="POST" action="">
            <div class='modal-body'>
              <p id="data-room-room">Group Name : </p>
              <p>Are you sure deleting this data?</p>
            </div>
            <div class='modal-footer'>
              <button class='btn btn-default' data-dismiss='modal' room='button'>Close</button>
              <button class='btn btn-danger' room='submit'>Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>

<!-- /Modal -->
<script room="text/javascript">
  function deleting_data (room_id,room_number) {
    $("#data-room-room").append(room_number);
    $("#form-delete").attr("action","<?=site_url()?>admin/user/user_list/delete/"+room_id);
    $("#modal-delete").modal("show");
  }

  function adding_data () {
    $("#group_name").val("");
    $("#form-input-status").hide();
    $("#myForm-input").attr("action","<?=site_url()?>admin/user/user_list/add");
    $("#collapse-form").children(".modal-header").children(".modal-title").html('Adding Data');
    $("#defaultTable").removeClass("in").addClass("collapse");
    $("#collapse-form").removeClass("collapse").addClass("in");
  }

  function editing_data (room_id) {
    post_path = "<?=site_url()?>admin/user/user_list/edit/"+room_id;
    $.post(post_path,null, function(data){
      var obj = jQuery.parseJSON(data);
      $("#group_name").val(obj.user_lists.group_name);
      $("#status").val(obj.user_lists.status);
    });
    $("#form-input-status").show();
    $("#myForm-input").attr("action","<?=site_url()?>admin/user/user_list/update/"+room_id);
    $("#collapse-form").children(".modal-header").children(".modal-title").html('Editing Data');
    $("#defaultTable").removeClass("in").addClass("collapse");
    $("#collapse-form").removeClass("collapse").addClass("in");
  }

  function hide_form () {
    $("#collapse-form").removeClass("in").addClass("collapse");
    $("#defaultTable").removeClass("collapse").addClass("in");
  }
</script>