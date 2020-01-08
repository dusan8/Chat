<?php 

 


require('../db/db.php');

ob_start();
require 'showUsers.php';
$data = ob_get_clean();

$id = $_GET['id'];


 $sqlban="SELECT DISTINCT banned FROM login WHERE id = '$id'";

   
    $banQ=$con->query($sqlban);

    $banned ="";
    
    while($row = $banQ->fetch_assoc()){

        $banned =$row['banned'];

    }

    if($banned>0){
        $sqlUpdate="UPDATE login SET banned=0 WHERE id='$id'";
        $con->query($sqlUpdate);
        echo "<script>alert('UnBan successful!');</script>";
        header( "refresh:0;url=showUsers.php" );
    }else{
        $sqlUpdate="UPDATE login SET banned=1 WHERE id='$id'";
        $con->query($sqlUpdate);
        echo "<script>alert('Ban successful!');</script>";
        header( "refresh:0;url=showUsers.php" );
    }

 ?>
 <html>
 <head>
 <link href="../css/banUser.css" rel="stylesheet" type="text/css">
 </head>
 </html>