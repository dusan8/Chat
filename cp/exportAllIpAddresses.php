<?php 


require('../db/db.php');

$sqlexport="SELECT ipaddress,banned FROM userip";

$result=$con->query($sqlexport);

if (!$result) die('Couldn\'t fetch records');
$headers = $result->fetch_fields();
foreach($headers as $header) {
    $head[] = $header->name;
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="allIpAddresses.csv"');
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
 <link href="../css/exportAllIp.css" rel="stylesheet" type="text/css">
 </head>
 </html>