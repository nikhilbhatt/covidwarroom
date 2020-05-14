<?php

class GeneratePdf extends Controller{
    public function __construct()
    {
        if(!isLoggedIn('statecontrolroom')&&!isLoggedIn('districtauthority')&&!isLoggedIn('districtuser'))
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
            if(empty($data['date']))
            {
                $data['date_err']='Field can\'t be empty';
            }
            if(date("yy-m-d",time())<$data['date']){
                $data['date_err']='Date Selected must be less than current date';
            }
            if(empty($data['date_err']))
            {
                $res=$this->generatePdf->getFilteredData($data);
                $data['res']=$res;
                $this->views('resources/generatepdf',$data);
            }
            else
            {
                $this->views('resources/generatepdf',$data);
            }
        }
        else
        {
            $res='';
            $data=[
                'res'=>$res,
                'date'=>'',
                'ppekits'=>'',
                'n95'=>'',
                'vtm'=>'',
                'ventilator'=>'',
                'patientbed'=>'',
                'quarantinebed'=>'',
                'icu'=>'',
                'date_err'=>''
            ];
            $this->views('resources/generatepdf',$data);
        }
    }

    public function generate()
    {
        $postvalue = unserialize(base64_decode($_POST['result']));
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

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
        <i>Table will be shown Here</i>
        
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        ob_end_clean();
        $pdf->Output('example_001.pdf', 'I');
    }
}

?>