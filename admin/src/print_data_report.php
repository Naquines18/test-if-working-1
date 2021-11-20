<?php
require "fpdf/fpdf.php";
require "../../src/config.php";



if (isset($_POST['report'])) {
    $pdf = new FPDF();
    $pdf->SetFont('Arial','',12);
    $pdf->AddPage();
    $pdf->SetTitle('New Israel Makilala North Cotabato Reservation Report Data');
    $pdf->Image('fpdf/logo/download.jpg',10,6,30);
    $pdf->Image('fpdf/logo/municipality.jpg',170,6,30);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(39);
    $pdf->write(15,'New Israel Makilala North Cotabato Reservation System');
    $pdf->Ln(4);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(68);
    $pdf->write(17,'Municipality of Makilala');
    $pdf->Ln(4);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(63);
    $pdf->write(19,'Reservation Data Report '. date('Y'));
    $pdf->Ln(38);


    $pdf->SetFont('Arial','',12);
    $pdf->Cell(1);
    $pdf->write(1,'Staff Fullname: ________________________');
    // $pdf->Ln(10);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(47);
    $pdf->write(1,'Date Report: ' .date('M d Y'));
    $pdf->Ln(10);

    
    $pdf->SetFillColor(255,255,255);

    $cell = array(45,45,55,45);
    $pdf->Cell($cell[0],10,'ID NO.',1,0,'C', true);
    $pdf->Cell($cell[1],10,'FULLNAME',1,0,'C', true);
    $pdf->Cell($cell[2],10,'ADDRESS',1,0,'C', true);
    $pdf->Cell($cell[3],10,'DATE ARRIVED',1,1,'C', true);


    $reservation = $conn->prepare("SELECT * FROM `log_qr`");
    $reservation->execute();
    $result = $reservation->get_result();

    while($row = $result->fetch_assoc()){
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($cell[0],10,$row['id_no'],1,0,'C', false);
        $pdf->Cell($cell[1],10,$row['fullname'],1,0,'C', false);
        $pdf->Cell($cell[2],10,$row['address'],1,0,'C', false);
        $pdf->Cell($cell[3],10,$row['time_in'],1,1,'C', false);
    }

    $reservation->close();
    $conn->close();
    $pdf->Output();


}

