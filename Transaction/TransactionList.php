<?php
include_once("../Auth/conn.php");
session_start();


if (!isset($_SESSION['NIK'])) {

    header("location: ../Auth/MainCheck");
    exit;
}


?>


<!doctype html>
<html lang="en">
<head>
<title>Store Spehere INC</title>
<link rel="icon" href="../Assets/img/logo.png">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="../Assets/css/transactionlist.css">
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12" align="center"> 
            <br>
            <h5 align="center">Transaction List</h5>
            <br>
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Transaction ID</th>
                <th>Receiver</th>
                <th>Sender</th>
                <th>Datetime</th>
                <th>Waybill Number</th>
                <th>Order Number</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php                
            $display_query = "SELECT id, receiver, sender, datetime, waybill_number, order_number FROM transactions";             
            $results = mysqli_query($conn, $display_query);   
            $count = mysqli_num_rows($results);            
            if($count > 0) 
            {
                while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
                {
                    ?>
                 <tr>
                    <td><?php echo $data_row['id']; ?></td>
                    <td><?php echo $data_row['receiver']; ?></td>
                    <td><?php echo $data_row['sender']; ?></td>
                    <td><?php echo $data_row['datetime']; ?></td>
                    <td><?php echo $data_row['waybill_number']; ?></td>
                    <td><?php echo $data_row['order_number']; ?></td>
                    <td>
                        <a href="../Assets/pdf_report/PdfGenerate.php?id=<?php echo $data_row['id']; ?>&ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a> &nbsp;&nbsp; 
                        <a href="../Assets/pdf_report/PdfGenerate.php?id=<?php echo $data_row['id']; ?>&ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
                        &nbsp;&nbsp; 
                        <a href="../Assets/pdf_report/PdfGenerate.php?id=<?php echo $data_row['id']; ?>&ACTION=UPLOAD" class="btn btn-warning"><i class="fa fa-upload"></i> Upload PDF</a>
                    </td>
                 </tr>
                 <?php
                }
            }
            ?>
            </tbody>
            </table>
            <a href="../Transaction/Transaction"><button type="submit">Back to services</button></a>
        </div>
    </div>
</div>
<br>
</body>
</html> 
