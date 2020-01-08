<?php
if(isset($_POST['submit'])){
	
	require("db/db.php");
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	
	if($password != $confirm){
		$message = "Password did not match !";
		header("location: index.php?message1=$message");
	}else{
		$check = mysqli_query($con, "SELECT * FROM login WHERE username='$username'");
		if(mysqli_num_rows($check)){
			$message = "Username already exist.";
			header("location: index.php?message1=$message");
		}else{
			mysqli_query($con, "INSERT INTO login(username,password) VALUES('$username', '$password')");
			
			$sqlgetid="SELECT id FROM login WHERE username='$username'";
			$query = $con->query($sqlgetid);

			$id="";
			while($row = $query->fetch_assoc()){
				$id = $row['id'];
			}

			mysqli_query($con, "INSERT INTO personalinfo(id,username,name,lastname,email,age,gender,city) VALUES('$id','$username','$name','$lastname','not set',0,'not set','not set')");
			
			$message = "You have successfully registered. Sign in now.";
			header("location: index.php?message1=$message");
		}
	}
}
?>