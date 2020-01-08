<?php 

require'db/db.php';

ob_start();
require 'index.php';
$data = ob_get_clean();

    $id=$_GET['id'];
    //$us = $_SESSION['username'];
		//echo $_SESSION['username'];

	/*	$idsql = "SELECT id FROM login WHERE username='$us'";*/
    $idsql= "SELECT username FROM login WHERE id='$id'";
		$queryid=$con->query($idsql);

		$username="";

		while($row = $queryid->fetch_assoc()){
            $username = $row['username'];
		}

    //echo $username;


  /*if(isset($_POST['save'])){

    $name=$_POST['name'];
    $lastname= $_POST['lastname'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $city=$_POST['city'];
    $password=$_POST['password'];

    echo $id." ".$name." ".$lastname." ".$email." ".$age." ".$gender." ".$city." ".$password;

    $sqlup="UPDATE personalinfo SET name='$name',lastname='$lastname',email='$email',age='$age',gender='$gender',city='$city' where id='$id'";
    $con->query($sqlup);

    $sqluppw="UPDATE login SET password='$password'";
    $con->query($sqluppw);
    header("location: index.php");
    
  }else if(isset($_POST['cancel'])){
   header("location: index.php");
  }*/



 ?>

 <html>
 <head>
 <title>User Info</title>
 
 <link href="css/userpage.css" rel="stylesheet" type="text/css"/>
 </head>
 
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
 
<a href="logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
<a href="index.php" id="l" style="color:white"><input type='button' value='back'/></a>
</br><h2 style='color:white;' align='center'User Info</h2>

 <table align="center" id="userpagetable" class="userpagetable">
 <tr>

    <td>
<?php
			
		function getInfoUserPage($s,$id){
			require('db/db.php');
			
			$infosql = "SELECT DISTINCT ".$s." FROM personalinfo WHERE id='$id' ";
			$queryinfo=$con->query($infosql);
			$info="";
			while($row = $queryinfo->fetch_assoc()){
				$info = $row[''.$s.''];
			}
			echo "<td>".$s.": </td><td>$info</td>";	
		
		}
		
		
		$infosql = "SELECT username FROM personalinfo WHERE id='$id'";
			$queryinfo=$con->query($infosql);
			$info="";
			while($row = $queryinfo->fetch_assoc()){
	  
				$info ="avatars/".$row['username']."_avatar.jpg";
			}
			
		if (file_exists($info)) {
			$info=$info;
		} else {
			$info ="avatars/default.jpg";
		}

?>
		<img src="<?php echo $info; ?>" />
		</td>
 
 </tr>
 <tr>
 
 <?php 
	getInfoUserPage('name',$id);
  ?>
 </tr>
 <tr>
 
 <?php 
	getInfoUserPage('lastname',$id);
  ?>
 </tr>
 <tr>
 
 <?php 
	getInfoUserPage('email',$id);
  ?>
 </tr>
 <tr>
 
 <?php
 
   getInfoUserPage('age',$id);

  ?>
 </tr>
  <tr>
  <?php 
  
	getInfoUserPage('gender',$id);

  ?>
 </tr>
 <tr>
  <?php 
  
	getInfoUserPage('city',$id);

  ?>
 </tr>
 
 </table>
 
</form>
 
 </html>