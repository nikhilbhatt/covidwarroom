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
        
        $data=[
        ];
        $this->views('resources/userresources',$data);
    } 
}

?>