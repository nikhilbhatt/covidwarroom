
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5  "align="center">
    <div class='text-center'>
        <h1>Change Your Password</h1>
    </div>
            <div class="container mt-5">
                    <div class="col-md-8 col-lg-8 col-sm-12" >
                        <div class="card ">
                            <div class="card-header" align="left">Enter new password</div>
                            <div class="card-body">
                                <form action="<?php echo URLROOT;?>/ChangePassword" method="post" class="text-center">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon mr-3">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                                <input type="password" name="password" placeholder="Password*"
                                                     class="form-control <?php echo (!empty($data['password_err']))? 'is-invalid' : '';?>" value="<?php echo $data['password'];?>" autofocus >
                                               <span class="invalid-feedback ml-4" align="left"><?php echo $data['password_err'];?> </span>
                                            </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="input-group">
                                            <div class="input-group-addon mr-3">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input type="password" name="confirmpassword" placeholder="confirm Password*" 
                                            class="form-control <?php echo (!empty($data['confirmpassword_err']))? 'is-invalid' : '';?>" value="<?php echo $data['confirmpassword'];?>">
                                            <span class="invalid-feedback ml-4" align="left"><?php echo $data['confirmpassword_err'];?> </span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-success btn-sm">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>