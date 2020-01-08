<?php 

require('../db/db.php');
session_start();

$idSQL="SELECT id FROM login ORDER BY id DESC LIMIT 1";

$queryy=$con->query($idSQL);

$id=0;
 while($row = $queryy->fetch_assoc()){
  $id= $row['id'];
  $id++;
}



if(isset($_POST['submit'])){

  $username=$_POST['username'];
  $password=$_POST['password'];
  $name=$_POST['name'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $age=$_POST['age'];
  $gender=$_POST['gender'];
  $city=$_POST['city'];
  //$admin=$_POST['admin'];
  //$banned=$_POST['banned'];
  
  $sqlUchk ="SELECT username FROM login where username='$username' and id<'$id'";

  $ucheckquery=$con->query($sqlUchk);

  //$takenid=0;
  $utest="";
  while($row = $ucheckquery->fetch_assoc()){

   // $takenid = $row['id'];
    $utest = $row['username'];

  }

  if(!empty($utest)){
    echo "<script>alert('Username is taken!');</script>";
    //echo "aaaaaaaaaaaaa";
    header( "refresh:0;url=addUser.php");
    //header("location: addUser.php");
    return false;
  }else{
  
    $sqlAdd="INSERT INTO login VALUES ($id,'$username','$password',0,0)";
    $con->query($sqlAdd);
    $sqlAdd="INSERT INTO personalinfo VALUES ($id,'$username','$name','$lastname','$email','$age','$gender','$city')";
    $con->query($sqlAdd);
    echo "<script>alert('Username successfuly added!');</script>";
    header("refresh:0;url=showUsers.php");
    return true;
    //echo "bbbbb";
  }

}




?>
<html>
 <head>
 <title>Control Panel</title>
 <link href="../css/addUser.css" rel="stylesheet" type="text/css">
 </head>


 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

 
 <a href="logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
 <a href="showUsers.php" id="l" style="color:white"><input type='button' value='back'/></a>
 
 <div id="add">

	 <h2>Add</h2>
	 <input type="text" id="username" name ="username" placeholder="Enter Username"/> 
	 <input type="text" id="password" name="password" placeholder="Enter password"/>
	 <input type="text" id="name" name="name" placeholder="Enter Name"/>
	 <input type="text" id="lastname" name="lastname" placeholder="Enter Lastname"/>
	 <input type="text" id="email" name="email" placeholder="Enter Email address"/>
	 <input type="text" id="age" name="age" placeholder="Enter Age"/>
	 <input type="text" id="gender" name="gender" placeholder="Enter Gender"/>
	 <input type="text" id="city" name="city" placeholder="Enter City"/>
	 <input type="submit" id="submit" name="submit" value="ADD" />

 </div>


 </form>
 </html>




