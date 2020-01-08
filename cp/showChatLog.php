<?php 

require('../db/db.php');
session_start();

$userTable="SELECT * FROM logs";

$con->query($userTable);




 ?>
 <html>
 <head><title>Control Panel</title>
  <link href="../css/showChatLog.css" rel="stylesheet" type="text/css">
 </head>
 <style>


 </style>

 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">


 <a href="../logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
 <a href="cpindex.php" id="l" style="color:white"><input type='button' value='back'/></a>






</br><h2>Messages</h2>
<div id="table2">
  <table align="center" border='1px' name="table2">

 <tr>
    <th align = "center">NAME</th>
    <th align = "center">MESSAGE</th>
    <th align = "center">OPTIONS</th>

 </tr>

 <?php
        $sqls = "SELECT * FROM logs";
        $query2 = $con->query($sqls);
       
      
        while($row = $query2->fetch_assoc()){

            $id = $row['id'];

            echo "<tr><td>".$row['username']."</td><td>".$row['msg']."</td><td><a href='exportMessage.php?id=$id'><input type='button' value='Export'/>";

            echo "<a href='deleteMessage.php?id=$id'><input type='button' value='Delete'/></a>";
            echo "</tr>";
        }
   
     ?>

 
 
 
 </table>
</div>

<div id='export' style="text-align:center">
<a href='exportAllmessages.php'><input type="button" name ="exportall" value="export all"/></a>
</div>


 </form>