<?php require_once APPROOT . '/views/includes/header.php'; ?>
<?php $page='userresources';require_once APPROOT . '/views/includes/navbar.php'; ?>
<!-- Distribute NEW PPE kits to state:-
SEE the total PPE kits and thier availability in state
SEE the list which is not yet approved by the state  -->


<div  class="container">
    <div class="mt-4">
    <div md-5 mt-2 align="right">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addkits"><i class="fa fa-plus"></i>Add New Kits</Button>
        </div>
    <h4>Welcome <span class="text-danger"><?php echo ucwords($_SESSION['district']);?> </span>District Fascility user</h4>
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
            <h1 class="text-center">Resources You have</h1>
            <?php if(empty($data['res'])):?>
            <h4> No resources Available in your district</h4>
            <?php else: ?>
            <table id="tableid" class="table table-striped table-hover mb-5" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th sope="col">Item</th>
                    <th scope="col">Added Today</th>
                    <th scope="col">Used Today</th>
                    <th scope="col">Vacant Today</th>
                    <th scope="col">Total Used</th>
                    <th scope="col">Total Vacant</th>
                    <th scope="col">Total </th>
                </tr>
                </thead>
                <tbody>
                <?php $key=1;?>
                <?php foreach($data['res'] as $result) : ?>
                <?php if($result->district==$_SESSION['district']):?>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'PPE Kits';?></td> 
                    <?php if(date("Y-m-d",strtotime($result->date))==date("Y-m-d",time())):?>
                    <td><?php echo $result->ppekitsaddedtoday;?></td>
                    <td><?php echo $result->ppekitsusedtoday;?></td>
                    <td><?php echo $result->ppekitsvacanttoday;?></td>
                    <?php else:?>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <?php endif;?>    
                    <td><?php echo $result->ppekitsusedcumulative;?></td>
                    <td><?php echo $result->ppekitsvacantcumulative;?></td>
                    <td><?php echo $result->ppekitscumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'VTM';?></td> 
                    <?php if(date("Y-m-d",strtotime($result->date))==date("Y-m-d",time())):?>    
                    <td><?php echo $result->vtmaddedtoday;?></td>
                    <td><?php echo $result->vtmusedtoday;?></td>
                    <td><?php echo $result->vtmvacanttoday;?></td>
                    <?php else:?>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <?php endif;?> 
                    <td><?php echo $result->vtmusedcumulative;?></td>
                    <td><?php echo $result->vtmvacantcumulative;?></td>
                    <td><?php echo $result->vtmcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'n95';?></td>  
                    <?php if(date("Y-m-d",strtotime($result->date))==date("Y-m-d",time())):?>   
                    <td><?php echo $result->n95addedtoday;?></td>
                    <td><?php echo $result->n95usedtoday;?></td>
                    <td><?php echo $result->n95vacanttoday;?></td>
                    <?php else:?>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <?php endif;?> 
                    <td><?php echo $result->n95usedcumulative;?></td>
                    <td><?php echo $result->n95vacantcumulative;?></td>
                    <td><?php echo $result->n95cumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="row"><?php echo 'Ventilators';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->ventilatorusedcumulative;?></td>
                    <td><?php echo $result->ventilatorvacantcumulative;?></td>
                    <td><?php echo $result->ventilatorcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'Patient Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->patientbedusedcumulative;?></td>
                    <td><?php echo $result->patientbedvacantcumulative;?></td>
                    <td><?php echo $result->patientbedcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'Quarantine Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->quarantinebedusedcumulative;?></td>
                    <td><?php echo $result->quarantinebedvacantcumulative;?></td>
                    <td><?php echo $result->quarantinebedcumulative;?></td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $key++;?></td>
                    <td scope="roe"><?php echo 'ICU Bed';?></td>     
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo $result->icuusedcumulative;?></td>
                    <td><?php echo $result->icuvacantcumulative;?></td>
                    <td><?php echo $result->icucumulative;?></td>
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
