<?php 


require('../db/db.php');

$sqlexport="SELECT l.id,p.username,l.password,l.banned,l.admin,p.name,p.lastname,p.email,p.age,p.gender,p.city FROM login l, personalinfo p WHERE l.id=p.id";

$result=$con->query($sqlexport);

if (!$result) die('Couldn\'t fetch records');
$headers = $result->fetch_fields();
foreach($headers as $header) {
    $head[] = $header->name;
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="allUsers.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, array_values($head)); 
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}




 ?>
 <html>
 <head>
 <link href="../css/exportAllusers.css" rel="stylesheet" type="text/css">
 </head>
 </html>