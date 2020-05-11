<?php
class DistrictResources extends Controller
{   
    public function __construct()
    {
        if(!isLoggedIn('districtauthority'))
        {
            echo '<script>alert("You do not have the persmission to access this page");location="'.URLROOT.'/Login"</script>';
        }
        $this->stateResourcesModel=$this->model('StateResourcesModel');
    }

    public function index()
    {
        $res=$this->stateResourcesModel->getStateData();
        $districtres=$this->stateResourcesModel->getDistrictResources();
        // echo '<pre>';
        // var_dump($res);
        // var_dump($districtres);
        // echo '</pre>';
        // die();
        $data=[
            'res'=>$res,
            'districtres'=>$districtres
        ];
        $this->views('resources/districtresources',$data);
    }

    public function approve()
    {   
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[
                'ppekits'=>(int)$_POST['ppekits'],
                'n95'=>(int)$_POST['n95'],
                'vtm'=>(int)$_POST['vtm'],
                'ventilator'=>(int)$_POST['ventilator'],
                'id'=>$_POST['id']
            ];
            if($this->stateResourcesModel->approveKits($data))
            {
                echo '<script>alert("values updated.");location="'.URLROOT.'/DistrictResources"</script>'; 
            }
            else
            {
                echo '<script>alert("Some error occured!! try again");location="'.URLROOT.'/DistrictResources"</script>'; 
            }
        }
        else
        {
            echo '<script>alert("You are not allowed to do this operation");location="'.URLROOT.'/DistrictResources"</script>';
        }
    }
   
}

?>