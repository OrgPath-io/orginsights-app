<?php


require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

//echo "ok";

// reference the Dompdf namespace
use Dompdf\Dompdf;

$abcd = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orginsights PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body><div>
        <p>Copyrights 2021 Orginsights. All Rights Reserved</p>
    </div>
</body>
</html>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($abcd);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'orientation');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();



?>
