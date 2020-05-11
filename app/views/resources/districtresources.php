<?php require_once APPROOT . '/views/includes/header.php'; ?>
<!-- Distribute NEW PPE kits to state:-
SEE the total PPE kits and thier availability in state
SEE the list which is not yet approved by the state  -->
<div class="container">
    <div class="mt-4">
        <h4><?php echo $_SESSION['district'];?></h4>
        <div md-5 mt-2 align="right">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addkits"><i class="fa fa-plus"></i>Add New Kits</Button>
        </div>
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
            <h1 class="text-center"> KITS YOU GET FROM STATE<br>
            <span class="text-center text-danger " style="font-size:12px;">Click on the approve button only when you get these<span></h1>
            <?php if(empty($data['res'])):?>
            <h4> No resources from district now</h4>
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
                    <th scope="col">Approve</th>
                    <th style="visibility:hidden;">id</th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['res'] as $result) : ?>
                <?php if($result->district==$_SESSION['district']):?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td><?php echo $result->district;?></td>
                    <td><?php echo $result->ppekits;?></td>
                    <td><?php echo $result->n95;?></td>
                    <td><?php echo $result->vtm;?></td>
                    <td><?php echo $result->ventilator;?></td>
                    <td><?php echo $result->date;?></td>
                    <td><button type="button" class="btn btn-success editbtn"><i class="fa fa-check-circle"></i></button></td>
                    <td style="visibility:hidden;" ><?php echo $result->id;?></td>
                </tr>
                <?php endif;?>
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
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
            <h1 class="text-center">Resources You have</h1>
            <?php if(empty($data['districtres'])):?>
            <h4> No resources from district now</h4>
            <?php else: ?>
            <table id="tableid" class="table table-striped table-hover mb-5" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th sope="col">Item</th>
                    <th scope="col">Added Today</th>
                    <th scope="col">Used Today</th>
                    <th scope="col">Vacant Today</th>
                    <th scope="col">Total</th>
                    <th scope="col">Total Used</th>
                    <th scope="col">Total Vacant</th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['districtres'] as $result) : ?>
                <?php if($result->district==$_SESSION['district']):?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'PPE Kits';?></td>     
                    <td><?php echo $result->ppekitsaddedtoday;?></td>
                    <td><?php echo $result->ppekitsusedtoday;?></td>
                    <td><?php echo $result->ppekitsvacanttoday;?></td>
                    <td><?php echo $result->ppekitscumulative;?></td>
                    <td><?php echo $result->ppekitsusedcumulative;?></td>
                    <td><?php echo $result->ppekitsvacantcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'VTM';?></td>     
                    <td><?php echo $result->vtmaddedtoday;?></td>
                    <td><?php echo $result->vtmusedtoday;?></td>
                    <td><?php echo $result->vtmvacanttoday;?></td>
                    <td><?php echo $result->vtmcumulative;?></td>
                    <td><?php echo $result->vtmusedcumulative;?></td>
                    <td><?php echo $result->vtmvacantcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'n95';?></td>     
                    <td><?php echo $result->n95addedtoday;?></td>
                    <td><?php echo $result->n95usedtoday;?></td>
                    <td><?php echo $result->n95vacanttoday;?></td>
                    <td><?php echo $result->n95cumulative;?></td>
                    <td><?php echo $result->n95cumulative;?></td>
                    <td><?php echo $result->n95cumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'Ventilators';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->ventilatorcumulative;?></td>
                    <td><?php echo $result->ventilatorusedcumulative;?></td>
                    <td><?php echo $result->ventilatorvacantcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'Patient Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->patientbedcumulative;?></td>
                    <td><?php echo $result->patientbedusedcumulative;?></td>
                    <td><?php echo $result->patientbedvacantcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'Quarantine Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->quarantinebedcumulative;?></td>
                    <td><?php echo $result->quarantinebedusedcumulative;?></td>
                    <td><?php echo $result->quarantinebedvacantcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'ICU Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->icucumulative;?></td>
                    <td><?php echo $result->icuusedcumulative;?></td>
                    <td><?php echo $result->icuvacantcumulative;?></td>
                </tr>
                <?php endif;?>
                <?php endforeach; ?>
                </tbody>
            </table>
                <?php endif;?>
            </div>
            <div class="mt-4">
        </div>
    </div>
</div>

<!-- Modal add NEW KITS By district directly -->
<div class="modal fade" id="addkits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW KITS<br>
        <span class="text-danger" style="font-size:10px;">Mark zero if there is no item for specific coloumn</span></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/DistrictResources/addKits" method="post">
      <div class="modal-body">
                  <div class="form-group">
                    <label for="district">District<sup class="text-danger">*</sup></label>
                    <select class="form-control" name="district">
                        <option value="<?php echo $_SESSION['district'];?>"><?php echo $_SESSION['district'];?></option>
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
                  <div class="form-group">
                    <label for="patientbed">Patient Bed</label>
                    <input type="number" class="form-control" value="0" name="patientbed">
                  </div>
                  <div class="form-group">
                    <label for="quarantinebed">Quarantine Bed</label>
                    <input type="number" class="form-control"  value="0"  name="quarantinebed">
                  </div>
                  <div class="form-group">
                    <label for="icu">ICU bed</label>
                    <input type="number" class="form-control" value="0"  name="icu">
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
        <h5 class="modal-title" id="exampleModalLabel">Approve Data</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo URLROOT;?>/DistrictResources/approve" method="post">
      <div class="modal-body">
                    <h6>Are you sure you got these Resources from state?</h6>
                    <span style="font-size:10px;">After clicking approve this feature can't be undone and it will be added to your district data.</span>
                    <input type="hidden"id='editid' name='id'>  
                  <div class="form-group">
                    <input type="hidden" id="editppekits" class="form-control"name="ppekits">
                  </div>
                  <div class="form-group">
                    <input type="hidden" id="editn95"class="form-control"name="n95">
                  </div>
                  <div class="form-group">
                    <input type="hidden" id="editvtm"class="form-control"  name="vtm">
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="editventilator"name="ventilator">
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addsubscriber" class="btn btn-primary">Approve</button>
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
       $('#editppekits').val(data[2]);
       $('#editn95').val(data[3]);
       $('#editvtm').val(data[4]);
       $('#editventilator').val(data[5]); 
       $('#editid').val(data[8]);
   });
});
</script>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>
