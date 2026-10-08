<?php

require($_SERVER['DOCUMENT_ROOT'].'/orginsightapp/assets/fpdf/fpdf.php');

include('html2pdf.php');

//FILENAME AND PATH

$invfilepath=$_SERVER["DOCUMENT_ROOT"]."/orginsightapp/assets/reports/";
$invfile_fullpath=$invfilepath.$invfilename;
//END FILENAME AND PATH

$abcd="";
//include("pdfstyles.php");

if((int)$_POST["id"]==2)
{
$abcd.=$_POST["pdfreport2"];
$invfilename="pdfreport2.pdf";
}
else
{
$abcd.=$_POST["pdfreport"];
$invfilename="pdfreport.pdf";
}
$file=$_SERVER['DOCUMENT_ROOT']."/orginsightapp/asset/report_images/banner-img.jpg";

//echo $abcd;
//die();

	$pdf=new PDF_HTML();
    $pdf->SetFont('Arial','',12);
    $pdf->AddPage();
	$pdf->Image($file, 15, 0, 170);
    $pdf->WriteHTML($abcd);
    $pdf->Output($invfilename,'D');
    exit;
 

?>
