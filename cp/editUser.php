<?php 

require('../db/db.php');

ob_start();
require 'showUsers.php';
$data = ob_get_clean();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
//echo $id;

if(isset($_POST['submit'])){

  $id=$_POST['id'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $name=$_POST['name'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $age=$_POST['age'];
  $gender=$_POST['gender'];
  $city=$_POST['city'];
  $admin=$_POST['admin'];
  $banned=$_POST['banned'];
  
  $sqlUchk ="SELECT username FROM login where username='$username' and id<>'$id'";

  $ucheckquery=$con->query($sqlUchk);

  //$takenid=0;
  $utest="";
  while($row = $ucheckquery->fetch_assoc()){

    //$takenid = $row['id'];
    $utest = $row['username'];

  }
  //echo $utest;

  if(!empty($utest)){
    echo "<script>alert('Username is taken!');</script>";
    header( "refresh:0;url=editUser.php?id=$id");
    return false;
    //header("location: editUser.php?id=$id");
  }else{

    $sqlEdit="UPDATE personalinfo SET username='$username', name='$name',lastname='$lastname',email='$email',age='$age',gender='$gender',city='$city' where id=$id";

    $con->query($sqlEdit);

    $sqlEdit="UPDATE login SET username='$username' password='$password',banned='$banned',admin='$admin' where id=$id";
    
    $con->query($sqlEdit);
    
    echo "<script>alert('User successfuly edited!');</script>";
    header( "refresh:0;url=showUsers.php");
   // header("location: editUser.php?id=$id");
    return true;
  }


}else if(isset($_POST['cancel'])){
  header("location: showUsers.php");
}



 ?>

 <html>
 <head><title>Edit User</title></head>
 
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

<a href="../logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
<a href="showUsers.php" id="l" style="color:white"><input type='button' value='back'/></a>
<link href="../css/edituser.css" rel="stylesheet" type="text/css">

</br><h2 style='color:white;' align='center'>Edit</h2>
 
 <style>
 
 
 
 
 </style>
 <div style="text-align:center" id="edittable">
 
 <table align="center">
 <tr>
    <td>
      <?php
        echo "<input type='hidden' id='id' name='id' value='$id' >";
      ?>
    </td>
 </tr>
 <tr>
 
 <?php 
    
    $sqlFeild1 = "SELECT DISTINCT username FROM login WHERE id='$id'";
    
    $query = $con->query($sqlFeild1);

    $username="";
    while($row = $query->fetch_assoc()){
        $username = $row['username'];
    }
    echo "<td class='td'>Username:</td><td><input type='text' name='username' value='$username' placeholder='Enter Username'/>";

  ?>
 </tr>
 <tr>
 
 <?php 
    
    $sqlFeild1 = "SELECT DISTINCT password FROM login WHERE id='$id'";
    
    $query = $con->query($sqlFeild1);

    $password="";
    while($row = $query->fetch_assoc()){
        $password = $row['password'];
    }
    echo "<td class='td'>Password:</td><td><input type='text' name='password' value='$password' placeholder='Enter password'/></td>";

  ?>
 </tr>
 <tr>
 
 <?php 
    
    $sqlFeild1 = "SELECT DISTINCT name FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild1);

    $name="";
    while($row = $query->fetch_assoc()){
        $name = $row['name'];
    }
    echo "<td class='td'>Name:</td><td><input type='text' name='name' value='$name' placeholder='Enter Name'/></td>";

  ?>
 </tr>
 <tr>
 
 <?php 
    
    $sqlFeild1 = "SELECT DISTINCT lastname FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild1);

    $lastname="";
    while($row = $query->fetch_assoc()){
        $lastname = $row['lastname'];
    }
    echo "<td class='td'>LastName:</td><td><input type='text' name='lastname' value='$lastname' placeholder='Enter Lastname'/></td>";

  ?>
 </tr>
 <tr>
 
 <?php 
    
    $sqlFeild2 = "SELECT DISTINCT email FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild2);

    $email="";
    while($row = $query->fetch_assoc()){
        $email = $row['email'];
    }
    echo "<td class='td'>Email:</td><td><input type='text' name='email' value='$email' placeholder='Enter email address'/></td>";

  ?>
 </tr>
  <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT age FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $age="";
    while($row = $query->fetch_assoc()){
        $age = $row['age'];
    }
    echo "<td class='td'>Age:</td><td><input type='text' name='age' value='$age' placeholder='Enter age'/></td>";

  ?>
  </tr>
    <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT gender FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $gender="";
    while($row = $query->fetch_assoc()){
        $gender = $row['gender'];
    }
    echo "<td class='td'>Gender:</td><td><input type='text' name='gender' value='$gender' placeholder='Enter gender'/></td>";

  ?>
  </tr>
    <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT city FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $city="";
    while($row = $query->fetch_assoc()){
        $city = $row['city'];
    }
    echo "<td class='td'>City:</td><td><input type='text' name='city' value='$city' placeholder='Enter city'/></td>";

  ?>
  </tr>
      <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT admin FROM login WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $admin="";
    while($row = $query->fetch_assoc()){
        $admin = $row['admin'];
    }
    echo "<td class='td'>Make Admin:</td><td><input type='text' name='admin' value='$admin' placeholder='Enter 1 or 0'/></td>";

  ?>
  </tr>
        <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT banned FROM login WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $banned="";
    while($row = $query->fetch_assoc()){
        $banned = $row['banned'];
    }
    echo "<td class='td'>Ban:</td><td><input type='text' name='banned' value='$banned' placeholder='Enter 1 or 0'/></td>";

  ?>
  </tr>
  
 <tr>
 <td align="center"><input type="submit" name ="submit" value="Save"/></td><td><input type="submit" name ="cancel" value="Cancel"/></td>
 </tr>
 
 
 </table>

 </div>
 
</form>
 
 </html>