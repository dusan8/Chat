<?php 

require('../db/db.php');

ob_start();
require 'showIpAdresses.php';
$data = ob_get_clean();

$id = $_GET['id'];


 $sqlban="SELECT DISTINCT ipaddress FROM userip WHERE id = '$id'";

   
    $banQ=$con->query($sqlban);

    $ip ="";
    
    while($row = $banQ->fetch_assoc()){

        $ip =$row['ipaddress'];

    }

    $sqlUpdate="UPDATE userip SET banned=1 WHERE id='$id'";
    $con->query($sqlUpdate);

    

echo "<script>alert('Ban successful!');</script>";
header( "refresh:0;url=showIpAdresses.php" );


 ?>
 <html>
 <head>
 <link href="../css/banIpaddress.css" rel="stylesheet" type="text/css">
 </head>
 </html>