<?php 
  class AddUser extends Controller{
      // only three people can add new user 1.scr will add CMO and testing Labs 2. CMO will add DA and DCC 3. DA will add SC
        public function __construct()
        {
            if(!isLoggedIn('statecontrolroom')&&!isLoggedIn('districtauthority'))
            {
                echo '<script>alert("You do not have the persmission to access this page");location="'.URLROOT.'/Login"</script>';
            }
            $this->authenticationModel=$this->model('AuthenticationModel');
        }
        public function index()
        {
            //show the list of users to scr,cmo,da
            $res=$this->authenticationModel->getUsers();
            $data=
            [
                'res'=>$res
            ];
            $this->views('functions/adduser',$data);
        }

        public function addNewUser()
        {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'name'=>$_POST['name'],
                    'username'=>$_POST['username'],
                    'password'=>$_POST['password'],
                    'type'=>$_POST['type'],
                    'tehsil'=>$_POST['tehsil'],
                    'district'=>$_POST['district'],
                ];
                if($this->authenticationModel->checkUserNameExist($data['username']))
                {
                    echo '<script>alert("Username Already exist. Try another one");location="'.URLROOT.'/AddUser"</script>';
                }
                else
                {
                    if($this->authenticationModel->addNew($data))
                    {
                        echo '<script>alert("New user added successfully");location="'.URLROOT.'/AddUser"</script>';
                    }
                    else
                    {
                        echo '<script>alert("There is some error while adding the new user! Try Again");location="'.URLROOT.'/AddUser"</script>';
                    }
                }
            }
            else
            {
                echo '<script>alert("You are not allowed to do this");location="'.URLROOT.'/AddUser"</script>';
            }
        }
        
        public function editUser()
        {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'name'=>$_POST['name'],
                    'username'=>$_POST['username'],
                    'type'=>$_POST['type'],
                    'tehsil'=>$_POST['tehsil'],
                    'district'=>$_POST['district'],
                    'id'=>$_POST['id']
                ];

                if($this->authenticationModel->checkUserNameChanged($data['username'],$data['id']))
                {
                    if($this->authenticationModel->checkUserNameExist($data['username']))
                    {
                        echo '<script>alert("Username Already exist. Try another one");location="'.URLROOT.'/AddUser"</script>';
                    }
                    else
                    {
                        if($this->authenticationModel->editUserData($data))
                        {
                            echo '<script>alert("Data Updated successfully");location="'.URLROOT.'/AddUser"</script>';
                        }
                        else
                        {
                            echo '<script>alert("There is some error while adding the new user! Try Again");location="'.URLROOT.'/AddUser"</script>';
                        }
                    }
                }
                else
                {       
                    if($this->authenticationModel->editUserData($data))
                        {
                            echo '<script>alert("Data updated successfully");location="'.URLROOT.'/AddUser"</script>';
                        }
                        else
                        {
                            echo '<script>alert("There is some error while adding the new user! Try Again");location="'.URLROOT.'/AddUser"</script>';
                        }
                }
            }
            else
            {
                echo '<script>alert("You are not allowed to do this");location="'.URLROOT.'/AddUser"</script>';
            }

        }


    public function deleteData()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $id=$_POST['id'];
            if($this->authenticationModel->deleteUser($id))
            {
                echo '<script>alert("User deleted successfully");location="'.URLROOT.'/AddUser"</script>';
            }
            else
            {
                echo '<script>alert("Error While Deleting the user! Try Again");location="'.URLROOT.'/AddUser"</script>';
            }
        }
        else
        {
            echo '<script>alert("You are not allowed to do this");location="'.URLROOT.'/AddUser"</script>';
        }
    }

  }
?>