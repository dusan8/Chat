<?php 

require('../db/db.php');

ob_start();
require 'showUsers.php';
$data = ob_get_clean();

$id = $_GET['id'];


 $sqlexport="SELECT DISTINCT p.username,l.password,l.banned,l.admin,p.name,p.lastname,p.email,p.age,p.gender,p.city FROM login l ,personalinfo p WHERE l.id = '$id'";

   
    $exportQ=$con->query($sqlexport);
    
    $username ="";
    $password ="";
    $banned ="";
    $admin ="";
    $name ="";
    $lastname ="";
    $email ="";
    $age ="";
    $gender ="";
    $city ="";
    
    while($row = $exportQ->fetch_assoc()){
        $username =$row['username'];
        $password =$row['password'];
        $banned =$row['banned'];
        $admin =$row['admin'];
        $name =$row['name'];
        $lastname =$row['lastname'];
        $email =$row['email'];
        $age =$row['age'];
        $gender =$row['gender'];
        $city =$row['city'];

    }

    

    $data = array('username;password;banned;admin;name;lastname;email;age;gender;city',$username.';'.$password.';'.$banned.';'.$admin.';'.$name.';'.$lastname.';'.$email.';'.$age.';'.$gender.';'.$city);
    

    $fp = fopen('user.csv', 'w');

    foreach ( $data as $line ) {
        $val = explode(";", $line);
        fputcsv($fp, $val);
    }

    fclose($fp);

echo "<script>alert('Export Successful!');</script>";
header( "refresh:0;url=showUsers.php" );


 ?>
 <html>
 <head>
 <link href="../css/exportUser.css" rel="stylesheet" type="text/css">
 </head>
 </html>