<?php 

require('../db/db.php');

ob_start();
require 'showChatLog.php';
$data = ob_get_clean();

$id = $_GET['id'];


 $sqlexport="SELECT DISTINCT username,msg FROM logs WHERE id = '$id'";

   
    $exportQ=$con->query($sqlexport);

    $uname ="";
    $message = "";
    
    while($row = $exportQ->fetch_assoc()){

        $uname=$row['username'];
        $message = $row['msg'];
    }

    

    $data = array('username;msg',$uname.';'.$message);
    

    $fp = fopen('message.csv', 'w');

    foreach ( $data as $line ) {
        $val = explode(";", $line);
        fputcsv($fp, $val);
    }

    fclose($fp);

echo "<script>alert('Export Successful!');</script>";
header( "refresh:0;url=showChatLog.php" );


 ?>
  <html>
 <head>
 <link href="../css/exportMessage.css" rel="stylesheet" type="text/css">
 </head>
 </html>