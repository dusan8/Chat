<?php 

require('../db/db.php');

session_start();

$userTable="SELECT * FROM users";

$con->query($userTable);


 ?>


 <html>
 <head><title>Control Panel</title></head>
<body>


 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

 
 <a href="../logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
 <a href="cpindex.php" id="l" style="color:white"><input type='button' value='back'/></a>
 <link href="../css/showUsers.css" rel="stylesheet" type="text/css">


</br><h2>Users</h2>

<div id="add" >
<h2><a href='addUser.php'><input type='button' value='add user'/></a></h2>
</div>



<div id="table">
  <table align="center" border='1px' name="table1" id="mytable" >

 <tr>
    <th align = "center">USERNAME</th>
    <th align = "center">PASSWORD</th>
    <th align = "center">NAME</th>
    <th align = "center">LASTNAME</th>
    <th align = "center">EMAIL</th>
    <th align = "center">AGE</th>
    <th align = "center">GENDER</th>
    <th align = "center">CITY</th>
    <th align = "center">ADMIN</th>
    <th align = "center">BANNED</th>
    <th align = "center">OPTIONS</th>

 </tr>

 <?php
        $sqls = "SELECT l.id,l.username,l.password,l.banned,l.admin,p.name,p.lastname,p.email,p.age,p.gender,p.city FROM login l ,personalinfo p WHERE l.id=p.id";
        $query = $con->query($sqls);
       
        $id=0;
        while($row = $query->fetch_assoc()){

            $id = $row['id'];

            echo "<tr><td>".$row['username']."</td><td>".$row['password']."</td><td>".$row['name']."</td><td>".$row['lastname']."</td><td>".$row['email']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['city']."</td><td>".$row['admin']."</td><td>".$row['banned']."</td><td><a href='exportUser.php?id=$id'><input type='button' value='Export'/>";

            echo "<a href='deleteUser.php?id=$id'><input type='button' value='Delete'/></a>";
            echo "<a href='BanUser.php?id=$id'><input type='button' value='Un/Ban'/></a>";
            echo "<a href='editUser.php?id=$id'><input type='button' value='Edit'/></a></td></tr>";
        }
?>

 
 
 
 </table>
 
</div>

<div id='export' style="text-align:center">
<a href='exportAllUsers.php'><input type="button" name ="exportall" value="export all"/></a>
</div>

 </form>
 </body>
 </html>