<?php require_once APPROOT.'/views/includes/header.php'?>
<?php $page='adduser';require_once APPROOT . '/views/includes/navbar.php'; ?>
<div class="container">
    <div class="mt-4">
        <div md-5 mt-2 align="right">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"></i> 
            <?php if($_SESSION['type']=='statecontrolroom'){echo 'Add District Authority';}elseif($_SESSION['type']=='districtauthority'){echo 'Add District User';} ?></Button>
        </div>
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
            <h1 class="text-center  mb-5 "> Users List</h1>
            <?php if(empty($data['res'])):?>
            <h4> Your subcriber list is empty! Click add subscriber button to add one</h4>
            <?php else: ?>
            <table id="tableid" class="table table-striped table-hover mb-5" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Type</th>
                    <th scope="col">Tehsil</th>
                    <th scope="col">District</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <th style="visibility:hidden;">id</th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['res'] as $result) : ?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td><?php echo $result->name;?></td>
                    <td><?php echo $result->username;?></td>
                    <td><?php echo $result->type;?></td>
                    <td><?php echo $result->tehsil;?></td>
                    <td><?php echo $result->district;?></td>
                    <?php if($_SESSION['type']=='districtauthority'):?>
                        <td><button type="button" class="btn btn-success editbtn"><i class="fa fa-edit"></i></button></td>
                        <td><button type="button" class="btn btn-danger deletebtn"><i class="fa fa-trash"></i> </button></td>
                    <?php elseif($_SESSION['type']=='statecontrolroom'):?>
                        <?php if($result->type!='districtuser'):?>
                        <td><button type="button" class="btn btn-success editbtn"><i class="fa fa-edit"></i></button></td>
                        <td><button type="button" class="btn btn-danger deletebtn"><i class="fa fa-trash"></i> </button></td>
                        <?php else:?>
                        <td><button type="button" class="btn btn-primary "><i class="fa fa-bell-slash"></i></button></td>
                        <td><button type="button" class="btn btn-primary "><i class="fa fa-bell-slash"></i></button></td>
                        <?php endif;?>
                    <?php endif;?>
                    <td style="visibility:hidden;" class="bg-dark"><?php echo $result->id;?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
                <?php endif;?>
            </div>
            <div class="mt-4">
        </div>
    </div>
</div>

