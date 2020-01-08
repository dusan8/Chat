<?php 

require('../db/db.php');

ob_start();
require 'showIpAdresses.php';
$data = ob_get_clean();

$id = $_GET['id'];


 $sqlexport="SELECT DISTINCT ipaddress,banned FROM userip WHERE id = '$id'";

   
    $exportQ=$con->query($sqlexport);

    $ip ="";
    $banned=0;
    while($row = $exportQ->fetch_assoc()){

        $ip =$row['ipaddress'];
        $banned=$row['banned'];

    }

    

    $data = array('ip;banned',$ip.';'.$banned);
    

    $fp = fopen('ipAddress.csv', 'w');

    foreach ( $data as $line ) {
        $val = explode(";", $line);
        fputcsv($fp, $val);
    }

    fclose($fp);

echo "<script>alert('Export Successful!');</script>";
header( "refresh:0;url=showIpAdresses.php" );


 ?>
 <html>
 <head>
 <link href="../css/exportAllips.css" rel="stylesheet" type="text/css">
 </head>
 </html>