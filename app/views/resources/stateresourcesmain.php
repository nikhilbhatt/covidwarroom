<?php require_once APPROOT . '/views/includes/header.php'; ?>
<!-- Distribute NEW PPE kits to state:-
SEE the total PPE kits and thier availability in state
SEE the list which is not yet approved by the state  -->
<div class="justify-content-center text-center mt-3">
<a href="<?php echo URLROOT;?>/AddUser" class="btn mt-3 btn-success">Add New District Authority</a>

<a href="<?php echo URLROOT;?>/Logout" class="btn mt-3 btn-danger">Logout</a>
</div>
<div class="container">
    <div class="mt-4">
        <div md-5 mt-2 align="right">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addkits"><i class="fa fa-plus"></i> Distribute NEW Kits</Button>
        </div>
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
            <h1 class="text-center"> KITS DISTRIBUTION IN DISTRICTS<br>
            <span class="text-center text-danger " style="font-size:12px;">Column will automatically gets deleted once the district authority accepts these items<span></h1>
            <?php if(empty($data['res'])):?>
            <h4> Your subcriber list is empty! Click add subscriber button to add one</h4>
            <?php else: ?>
            <table id="tableid" class="table table-striped table-hover mb-5" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">District</th>
                    <th scope="col">PPEKits</th>
                    <th scope="col">N95</th>
                    <th scope="col">VTM</th>
                    <th scope="col">Ventilators</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col">Update</th>
                    <th style="visibility:hidden;">id</th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['res'] as $result) : ?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td><?php echo $result->district;?></td>
                    <td><?php echo $result->ppekits;?></td>
                    <td><?php echo $result->n95;?></td>
                    <td><?php echo $result->vtm;?></td>
                    <td><?php echo $result->ventilator;?></td>
                    <td><?php echo $result->date;?></td>
                    <td><button type="button" class="btn btn-success editbtn"><i class="fa fa-edit"></i></button></td>
                    <td style="visibility:hidden;" ><?php echo $result->id;?></td>
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

<div class="container">
    <div class="mt-4">
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md table-responsive-lg table-responsive-sm">
            <h1 class="text-center"> Total Kits available in district</h1>
            <?php if(empty($data['approvedres'])):?>
            <h4> No data Available</h4>
            <?php else: ?>
            <table id="tableid" class="table table-striped table-hover mb-5 table-responsive" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">District</th>
                    <th scope="col">PPEKits Added Today</th>
                    <th scope="col">PPEKits Used Today</th>
                    <th scope="col">PPEKits Vacant Today</th>
                    <th scope="col">Total PPEKits</th>
                    <th scope="col">Total PPEKits Used</th>
                    <th scope="col">Total PPEKits Vacant</th>
                    <th scope="col">VTM Added Today</th>
                    <th scope="col">VTM Used Today</th>
                    <th scope="col">VTM Vacant Today</th>
                    <th scope="col">Total VTM</th>
                    <th scope="col">Total VTM Used</th>
                    <th scope="col">Total VTM Vacant</th>

                    <th scope="col">n95 Added Today</th>
                    <th scope="col">n95 Used Today</th>
                    <th scope="col">n95 Vacant Today</th>
                    <th scope="col">Total n95</th>
                    <th scope="col">Total n95 Used</th>
                    <th scope="col">Total n95 Vacant</th>

                    <th scope="col">Total ventilator</th>
                    <th scope="col">Total ventilator Used</th>
                    <th scope="col">Total ventilator Vacant</th>

                    <th scope="col">Total Patient Bed</th>
                    <th scope="col">Total Patient Bed Used</th>
                    <th scope="col">Total Patient Bed Vacant</th>

                    <th scope="col">Total Quarantine Bed</th>
                    <th scope="col">Total Quarantine Bed Used</th>
                    <th scope="col">Total Quarantine Bed Vacant</th>

                    <th scope="col">Total ICU Bed</th>
                    <th scope="col">Total ICU Bed Used</th>
                    <th scope="col">Total ICU  Bed Vacant</th>
                    
                    <th scope="col">Last Updated</th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['approvedres'] as $result) : ?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td><?php echo $result->district;?></td>
                    <?php if(date("y-m-d",time())==date("y-m-d",strtotime($result->date))):?>
                      <td><?php echo $result->ppekitsaddedtoday;?></td>
                      <td><?php echo $result->ppekitsusedtoday;?></td>
                      <td><?php echo $result->ppekitsvacanttoday;?></td>
                    <?php else:?>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    <?php endif;?>
                    <td><?php echo $result->ppekitscumulative;?></td>
                    <td><?php echo $result->ppekitsusedcumulative;?></td>
                    <td><?php echo $result->ppekitsvacantcumulative;?></td>

                    <?php if(date("y-m-d",time())==date("y-m-d",strtotime($result->date))):?>
                    <td><?php echo $result->vtmaddedtoday;?></td>
                    <td><?php echo $result->vtmusedtoday;?></td>
                    <td><?php echo $result->vtmvacanttoday;?></td>
                    <?php else:?>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    <?php endif;?>
                    <td><?php echo $result->vtmcumulative;?></td>
                    <td><?php echo $result->vtmusedcumulative;?></td>
                    <td><?php echo $result->vtmvacantcumulative;?></td>
                    

                    <?php if(date("y-m-d",time())==date("y-m-d",strtotime($result->date))):?>
                    <td><?php echo $result->n95addedtoday;?></td>
                    <td><?php echo $result->n95usedtoday;?></td>
                    <td><?php echo $result->n95vacanttoday;?></td>
                    <?php else:?>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    <?php endif;?>
                    <td><?php echo $result->n95cumulative;?></td>
                    <td><?php echo $result->n95usedcumulative;?></td>
                    <td><?php echo $result->n95vacantcumulative;?></td>

                    <td><?php echo $result->ventilatorcumulative;?></td>
                    <td><?php echo $result->ventilatorusedcumulative;?></td>
                    <td><?php echo $result->ventilatorvacantcumulative;?></td>


                    <td><?php echo $result->patientbedcumulative;?></td>
                    <td><?php echo $result->patientbedusedcumulative;?></td>
                    <td><?php echo $result->patientbedvacantcumulative;?></td>

                    <td><?php echo $result->quarantinebedcumulative;?></td>
                    <td><?php echo $result->quarantinebedusedcumulative;?></td>
                    <td><?php echo $result->quarantinebedvacantcumulative;?></td>

                    <td><?php echo $result->icucumulative;?></td>
                    <td><?php echo $result->icuusedcumulative;?></td>
                    <td><?php echo $result->icuvacantcumulative;?></td>
                    <td><?php echo $result->date;?></td>
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

