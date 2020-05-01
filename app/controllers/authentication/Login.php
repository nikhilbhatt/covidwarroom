<?php

 class Login extends Controller{
     public function __construct()
     {
         $this->authenticationModel=$this->model('AuthenticationModel');
     }

     public function index()
     {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
                'username'=>$_POST['username'],
                'password'=>$_POST['password'],
                'type'=>$_POST['type'],
                'username_err'=>'',
                'password_err'=>'',
                'type_err'=>''
            ];
            if(empty($data['username']))
            {
                $data['username_err']='username can\'t be empty';
            }
            if(empty($data['password']))
            {
                $data['password_err']='password can\'t be empty';
            }
            
            if(empty($data['username_err'])&&empty($data['password_err']))
            {
                  //find user in users table and if verified send him to desired location
                  if($this->authenticationModel->Login($data))
                  { 
                      $location='';
                    switch($_SESSION['type']){
                        case 'scr':
                            //go to state control room dashboard
                            $location='Login'; //location variable contains Controller Name
                            break;
                        case 'da':
                            //go to district authority controller
                            pass;
                            break;
                        case 'dcc':
                            //got to district collection center dashboard
                            pass;
                            break;
                        case 'tl':
                            //go to testing lab dashboard
                            pass;
                            break;
                        case 'cmo':
                            //go to Cheif Medical officer Dashboard
                            pass;
                            break;
                        case 'sc':
                            //got to Sample collector dashoard
                            pass;
                            break;
                        default:
                            //something wrong
                            echo '<script>alert("Something went wrong!Try Again");document.location="'.URLROOT.'/Login"</script>';
                    }  
                    echo '<script>alert("Verification Successful");document.location="'.URLROOT.'/'.$location.'"</script>';
                  }
                  else
                  {
                    echo '<script>alert("Enter correct username and password");document.location="'.URLROOT.'/Login"</script>';
                  }

            }
            else
            {
                $this->views('authentication/login',$data);
            }

        }
        else
        {
            $data=[
                'username'=>'',
                'password'=>'',
                'type'=>'',
                'username_err'=>'',
                'password_err'=>'',
                'type_err'=>''
            ];
            $this->views('authentication/login',$data);
        }
     }
 }

?>