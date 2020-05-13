<?php

class GenerateStateReport extends Controller{
    public function __construct()
    {
        if(!isLoggedIn('statecontrolroom'))
            {
                echo '<script>alert("You do not have the persmission to access this page");location="'.URLROOT.'/Login"</script>';
            }
        $this->generatePdf=$this->model('GeneratePdfModel');
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=[
                'date'=>$_POST['date'],
                'district'=>$_POST['district'],
                'ppekits'=>$_POST['ppekits'],
                'n95'=>$_POST['n95'],
                'vtm'=>$_POST['vtm'],
                'ventilator'=>$_POST['ventilator'],
                'patientbed'=>$_POST['patientbed'],
                'quarantinebed'=>$_POST['quarantinebed'],
                'icu'=>$_POST['icu'],
                'date_err'=>'',
                'res'=>''
            ];
            if(date("yy-m-d",time())<$data['date']){
                $data['date_err']='Date Selected must be less than current date';
            }
            if(empty($data['date_err']))
            {
                $res=$this->generatePdf->getFilteredStateData($data);
                $data['res']=$res;
                $this->views('resources/generatestatereport',$data);
            }
            else
            {
                $this->views('resources/generatestatereport',$data);
            }
        }
        else
        {
            $res='';
            $data=[
                'date'=>'',
                'district'=>'',
                'ppekits'=>'',
                'n95'=>'',
                'vtm'=>'',
                'ventilator'=>'',
                'patientbed'=>'',
                'quarantinebed'=>'',
                'icu'=>'',
                'date_err'=>'',
                'res'=>$res
            ];
            $this->views('resources/generatestatereport',$data);
        }
    }
}

?>