<!-- Modal add NEW PPE KITS -->
<div class="modal fade" id="addkits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Distribute KITS<br>
        <span class="text-danger" style="font-size:10px;">Mark zero if there is no item for specific coloumn</span></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/StateResourcesMain/distributeKits" method="post">
      <div class="modal-body">
                  <div class="form-group">
                    <label for="district">District<sup class="text-danger">*</sup></label>
                    <select class="form-control" name="district">
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
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="ppekits">PPE Kits</label>
                    <input type="number" class="form-control" value="0" name="ppekits">
                  </div>
                  <div class="form-group">
                    <label for="n95">N95 Masks</label>
                    <input type="number" class="form-control" value="0" name="n95">
                  </div>
                  <div class="form-group">
                    <label for="vtm">VTM</label>
                    <input type="number" class="form-control"  value="0"  name="vtm">
                  </div>
                  <div class="form-group">
                    <label for="ventilator">Ventilator</label>
                    <input type="number" class="form-control" value="0"  name="ventilator">
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


<!-- Modal edit PPE KITS -->
<<div class="modal fade" id="editkits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit KITS</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/StateResourcesMain/editKits" method="post">
      <div class="modal-body">
                    <input type="hidden"id='editid' name='id'>
                  <div class="form-group">
                    <label for="district">District<sup class="text-danger">*</sup></label>
                    <select class="form-control" id="editdistrict" name="district">
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
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="ppekits">PPE Kits</label>
                    <input type="number" id="editppekits" class="form-control"name="ppekits">
                  </div>
                  <div class="form-group">
                    <label for="n95">N95 Masks</label>
                    <input type="number" id="editn95"class="form-control"name="n95">
                  </div>
                  <div class="form-group">
                    <label for="vtm">VTM</label>
                    <input type="number" id="editvtm"class="form-control"  name="vtm">
                  </div>
                  <div class="form-group">
                    <label for="ventilator">Ventilator</label>
                    <input type="number" class="form-control" id="editventilator"name="ventilator">
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
       $('#editkits').modal('show');
       $tr=$(this).closest('tr');
       var data=$tr.children("td").map(function(){
         return $(this).text();
       }).get();
       
       console.log(data);
       $('#editdistrict').val(data[1]);
       $('#editppekits').val(data[2]);
       $('#editn95').val(data[3]);
       $('#editvtm').val(data[4]);
       $('#editventilator').val(data[5]); 
       $('#editid').val(data[8]);
   });
});
</script>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>
