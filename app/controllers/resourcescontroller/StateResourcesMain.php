<?php
class StateResourcesMain extends Controller
{   
    public function __construct()
    {
        // die('as');
        $this->stateResourcesModel=$this->model('StateResourcesModel');
    }

    public function index()
    {
        $res=$this->stateResourcesModel->getStateData();
        $approvedres=$this->stateResourcesModel->getApproved();
        
        $data=[
            'res'=>$res,
            'approvedres'=>$approvedres
        ];
        $this->views('resources/stateresourcesmain',$data);
    }
   
    public function distributeKits()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[
                'district'=>$_POST['district'],
                'ppekits'=>(int)$_POST['ppekits'],
                'n95'=>(int)$_POST['n95'],
                'vtm'=>(int)$_POST['vtm'],
                'ventilator'=>(int)$_POST['ventilator']
            ];
            if($data['ppekits']==0&&$data['n95']==0&&$data['vtm']==0&&$data['ventilator']==0)
            {   
                echo '<script>alert("Must enter a value for district");location="'.URLROOT.'/StateResourcesMain"</script>'; 
            }
            elseif($data['ppekits']<0||$data['n95']<0||$data['vtm']<0||$data['ventilator']<0)
            {
                echo '<script>alert("Must enter a positive value");location="'.URLROOT.'/StateResourcesMain"</script>'; 
            }
            else
            {
                if($this->stateResourcesModel->addKits($data))
                {
                    echo '<script>alert("Kits distributed to district.");location="'.URLROOT.'/StateResourcesMain"</script>'; 
                }
                else
                {
                    echo '<script>alert("Some error occured!! try again");location="'.URLROOT.'/StateResourcesMain"</script>'; 
                }
            }
        }
        else
        {
            echo '<script>alert("You are not allowed to do this operation");location="'.URLROOT.'/StateResourcesMain"</script>';
        }
    }
    public function editKits()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[
                'district'=>$_POST['district'],
                'ppekits'=>(int)$_POST['ppekits'],
                'n95'=>(int)$_POST['n95'],
                'vtm'=>(int)$_POST['vtm'],
                'ventilator'=>(int)$_POST['ventilator'],
                'id'=>$_POST['id']
            ];
            if($data['ppekits']==0&&$data['n95']==0&&$data['vtm']==0&&$data['ventilator']==0)
            {   
                echo '<script>alert("Must enter a value for district");location="'.URLROOT.'/StateResourcesMain"</script>'; 
            }
            elseif($data['ppekits']<0||$data['n95']<0||$data['vtm']<0||$data['ventilator']<0)
            {
                echo '<script>alert("Must enter a positive value");location="'.URLROOT.'/StateResourcesMain"</script>'; 
            }
            else
            {
                if($this->stateResourcesModel->updateKits($data))
                {
                    echo '<script>alert("values updated.");location="'.URLROOT.'/StateResourcesMain"</script>'; 
                }
                else
                {
                    echo '<script>alert("Some error occured!! try again");location="'.URLROOT.'/StateResourcesMain"</script>'; 
                }
            }
        }
        else
        {
            echo '<script>alert("You are not allowed to do this operation");location="'.URLROOT.'/StateResourcesMain"</script>';
        }
    }
}

?>