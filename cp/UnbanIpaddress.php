<?php 

require('../db/db.php');

ob_start();
require 'showIpAdresses.php';
$data = ob_get_clean();

$id = $_GET['id'];

 $sqlban="SELECT DISTINCT ipaddress FROM userip WHERE id = '$id' and banned>0";

   
    $banQ=$con->query($sqlban);

    $ip ="";
    
    while($row = $banQ->fetch_assoc()){

        $ip =$row['ipaddress'];

    }

    if(empty($ip)){
        echo "<script>alert('ip is not banned!')</script>";
        header( "refresh:0;url=showIpAdresses.php" );

    }else{


    $sqlUpdate="UPDATE userip SET banned=0 WHERE id='$id'";
    $con->query($sqlUpdate);

    

    echo "<script>alert('UnBan Succesful!');</script>";
    header( "refresh:0;url=showIpAdresses.php" );
    }



 ?>
  <html>
 <head>
 <link href="../css/unbanIpaddress.css" rel="stylesheet" type="text/css">
 </head>
 </html>


