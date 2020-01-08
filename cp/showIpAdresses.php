<?php 

require('../db/db.php');
session_start();

$useripTable="SELECT * FROM userip";

$con->query($useripTable);

$sqlduplicate="DELETE n1 FROM userip n1, userip n2 WHERE n1.id < n2.id AND n1.ipaddress = n2.ipaddress and n1.banned=n2.banned ";
$con->query($sqlduplicate);

 ?>
 <html>
 <head><title>Control Panel</title></head>

 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

 
 <a href="logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
 <a href="cpindex.php" id="l" style="color:white"><input type='button' value='back'/></a>
 <link href="../css/showIpAdresses.css" rel="stylesheet" type="text/css">

</br><h2>Ip addresses</h2>
<div id="table4">
<table align="center" border='1px' name="table2" id="mytable2">

 <tr>
    <th align = "center">IP ADDRESS</th>
    <th align = "center">BANNED</th>
    <th align = "center">OPTIONS</th>

 </tr>

 <?php
        $sqls = "SELECT * FROM userip";
        $query2 = $con->query($sqls);
       
      
        while($row = $query2->fetch_assoc()){

            $id = $row['id'];

            echo "<tr><td>".$row['ipaddress']."</td><td>".$row['banned']."</td><td><a href='exportIpAddress.php?id=$id'><input type='button' value='Export'/>";

            echo "<a href='deleteIpaddress.php?id=$id'><input type='button' value='Delete'/><a href='banIpaddress.php?id=$id'><input type='button' value='Ban'/><a href='UnbanIpaddress.php?id=$id'><input type='button' value='UnBan'/></a>";
            echo "</tr>";
        }
   
     ?>

 
 
 
 </table>
</div>
<div id='export' style="text-align:center">
<a href='exportAllIpAddresses.php'><input type="button" name ="exportall" value="export all"/></a>
</div>


 </form>