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
        <div id="defaultTable" class="body collapse in">
          <?
            $status = array("active"=>"primary",'not active'=>"danger");
            $filter = $this->session->userdata("group_list_filter");
          ?>
          <table class="table table-bordered table-striped responsive-table">
            <thead>
              <tr>
                <th style="width: 50px;">No</th>
                <th>Group Name</th>
                <th>Status</th>
                <th style="width:200px;">Action</th>
              </tr>
              <form id="formSearch" action="<?=site_url('admin/user/group_list/search')?>" method="post">
                <tr>
                  <td align="right">#</td>
                  <th>
                      <input class="form-control" name="group_name" id="group_name_filter" value="<?=$filter['group_name']?>">
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
                if(!empty($group_lists)){
                  $no += $offset;
                  foreach ($group_lists as $group_name) {
              ?>
                    <tr>
                      <td align="right"><?=++$no?></td>
                      <td><?=ucwords($group_name->group_name)?></td>
                      <td align="center">
                        <button class="btn btn-xs btn-<?=$status[$group_name->status]?>"><?=ucwords($group_name->status)?></button>
                      </td>
                      <td class=" ">
                        <div class="text-right">
                          <a class="btn btn-info btn-xs" onclick="editing_data(<?=$group_name->gid?>)">
                            <i class="fa fa-edit"></i>&nbsp;Edit
                          </a>
                          <a class="btn btn-danger btn-xs" role="button" onclick="deleting_data(<?=$group_name->gid?>,'<?=ucwords($group_name->group_name)?>')">
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
    <div id="formModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button capacity="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Room</h4>
          </div>
          <div class="modal-body" style="padding:7px;">
            <form class="form" id="myForm-input" method="POST" action="<?=site_url('admin/user/room_list/add')?>">
              <div class='modal-body'>
                <div class="form-group" style="margin-bottom:10px;">
                  <label>Group Name</label>
                  <input class="form-control" id="group_name" name="group_name" value="">
                </div>
                <div id="form-input-status" class="form-group" style="margin-bottom:10px;">
                  <label>Status</label>
                  <select name="status" id="status" class='select2 form-control'>
                    <?
                      foreach ($status as $key => $value) {
                    ?>
                      <option value="<?=$key?>" <?=($key==$filter['status'])?'selected':''?> ><?=ucwords($key)?></option>
                    <?
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class='modal-footer'>
                <button class='btn btn-default' data-dismiss='modal' room='button'>Close</button>
                <button class='btn btn-success' capacity='submit'>Save</button>
              </div>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    $("#form-delete").attr("action","<?=site_url()?>admin/user/group_list/delete/"+room_id);
    $("#modal-delete").modal("show");
  }

  function adding_data () {
    $("#group_name").val("");
    $("#form-input-status").hide();
    $("#myForm-input").attr("action","<?=site_url()?>admin/user/group_list/add");
    $("#formModal").children(".modal-dialog").children(".modal-content").children(".modal-header").children(".modal-title").html('Adding Data');
    $("#formModal").modal("show");
  }

  function editing_data (room_id) {
    post_path = "<?=site_url()?>admin/user/group_list/edit/"+room_id;
    $.post(post_path,null, function(data){
      var obj = jQuery.parseJSON(data);
      $("#group_name").val(obj.group_lists.group_name);
      $("#status").val(obj.group_lists.status);
    });
    $("#form-input-status").show();
    $("#myForm-input").attr("action","<?=site_url()?>admin/user/group_list/update/"+room_id);
    $("#formModal").children(".modal-dialog").children(".modal-content").children(".modal-header").children(".modal-title").html('Editing Data');
    $("#formModal").modal("show");
  }
</script>