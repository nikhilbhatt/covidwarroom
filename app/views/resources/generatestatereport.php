<?php require_once APPROOT.'/views/includes/header.php'; ?>
<?php $page='generatepdf';require_once APPROOT.'/views/includes/navbar.php'; ?>

<div class="container">
    <h1 class="mt-5 text-center" style="font-weight:bold;"><strong>Generate Report</strong></h1>
    <div class="mt-4">
        <div class="card card-body bg-light md-5 mb-5 table-responsive-md">
        <h5>Apply Filter</h5>
        <form action="<?php echo URLROOT;?>/GenerateStateReport" method="post">
                <div class="form-group">
                <label for="date">Date: <sup>*</sup></label>
                <input type="text" name="date" id="datepicker"  autocomplete="off"class="form-control form-control-lg <?php echo (!empty($data['date_err']))? 'is-invalid' : '';?>"
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
                <div class="form-group">
                    <label for="district">District<sup class="text-danger">*</sup></label>
                    <select class="form-control" name="district" value="<?php echo $data['district'];?>" >
                        <option value="almora" <?php if($data['district']=='almora'){echo 'selected';}?>>Almora</option>
                        <option value="bageshwar" <?php if($data['district']=='bageshwar'){echo 'selected';}?>>Bageshwar</option>
                        <option value="chamoli" <?php if($data['district']=='chamoli'){echo 'selected';}?>>Chamoli</option>
                        <option value="champawat" <?php if($data['district']=='champawat'){echo 'selected';}?>>Champawat</option>
                        <option value="dehradun" <?php if($data['district']=='dehradun'){echo 'selected';}?>>Dehradun</option>
                        <option value="haridwar"<?php if($data['district']=='haridwar'){echo 'selected';}?>>Haridwar</option>
                        <option value="nainital"<?php if($data['district']=='nainital'){echo 'selected';}?>>Nainital</option>
                        <option value="paurigarhwal"<?php if($data['district']=='paurigarhwal'){echo 'selected';}?>>Pauri Garhwal</option>
                        <option value="pithoragarh" <?php if($data['district']=='pithoragarh'){echo 'selected';}?>>Pithoragarh</option>
                        <option value="rudraprayag"<?php if($data['district']=='rudraprayag'){echo 'selected';}?>>Rudraprayag</option>
                        <option value="tehrigarhwal"<?php if($data['district']=='tehrigarhwal'){echo 'selected';}?>>Tehri Garhwal</option>
                        <option value="udhamsinghnagar"<?php if($data['district']=='udhamsinghnagar'){echo 'selected';}?>>Udham Singh Nagar</option>
                        <option value="uttarkashi" <?php if($data['district']=='uttarkashi'){echo 'selected';}?>>Uttarkashi</option>
                    </select>
                  </div>
                <div >
                    <input type="submit" value="Get Record" class="btn btn-success">
                </div>
        </form>
            <h2 class="text-center mt-5"> <?php echo $data['district'];?> Report As on <?php echo $data['date']?></h2><br>
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
                        <?php if($data['ppekits']=='ppekits'):?>
                            <tr>
                                <td scope="row"><?php echo $key++;?></td>
                                <td scope="roe"><?php echo 'PPE Kits';?></td> 
                                <?php if(date("Y-m-d",strtotime($result->date))==$data['date']):?>
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
                        <?php endif;?>
                        <?php if($data['vtm']=='vtm'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="row"><?php echo 'VTM';?></td> 
                            <?php if(date("Y-m-d",strtotime($result->date))==$data['date']):?>    
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
                        <?php endif;?>
                        <?php if($data['n95']=='n95'):?>
                        <tr>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="row"><?php echo 'n95';?></td>  
                            <?php if(date("Y-m-d",strtotime($result->date))==$data['date']):?>   
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
                        <?php endif;?>
                        <?php if($data['ventilator']=='ventilator'):?>
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
                        <?php endif;?>
                        <?php if($data['patientbed']=='patientbed'):?>
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
                        <?php endif;?>
                        <?php if($data['quarantinebed']=='quarantinebed'):?>
                            <td scope="row"><?php echo $key++;?></td>
                            <td scope="roe"><?php echo 'Quarantine Bed';?></td>     
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><?php echo $result->quarantinebedusedcumulative;?></td>
                            <td><?php echo $result->quarantinebedvacantcumulative;?></td>
                            <td><?php echo $result->quarantinebedcumulative;?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($data['icu']=='icu'):?>
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
