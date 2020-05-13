<?php
class UserResources extends Controller
{   
    public function __construct()
    {
        if(!isLoggedIn('districtuser'))
        {
            echo '<script>alert("You do not have the persmission to access this page");location="'.URLROOT.'/Login"</script>';
        }
        $this->userResourcesModel=$this->model('UserResourcesModel');
    }

    public function index()
    {

        $res=$this->userResourcesModel->getData();
        $data=[
        'res'=>$res
        ];
        $this->views('resources/userresources',$data);
    } 
}

?>