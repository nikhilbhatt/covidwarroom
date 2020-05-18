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
                'ppekits'=>'',
                'n95'=>'',
                'vtm'=>'',
                'ventilator'=>'',
                'patientbed'=>'',
                'quarantinebed'=>'',
                'icu'=>'',
                'date_err'=>'',
                'res'=>'',
                'districtres'=>'',
                'kits_err'=>''
            ];
            if(isset($_POST['ppekits']))
            {
                $data['ppekits']=$_POST['ppekits'];
            }
            if(isset($_POST['n95']))
            {
               $data['n95']= $_POST['n95'];
            }
            if(isset($_POST['vtm']))
            {
                $data['vtm']=$_POST['vtm'];
            }
            if(isset($_POST['ventilator']))
            {
                $data['ventilator']=$_POST['ventilator'];
            }
            if(isset($_POST['patientbed']))
            {
                $data['patientbed']=$_POST['patientbed'];
            }
            if(isset($_POST['quarantinebed']))
            {
                $data['quarantinebed']=$_POST['quarantinebed'];
            }
            if(isset($_POST['icu']))
            {
                $data['icu']= $_POST['icu'];
            }
            if(empty($data['ppekits'])&&empty($data['n95'])&&empty($data['vtm'])&&empty($data['ventilator'])&&empty($data['patientbed'])&&empty($data['quarantinebed'])&&empty($data['icu']))
            {
                $data['kits_err']='select atleast one of above data';
                
            }

            if(date("yy-m-d",time())<$data['date']){
                $data['date_err']='Date Selected must be less than current date';
            }
            if(empty($data['date_err'])&&empty($data['kits_err']))
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
                'res'=>$res,
                'kits_err'=>''
            ];
            $this->views('resources/generatestatereport',$data);
        }
    }
    public function generate()
    {

        $postvalue = unserialize(base64_decode($_POST['result']));
        $statelatestdata=$this->generatePdf->getLatestStateData($postvalue[0]);
        // var_dump($postvalue);
        // die();
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('State Control Room');
        $pdf->SetTitle('Resources Report');
        $pdf->SetSubject('Daily Resources Report');
        $pdf->SetKeywords('Report, PDF, Resources, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        if(count($postvalue)>1)
        {
                $district=ucwords($postvalue[0]);
                $date=$postvalue[1];
                $html="<h2>District:-$district</h2>
                    <h3>Date:- $date</h3>
                <br>";
                $pdf->writeHTML($html, true, false, true, false, '');

                $header=array('ITEM Name','Added Today','Used Today','Vacant Today','Used Cumulative','Vacant Cumulative','Total Cumulative');

                // set text shadow effect
                $pdf->SetFillColor(255, 0, 0);
                $pdf->SetTextColor(255);
                $pdf->SetDrawColor(128, 0, 0);
                $pdf->SetLineWidth(0.4);
                $pdf->SetFont('', 'N');
                // Header
                $w = array(40, 19,18, 20,31,31,31);
                $num_headers = count($header);
                for($i = 0; $i < $num_headers; ++$i) {
                    $pdf->MultiCell($w[$i], 15, $header[$i], 1,'C', 1,0,'','',true);
                }
                $pdf->Ln();
                // Color and font restoration
                $pdf->SetFillColor(224, 235, 255);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = 0;
                for($i=2;$i<count($postvalue);$i++) {
                    $pdf->Cell($w[0], 10, $postvalue[$i], 'LR', 0, 'L', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[1], 10, $postvalue[$i], 'LR', 0, 'R', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[2], 10, $postvalue[$i], 'LR', 0, 'R', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[3], 10, $postvalue[$i], 'LR', 0, 'R', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[4], 10, $postvalue[$i], 'LR', 0, 'R', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[5], 10, $postvalue[$i], 'LR', 0, 'R', $fill);
                    $i=$i+1;
                    $pdf->Cell($w[6], 10,$postvalue[$i], 'LR', 0, 'R', $fill);
                    $pdf->Ln();
                    $fill=!$fill;
                }
                $pdf->Cell(array_sum($w), 0, '', 'T');
            }
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.


        /* 
        
        work on new pdf from HERE
        
        */

        $html="<br><h2>Total Available kits in $postvalue[0] till date</h2>
        ";
        $pdf->writeHTML($html, true, false, true, false, '');

        $header=array('ITEM Name','Used Cumulative','Vacant Cumulative','Total Cumulative');

        // set text shadow effect
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(0.4);
        $pdf->SetFont('', 'N');
        // Header
        $w = array( 50, 45,45,45);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $pdf->MultiCell($w[$i], 15, $header[$i], 1,'C', 1,0,'','',true);
        }
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');

        $pdf->Cell($w[0], 10, 'PPE Kits', 'LR', 0, 'L', 0);
        $pdf->Cell($w[1], 10, $statelatestdata->ppekitsusedcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[2], 10, $statelatestdata->ppekitsvacantcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[3], 10, $statelatestdata->ppekitscumulative, 'LR', 0, 'R', 0);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'N95 Masks', 'LR', 0, 'L', 1);
        $pdf->Cell($w[1], 10, $statelatestdata->n95usedcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[2], 10, $statelatestdata->n95vacantcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[3], 10, $statelatestdata->n95cumulative, 'LR', 0, 'R', 1);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'VTM', 'LR', 0, 'L', 0);
        $pdf->Cell($w[1], 10, $statelatestdata->vtmusedcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[2], 10, $statelatestdata->vtmvacantcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[3], 10, $statelatestdata->vtmcumulative, 'LR', 0, 'R', 0);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'Ventilators', 'LR', 0, 'L', 1);
        $pdf->Cell($w[1], 10, $statelatestdata->ventilatorusedcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[2], 10, $statelatestdata->ventilatorvacantcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[3], 10, $statelatestdata->ventilatorcumulative, 'LR', 0, 'R', 1);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'Patient Bed', 'LR', 0, 'L', 0);
        $pdf->Cell($w[1], 10, $statelatestdata->patientbedusedcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[2], 10, $statelatestdata->patientbedvacantcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[3], 10, $statelatestdata->patientbedcumulative, 'LR', 0, 'R', 0);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'Quarantine Bed', 'LR', 0, 'L', 1);
        $pdf->Cell($w[1], 10, $statelatestdata->quarantinebedusedcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[2], 10, $statelatestdata->quarantinebedvacantcumulative, 'LR', 0, 'R', 1);
        $pdf->Cell($w[3], 10, $statelatestdata->quarantinebedcumulative, 'LR', 0, 'R', 1);
        $pdf->Ln();
        $pdf->Cell($w[0], 10, 'ICU Bed', 'LR', 0, 'L', 0);
        $pdf->Cell($w[1], 10, $statelatestdata->icuusedcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[2], 10, $statelatestdata->icuvacantcumulative, 'LR', 0, 'R', 0);
        $pdf->Cell($w[3], 10, $statelatestdata->icucumulative, 'LR', 0, 'R', 0);
        $pdf->Ln();
        $pdf->Cell(array_sum($w), 0, '', 'T');


        ob_end_clean();
        $pdf->Output($postvalue[0].'report.pdf', 'D');
    }
}

?>