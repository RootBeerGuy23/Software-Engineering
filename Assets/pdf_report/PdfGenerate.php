<?php
require '../../Auth/conn.php'; 
include_once('tcpdf_6_3_2/tcpdf/tcpdf.php');

$id = $_GET['id'];

$trans_query = "SELECT id, receiver, sender, datetime, waybill_number, sender_address, order_number FROM transactions WHERE id='".$id."'";             
$trans_results = mysqli_query($conn, $trans_query);   
$count = mysqli_num_rows($trans_results);  

if ($count > 0) {
    $trans_data_row = mysqli_fetch_array($trans_results, MYSQLI_ASSOC);

    // Create PDF
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 12);  
    $pdf->AddPage(); // Default A4

    // Add company logo
    $image_file = '../img/logo.png'; // Ubah ini sesuai dengan lokasi file logo perusahaan
    $pdf->Image($image_file, 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Generate header content
    $header = '
    <style type="text/css">
        .header-table {
            width: 100%;
        }
        .header-table td {
            vertical-align: top;
        }
        .header-left {
            width: 20%;
        }
        .header-center {
            width: 60%;
            text-align: center;
        }
        .header-right {
            width: 20%;
        }
        .detail-table {
            width: 100%;
            margin-top: 20px;
        }
        .detail-table td {
            vertical-align: top;
            padding: 5px;
        }
    </style>
    <table class="header-table">
        <tr>
            <td class="header-left">
            
            </td>
            <td class="header-center">
                <b>Store Sphere INC</b><br>
                <b>CONTACT: +62123 456 789</b><br>
                <b>WEBSITE: storesphere.000webhost.com</b><br><br>
            </td>
            <td class="header-right"></td>
        </tr>
    </table>
    <table class="detail-table">
        <tr>
            <td><b>Sender: '.$trans_data_row['sender'].'</b></td>
            <td align="right"><b>Date: '.$trans_data_row['datetime'].'</b></td>
        </tr>
        <tr>
            <td><b>Receiver: '.$trans_data_row['receiver'].'</b></td>
            <td align="right"><b>Waybill No.: '.$trans_data_row['waybill_number'].'</b></td>
        </tr>
    </table>
    <br><br>
    <h2 align="center">INVOICE</h2>
    ';

    $pdf->writeHTML($header);

    // Generate content
    $content = '
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            background-color: #f9f9f9;
        }
        .remarks {
            font-style: italic;
            font-size: 10px;
        }
    </style>
    <table>
        <tr>
            <th>No</th>
            <th>Item Name</th>
            <th align="right">Quantity</th>
            <th align="right">Price per pcs</th>
            <th align="right">Total Price</th>
        </tr>';

    $inv_det_query = "SELECT item_name, total_pcs, price, description FROM transaction_items WHERE transaction_id='".$id."'";
    $inv_det_results = mysqli_query($conn, $inv_det_query); 

    $total_quantity = 0;
    $grand_total_price = 0;
    $no = 1;

    while ($inv_det_data_row = mysqli_fetch_array($inv_det_results, MYSQLI_ASSOC)) {
        $item_price = floatval($inv_det_data_row['price']);
        $item_quantity = intval($inv_det_data_row['total_pcs']);
        $total_price = $item_price * $item_quantity;

        $total_quantity += $item_quantity;
        $grand_total_price += $total_price;

        $content .= '
        <tr>
            <td>'.$no.'</td>
            <td>
                <b>'.$inv_det_data_row['item_name'].'</b>
                <br>
                <span class="remarks">Description: '.$inv_det_data_row['description'].'</span>
            </td>
            <td align="right"><b>'.$item_quantity.'</b></td>
            <td align="right"><b>'.number_format($item_price, 2).'</b></td>
            <td align="right"><b>'.number_format($total_price, 2).'</b></td>
        </tr>';
        $no++;
    }

    $content .= '
        <tr class="total">
            <td colspan="2" align="right"><b>Grand Total Quantity:</b></td>
            <td align="right"><b>'.$total_quantity.'</b></td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="total">
            <td colspan="4" align="right"><b>Grand Total Price:</b></td>
            <td align="right"><b>'.number_format($grand_total_price, 2).'</b></td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>Payment Mode: Giro </b></td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" align="center"><b>This document is processed by computer and is legally binding without signature</b></td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
    </table>'; 
$pdf->writeHTML($content);

$file_location = "/pdf_report/"; //add your full path of your server
//$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

$datetime=date('dmY_hms');
$file_name = "INV_".$datetime.".pdf";
ob_end_clean();

if($_GET['ACTION']=='VIEW') 
{
    $pdf->Output($file_name, 'I'); // I means Inline view
} 
else if($_GET['ACTION']=='DOWNLOAD')
{
    $pdf->Output($file_name, 'D'); // D means download
}
else if($_GET['ACTION']=='UPLOAD')
{
    $pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
    echo "Upload successfully!!";
}

//----- End Code for generate pdf
    
}
else
{
    echo 'Record not found for PDF.';
}
?>
