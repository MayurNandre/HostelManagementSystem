<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

/* Getting data from registartion */
$id = $_GET['id'];
$ret = "SELECT * FROM `registration` where id=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i',$id);
$stmt->execute(); //ok
$res = $stmt->get_result();
$row = $res->fetch_object();
/* Getting data from registartion End */

/* Assigning value to the variable for print on INVOICE */
$name = $row->firstName.$row->lastName;
$room_no = $row->roomno;
$duration = $row->duration." Months";
$stay_from = $row->stayfrom;
$food_status= $row->foodstatus;
if($food_status==0){
    $food_fee=0;
}else{
    $food_fee=3000;
}
$duration_num = $row->duration;
$hostel_feepm= $row->feespm;
$hostel_room_fee= $hostel_feepm * $duration_num;
$food_fee=3000*$duration_num;
$total_fee = $hostel_room_fee + $food_fee;
/* Assigning value to the variable for print on INVOICE  End */

/* ---------------------Invoice creating with help of fpdf ---------------------*/
require('../fpdf/fpdf.php');

class Invoice extends FPDF
{
    function Header()
    {
        // Title
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'Student Fee Invoice', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Student information and Fees
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 0, 'N.M.V BOYS HOSTEL', 0, 0, 'C');
        // Footer text
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 1, 'C');
    }

    function StudentInvoice($name, $room_number, $duration, $date,$room_fee, $meal_fee , $total_fee)
    {
        // Calculate center position
        $centerX = ($this->GetPageWidth() - 130) / 2;

        // Student information and Fees
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Detail', 0, 1, 'C');

        // Table Header
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 10, 'Description', 1, 0, 'C');
        $this->Cell(95, 10, 'Details', 1, 1, 'C');

        // Table Rows
        $this->SetFont('Arial', '', 12);
        $this->Cell(95, 10, 'Student Name', 1, 0);
        $this->Cell(95, 10, $name, 1, 1);

        $this->Cell(95, 10, 'Room Number', 1, 0);
        $this->Cell(95, 10, $room_number, 1, 1);

        $this->Cell(95, 10, 'Duration of Stay', 1, 0);
        $this->Cell(95, 10, $duration, 1, 1);

        $this->Cell(95, 10, 'Staying From', 1, 0);
        $this->Cell(95, 10, $date, 1, 1);

        $this->Cell(95, 10, 'Hostel Room Fee', 1, 0);
        $this->Cell(95, 10, 'Rs. ' .$room_fee, 1, 1);

        $this->Cell(95, 10, 'Meal Fee', 1, 0);
        $this->Cell(95, 10, 'Rs. ' . $meal_fee, 1, 1);

        $this->Cell(95, 10, 'Total Fee', 1, 0);
        $this->Cell(95, 10, 'Rs. ' . $total_fee, 1, 1);

        $this->Ln(10);
    }
}

// Create PDF
$pdf = new Invoice();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A5');

// Student information and Fees
$pdf->StudentInvoice($name,$room_no,$duration,$stay_from,$hostel_room_fee,$food_fee,$total_fee);

$pdf->Output();
?>