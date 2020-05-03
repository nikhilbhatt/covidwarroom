<?php

class ChangePassword extends Controller{
 
        public function __construct(){
            if(!isLoggedIn('statecontrolroom')&&!isLoggedIn('districtauthority')&&!isLoggedIn('districtuser'))
            {
                echo '<script>alert("You do not have the persmission to access this page");location="'.URLROOT.'/Login"</script>';
            }
            $this->changePassword=$this->model('AuthenticationModel');
        }
        public function index(){
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'password'=>$_POST['password'],
                    'confirmpassword'=>$_POST['confirmpassword'],
                    'password_err'=>'',
                    'confirmpassword_err'=>''
                ];
                if(empty($data['password']))
                {
                    $data['password_err']='Password field Can\'t be empty';
                }
                elseif(strlen($data['password'])<6)
                {
                    $data['password_err']='Password length must be equal or greater than 6';
                }

                if(empty($data['confirmpassword']))
                {
                    $data['confirmpassword_err']='Confirm Password field can\'t be empty';
                }
                elseif($data['password']!=$data['confirmpassword'])
                {
                    $data['confirmpassword_err']='Password Doesn\'t match';
                }
                
                if(empty($data['password_err'])&&empty($data['confirmpassword_err']))
                {
                     //no error change password in database.
                     if($this->changePassword->updatePassword($data))
                     {
                        echo '<script>alert("Password Changed");document.location="'.URLROOT.'/ChangePassword"</script>';
                     }
                     else
                     {
                        echo '<script>alert("Can\'t update password");document.location="'.URLROOT.'/ChangePassword"</script>';
                     }
                }
                else
                {
                    $this->views('authentication/changepassword',$data);
                }

            }
            else
            {
                $data=[
                    'password'=>'',
                    'confirmpassword'=>'',
                    'password_err'=>'',
                    'confirmpassword_err'=>''
                ];
                $this->views('authentication/changepassword',$data);
            }   
        }

}

?>