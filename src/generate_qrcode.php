<?php
session_start();
require_once 'config.php';
require_once 'fpdf.php';


$value = $_POST['value'];
$id    = $_POST['id'];
$generate_id = $_SESSION['client_id'];


$pdf = new FPDF();
$pdf = new FPDF('P','mm','letter');
$pdf->AddPage();
$pdf->SetTitle('Noth Cotabato Appointment ID');

$pdf->Image('image/front_1.jpg',20,20,110);


$client_data = $conn->prepare("SELECT * FROM `client` INNER JOIN `appointments` ON client.client_email = appointments.appointment_email AND appointments.patient_doctor = ? INNER JOIN `qrcodes` ON qrcodes.qr_user_id = client.client_id WHERE client.client_id = ? AND status='Approved' LIMIT 1");
$client_data->bind_param("ss",$value,$generate_id);
$client_data->execute();
$result = $client_data->get_result();

while($row = $result->fetch_assoc()){
$pdf->Image('../'.$row['qr_image'].'',101,42,28,25,'png');


#fullname
$pdf->SetFont('Arial','',12);
$pdf->Cell(45);
$pdf->write(76,$row['appointment_fullname']);
$pdf->Ln(1);


#city
$pdf->SetFont('Arial','',7);
$pdf->Cell(20);
$pdf->write(89,'Owner Picture');
$pdf->Ln(3);
// $pdf->Image('../'.$row['client_image'].'',26,42,28,25,'jpeg');

#city
$pdf->SetFont('Arial','',10);
$pdf->Cell(58);
$pdf->write(100,$row['id_no']);
$pdf->Ln(3);

#phone
$pdf->SetFont('Arial','',10);
$pdf->Cell(61);
$pdf->write(110,$row['phone']);
$pdf->Ln(3);

#address
$pdf->SetFont('Arial','',10);
$pdf->Cell(61);
$pdf->write(114,$row['address']);
$pdf->Ln(3);


#staff
$pdf->SetFont('Arial','',9);
$pdf->Cell(92);
$pdf->write(123,$row['patient_doctor']);
$pdf->Ln(3);

$pdf->SetFont('Arial','b',9);
$pdf->Cell(101);
$pdf->write(123,"Staff");
$pdf->Ln(3);

$pdf->Output();

}





 ?>