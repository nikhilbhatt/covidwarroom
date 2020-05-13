<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="#">Covid War Room Uttarakhand</a>

  <div class="collapse navbar-collapse text-white" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
    <?php if(session_status()==PHP_SESSION_NONE){session_start();}?>
    <?php if($_SESSION['type']=='statecontrolroom'):?>
        <li class="ml-3 nav-item <?php if($page=='stateresources'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/StateResourcesMain"><i class="fa fa-home"></i> Home</a></li>
        <li class="ml-3 nav-item <?php if($page=='generatepdf'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/GenerateStateReport"><i class="fa fa-home"></i> Generate Report</a></li>
        <li class="ml-3 nav-item <?php if($page=='adduser'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/AddUser"><i class="fa fa-user-plus"></i> Add New District Authority User</a></li>
        <li class="ml-3 nav-item <?php if($page=='changepassword'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/ChangePassword"><i class="fa fa-lock"></i> Change Your Password</a></li>
      <?php elseif($_SESSION['type']=='districtauthority'):?>
        <li class="ml-3 nav-item <?php if($page=='districtresources'){echo 'active';}?>"><a class="nav-link " href="<?php echo URLROOT;?>/DistrictResources"><i class="fa fa-home"></i> Home</a></li>
        <li class="ml-3 nav-item <?php if($page=='generatepdf'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/GeneratePdf"><i class="fa fa-file"></i> GenerateReport</a></li>
        <li class="ml-3 nav-item <?php if($page=='adduser'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/AddUser"><i class="fa fa-user-plus"></i> Add New District Fascility User</a></li>
        <li class="ml-3 nav-item <?php if($page=='changepassword'){echo 'active';}?>"><a class="nav-link " href="<?php echo URLROOT;?>/ChangePassword"><i class="fa fa-lock"></i> Change Your Password</a></li>
      <?php else:?>
        <li class="ml-3 nav-item <?php if($page=='userresources'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/UserResources"><i class="fa fa-home"></i> Home</a></li>
        <li class="ml-3 nav-item <?php if($page=='generatepdf'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/GeneratePdf"><i class="fa fa-file"></i> GenerateReport</a></li>
        <li class="ml-3 nav-item <?php if($page=='changepassword'){echo 'active';}?>"><a class="nav-link" href="<?php echo URLROOT;?>/ChangePassword"><i class="fa fa-home"></i> Change Your Password</a></li>
      <?php endif;?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a class="nav-link "href="<?php echo URLROOT;?>/Logout"><i class="fa fa-sign-out"></i> Logout</a></li>
    </ul>
  </div>

<i class="fas">
</nav>