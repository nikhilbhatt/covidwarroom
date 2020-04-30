<?php require_once APPROOT.'/views/includes/header.php'?>
<div class="container mt-5" >
  <div class="row mt-5">
    <div class="col-md-6 mx-auto mt-5">
      <div class="card card-body bg-light mt-5">
          <h2>Login</h2> 
          <p> Please fill your credentials</p>
          <form action="<?php echo URLROOT;?>/login" method="post">
            <div class="form-group">
               <label for="username">Username: <sup>*</sup></label>
               <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($data['username_err']))? 'is-invalid' : '';?>"
               value="<?php echo $data['username'];?>" autofocus>
               <span class="invalid-feedback"><?php echo $data['username_err'];?> </span>
            </div>
            <div class="form-group">
               <label for="password">Password: <sup>*</sup></label>
               <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err']))? 'is-invalid' : '';?>"
               value="<?php echo $data['password'];?>">
               <span class="invalid-feedback"><?php echo $data['password_err'];?> </span>
            </div>
            <div class="form-group">
                <label for="type">Type: <sup>*</sup></label>
                <select type="select" name="type" class="form-control">
                    <option value="scr">State Control Room</option>
                    <option value="cmo">Chief Medical Officer</option>
                    <option value="da">District Authority</option>
                    <option value="dcc">District Control Room</option>
                    <option value="tl">Testing Lab</option>
                    <option value="sc">Sample Collector</option>
                    
                </select>
                <span class="invalid-feedback"><?php echo $data['type_err'];?> </span>
            </div>
            
              <div class="text-center">
                <input type="submit" value="Login" class="btn btn-success">
              </div>
       </div>
    </div>
  </div>
</div>
<?php require_once APPROOT.'/views/includes/footer.php';?>