<!-- Modal add user -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/addUser/addNewUser" method="post">
      <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="name" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="username">Username<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Initial Password<sup class="text-danger">*</sup></label>
                    <input type="password" class="form-control" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="type">User Type</label>
                    <select class="form-control" name="type">
                       <?php if(session_status()==PHP_SESSION_NONE){session_start();}?>
                       <?php if($_SESSION['type']=='statecontrolroom'):?>
                       <option value="districtauthority">District Authority</option>
                       <?php elseif($_SESSION['type']=='districtauthority'):?>
                       <option value="districtuser">District User</option>
                       <?php endif;?>
                    </select>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="tehsil">Tehsil/City</label>
                        <input type="text" class="form-control" name="tehsil">
                    </div>
                  <div class="form-group">
                        <label for="district">District</label>
                        <select class="form-control" name="district">
                            <?php if(session_status()==PHP_SESSION_NONE){session_start();}?>
                            <?php if($_SESSION['type']=='statecontrolroom'):?>
                                <option value="almora">Almora</option>
                                <option value="bageshwar">Bageshwar</option>
                                <option value="chamoli">Chamoli</option>
                                <option value="champawat">Champawat</option>
                                <option value="dehradun">Dehradun</option>
                                <option value="haridwar">Haridwar</option>
                                <option value="nainital">Nainital</option>
                                <option value="paurigarhwal">Pauri Garhwal</option>
                                <option value="pithoragarh">Pithoragarh</option>
                                <option value="rudraprayag">Rudraprayag</option>
                                <option value="tehrigarhwal">Tehri Garhwal</option>
                                <option value="udhamsinghnagar">Udham Singh Nagar</option>
                                <option value="uttarkashi">Uttarkashi</option>
                            <?php elseif($_SESSION['type']=='districtauthority'):?>
                                <option value="<?php echo $_SESSION['district'];?>"><?php echo $_SESSION['district'];?></option>
                            <?php endif;?>
                        </select>
                  </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addsubscriber" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit user Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/addUser/editUser" method="post">
      <div class="modal-body">
                 <input type="hidden" id="editid" class="form-group form-control" name="id">
                  <div class="form-group">
                    <label for="name">Name <sup class="text-danger">*</sup></label>
                    <input type="text" id="editname"class="form-control" name="name" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="username">Username<sup class="text-danger">*</sup></label>
                    <input type="text" id="editusername" class="form-control" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="type">User Type</label>
                    <select class="form-control" name="type" id="edittype">
                       <?php if(session_status()==PHP_SESSION_NONE){session_start();}?>
                       <?php if($_SESSION['type']=='statecontrolroom'):?>
                       <option value="districtauthority">District Authority</option>
                       <?php elseif($_SESSION['type']=='districtauthority'):?>
                       <option value="districtuser">District User</option>
                       <?php endif;?>
                    </select>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="tehsil">Tehsil/City</label>
                        <input type="text" id="edittehsil"class="form-control" name="tehsil">
                    </div>
                  <div class="form-group">
                        <label for="district">District</label>
                        <select class="form-control" id="editdistrict" name="district">
                            <?php if(session_status()==PHP_SESSION_NONE){session_start();}?>
                            <?php if($_SESSION['type']=='statecontrolroom'):?>
                                <option value="almora">Almora</option>
                                <option value="bageshwar">Bageshwar</option>
                                <option value="chamoli">Chamoli</option>
                                <option value="champawat">Champawat</option>
                                <option value="dehradun">Dehradun</option>
                                <option value="haridwar">Haridwar</option>
                                <option value="nainital">Nainital</option>
                                <option value="paurigarhwal">Pauri Garhwal</option>
                                <option value="pithoragarh">Pithoragarh</option>
                                <option value="rudraprayag">Rudraprayag</option>
                                <option value="tehrigarhwal">Tehri Garhwal</option>
                                <option value="udhamsinghnagar">Udham Singh Nagar</option>
                                <option value="uttarkashi">Uttarkashi</option>
                            <?php elseif($_SESSION['type']=='districtauthority'):?>
                                <option value="<?php echo $_SESSION['district'];?>"><?php echo $_SESSION['district'];?></option>
                            <?php endif;?>
                        </select>
                  </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addsubscriber" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Subscriber</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo URLROOT;?>/AddUser/deleteData" method="post">
          <div class="modal-body">
                      <input type="hidden" id="deleteid" class="form-control" name="id">
                      <h6>Are you sure you want to delete data?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" name="deletedata" class="btn btn-primary">YES</button>
          </div>
          </form>
        </div>
      </div>
    </div>





<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<srcipt type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script
type="text/javascript" 
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</script>

<script type="text/javascript">
$(document).ready(function () {
   $('#tableid').on('click','.editbtn',function () {
       $('#editmodal').modal('show');
       $tr=$(this).closest('tr');
       var data=$tr.children("td").map(function(){
         return $(this).text();
       }).get();
       
       console.log(data);
       $('#editid').val(data[8]);
       $('#editname').val(data[1]);
       $('#editusername').val(data[2]);
       $('#edittype').val(data[3]);
       $('#editdistrict').val(data[5]);
       $('#edittehsil').val(data[4]);
       
   });
});
</script>

</script>
<script type="text/javascript">
$(document).ready(function () {
   $('#tableid').on('click','.deletebtn',function () {
       $('#deletemodal').modal('show');
       $tr=$(this).closest('tr');
       var data=$tr.children("td").map(function(){
         return $(this).text();
       }).get();
       
       console.log(data);
       $('#deleteid').val(data[8]);
   });
});
</script>
<?php require_once APPROOT.'/views/includes/footer.php';?>