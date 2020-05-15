<?php require_once APPROOT.'/views/includes/header.php'; ?>
<?php $page='generatepdf';require_once APPROOT.'/views/includes/navbar.php'; ?>

<div class="container">
    <h1 class="mt-5 text-center" style="font-weight:bold;"><strong>Generate Report</strong></h1>
    <div class="mt-4">
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
        <h5>Apply Filter</h5>
        <form action="<?php echo URLROOT;?>/GeneratePdf" method="post">
                <div class="form-group">
                <label for="date">Date: <sup>*</sup></label>
                <input type="text" name="date" id="datepicker" autocomplete="off" class="form-control form-control-lg <?php echo (!empty($data['date_err']))? 'is-invalid' : '';?>"
                value="<?php echo $data['date'];?>" >
                <span class="invalid-feedback"><?php echo $data['date_err'];?> </span>
                </div>
                <div class="form-group">
                <label for="">Select Type: <sup>*</sup></label><br>
                    <input type="checkbox" id="ppekits" name="ppekits" value="ppekits" <?php if($data['ppekits']=='ppekits') echo 'checked';?> >
                    <label for="ppekits"> PPE Kits </label>
                    <input type="checkbox" id="n95" name="n95" value="n95" <?php if($data['n95']=='n95') echo 'checked';?>>
                    <label for="n95">N95</label>
                    <input type="checkbox" id="vtm" name="vtm" value="vtm" <?php if($data['vtm']=='vtm') echo 'checked';?>>
                    <label for="vtm"> VTM</label>
                    <input type="checkbox" id="ventilator" name="ventilator" value="ventilator" <?php if($data['ventilator']=='ventilator') echo 'checked';?>>
                    <label for="ventilator"> Ventilator</label>
                    <input type="checkbox" id="patientbed" name="patientbed" value="patientbed" <?php if($data['patientbed']=='patientbed') echo 'checked';?>>
                    <label for="patientbed">Patient Bed</label>
                    <input type="checkbox" id="quarantinebed" name="quarantinebed" value="quarantinebed" <?php if($data['quarantinebed']=='quarantinebed') echo 'checked';?>>
                    <label for="quarantinebed">Quarantine Bed</label>
                    <input type="checkbox" id="icu" name="icu" value="icu" <?php if($data['icu']=='icu') echo 'checked';?>>
                    <label for="icu">ICU</label>
                </div>
                <div >
                    <input type="submit" value="Get Record" class="btn btn-success">
                </div>
        </form>
            <h2 class="text-center mt-5"> <?php echo $data['date'];?> Report</h2><br>
            <?php if(empty($data['res'])):?>
                <h4> No Record Found</h4>
            <?php else: ?>
                <table id="tableid" class="table table-striped table-hover mb-5" >
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
                        <?php $res=array(); array_push($res,$data['date']);if($result->district==$_SESSION['district']):?>
                        <?php if($data['ppekits']=='ppekits'):?>
                            <tr>
                                <td scope="row"><?php echo $key++;?></td>
                                <td scope="row"><?php echo 'PPE Kits';array_push($res,'PPE Kits');?></td> 
                                <?php if(date("yy-m-d",strtotime($result->date))==$data['date']):?>
                                <td><?php echo $result->ppekitsaddedtoday; array_push($res,$result->ppekitsaddedtoday);?></td>
                                <td><?php echo $result->ppekitsusedtoday; array_push($res,$result->ppekitsusedtoday);?></td>
                                <td><?php echo $result->ppekitsvacanttoday;array_push($res,$result->ppekitsvacanttoday);?></td>
                                <?php else:?>
                                <td>0 <?php array_push($res,0);?></td>
                                <td>0 <?php array_push($res,0);?></td>
                                <td>0 <?php array_push($res,0);?></td>
                                <?php endif;?>    
                                <td><?php echo $result->ppekitsusedcumulative;array_push($res,$result->ppekitsusedcumulative);?></td>
                                <td><?php echo $result->ppekitsvacantcumulative;array_push($res,$result->ppekitsvacantcumulative);?></td>
                                <td><?php echo $result->ppekitscumulative;array_push($res,$result->ppekitscumulative);?></td>
                            </tr>
                        <?php endif;?>
                        <?php if($data['vtm']=='vtm'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="row"><?php echo 'VTM';array_push($res,'VTM');?></td> 
                            <?php if(date("Y-m-d",strtotime($result->date))==$data['date']):?>    
                            <td><?php echo $result->vtmaddedtoday;array_push($res,$result->vtmaddedtoday);?></td>
                            <td><?php echo $result->vtmusedtoday;array_push($res,$result->vtmusedtoday);?></td>
                            <td><?php echo $result->vtmvacanttoday;array_push($res,$result->vtmvacanttoday);?></td>
                            <?php else:?>
                            <td>0<?php array_push($res,0);?></td>
                            <td>0<?php array_push($res,0);?></td>
                            <td>0<?php array_push($res,0);?></td>
                            <?php endif;?> 
                            <td><?php echo $result->vtmusedcumulative;array_push($res,$result->vtmusedcumulative);?></td>
                            <td><?php echo $result->vtmvacantcumulative;array_push($res,$result->vtmvacantcumulative);?></td>
                            <td><?php echo $result->vtmcumulative;array_push($res,$result->vtmcumulative);?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($data['n95']=='n95'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="row"><?php echo 'n95';array_push($res,'n95');?></td>  
                            <?php if(date("Y-m-d",strtotime($result->date))==$data['date']):?>   
                            <td><?php echo $result->n95addedtoday;array_push($res,$result->n95addedtoday);?></td>
                            <td><?php echo $result->n95usedtoday;array_push($res,$result->n95usedtoday);?></td>
                            <td><?php echo $result->n95vacanttoday;array_push($res,$result->n95vacanttoday);?></td>
                            <?php else:?>
                            <td>0<?php array_push($res,0);?></td>
                            <td>0<?php array_push($res,0);?></td>
                            <td>0<?php array_push($res,0);?></td>
                            <?php endif;?> 
                            <td><?php echo $result->n95usedcumulative;array_push($res,$result->n95usedcumulative);?></td>
                            <td><?php echo $result->n95vacantcumulative;array_push($res,$result->n95vacantcumulative);?></td>
                            <td><?php echo $result->n95cumulative;array_push($res,$result->n95cumulative);?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($data['ventilator']=='ventilator'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="row"><?php echo 'Ventilators';array_push($res,'Ventilators');?></td>     
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td><?php echo $result->ventilatorusedcumulative;array_push($res,$result->ventilatorusedcumulative);?></td>
                            <td><?php echo $result->ventilatorvacantcumulative;array_push($res,$result->ventilatorvacantcumulative);?></td>
                            <td><?php echo $result->ventilatorcumulative;array_push($res,$result->ventilatorcumulative);?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($data['patientbed']=='patientbed'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="roe"><?php echo 'Patient Bed';array_push($res,'Patient Bed');?></td>     
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td><?php echo $result->patientbedusedcumulative;array_push($res,$result->patientbedusedcumulative);?></td>
                            <td><?php echo $result->patientbedvacantcumulative;array_push($res,$result->patientbedvacantcumulative);?></td>
                            <td><?php echo $result->patientbedcumulative;array_push($res,$result->patientbedcumulative);?></td>
                        </tr>
                        <tr>
                        <?php endif;?>
                        <?php if($data['quarantinebed']=='quarantinebed'):?>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="roe"><?php echo 'Quarantine Bed'; array_push($res,'Quarantine Bed');?></td>     
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td><?php echo $result->quarantinebedusedcumulative;array_push($res,$result->quarantinebedusedcumulative);?></td>
                            <td><?php echo $result->quarantinebedvacantcumulative;array_push($res,$result->quarantinebedvacantcumulative);?></td>
                            <td><?php echo $result->quarantinebedcumulative;array_push($res,$result->quarantinebedcumulative);?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($data['icu']=='icu'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="roe"><?php echo 'ICU Bed'; array_push($res,'ICU Bed');?></td>     
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td>-<?php array_push($res,'-');?></td>
                            <td><?php echo $result->icuusedcumulative;array_push($res,$result->icuusedcumulative);?></td>
                            <td><?php echo $result->icuvacantcumulative;array_push($res,$result->icuvacantcumulative);?></td>
                            <td><?php echo $result->icucumulative;array_push($res,$result->icucumulative);?></td>
                        </tr>
                        <?php endif;?>
                       <?php endif;?>
                    <?php endforeach; ?>
                 </tbody>
                </table>
                <form action="<?php echo URLROOT;?>/GeneratePdf/generate" method="POST">
                        
                       <?php $postvalue = base64_encode(serialize($res)); ?>
                        <input type="hidden" name="result" value="<?php echo $postvalue; ?>">
                       <input type="submit" value="View Data in Pdf" class="btn btn-success">
                </form>
             <?php endif;?>
            </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
  $( function() {
    $( "#datepicker" ).datepicker(
        {dateFormat: 'yy-mm-dd'}
    );
  } );
  </script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
