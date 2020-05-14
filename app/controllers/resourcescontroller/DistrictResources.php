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
        $data=[
            'res'=>$res,
            'districtres'=>$districtres,
            'district'=>'',
            'ppekits'=>'',
            'n95'=>'',
            'vtm'=>'',
            'ventilator'=>'',
            'patientbed'=>'',
            'quarantinebed'=>'',
            'icu'=>''
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

    public function addKits()
    {

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[
                'district'=>$_POST['district'],
                'ppekits'=>(int)$_POST['ppekits'],
                'n95'=>(int)$_POST['n95'],
                'vtm'=>(int)$_POST['vtm'],
                'ventilator'=>(int)$_POST['ventilator'],
                'patientbed'=>(int)$_POST['patientbed'],
                'quarantinebed'=>(int)$_POST['quarantinebed'],
                'icu'=>(int)$_POST['icu']
            ];
            if($data['ppekits']==0&&$data['n95']==0&&$data['vtm']==0&&$data['ventilator']==0&&$data['patientbed']==0&&$data['quarantinebed']==0&&$data['icu']==0)
            {   
                echo '<script>alert("Must enter a value for district");location="'.URLROOT.'/DistrictResources"</script>'; 
            }
            elseif($data['ppekits']<0||$data['n95']<0||$data['vtm']<0||$data['ventilator']<0||$data['patientbed']<0||$data['quarantinebed']<0||$data['icu']<0)
            {
                echo '<script>alert("Must enter a positive value");location="'.URLROOT.'/DistrictResources"</script>'; 
            }
            else
            {
                if($this->stateResourcesModel->addDistrictKits($data))
                {
                    echo '<script>alert("values updated.");location="'.URLROOT.'/DistrictResources"</script>'; 
                }
                else
                {
                    echo '<script>alert("Some error occured!! try again");location="'.URLROOT.'/DistrictResources"</script>'; 
                }
            }
        }
        else
        {
            echo '<script>alert("You are not allowed to do this operation");location="'.URLROOT.'/DistrictResources"</script>';
        }
    }
   
}

?>