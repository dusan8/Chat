<?php
require('db/db.php');

include ('bansystem.php');

$user_ip = getUserIP();

$sqlip = "INSERT INTO userip (ipaddress) values ('$user_ip');";
$queryy=$con->query($sqlip);

$sqlban="SELECT DISTINCT ipaddress FROM userip WHERE banned='1' LIMIT 1";
$queryban=$con->query($sqlban);

$banned="";
$ip="";
while($row = $queryban->fetch_assoc()){
$banned= $row['banned'];
 $ip=$row['ipaddress'];
}




if ($banned=1 && $user_ip==$ip)
{
 session_destroy();
 header("location: banned.php");
}

?>
<html>
<head>
	<script>
		function search(String s){
			if(s!=null){
				document.getElementById('srchresult').value=
			}
		}
		function submitMe(event) {
			if (window.event.keyCode == 13)
			{	
				submitchat();
				document.getElementById("msgbox").value= "";
				//nastavi ovo
			}
		}
	</script>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/index.css" rel="stylesheet" type="text/css">
	
<title>Mini Chat</title>
<div id="container">
	<div class="header">
		<a href="index.php"><h1 style="color:rgb(140, 198, 202);font-family:sans-serif" >MINI CHAT</h1></a>
	</div>
    
	<div class="main">
		<?php
            session_start();
			$username=isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
			
			$usernameBanned=checkUser($username);

			if($usernameBanned>0){
					session_destroy();
					header("location: banned.php");
					return false;
			}

                if(!isset($_SESSION['username'])){
					
        ?>
	<form name="form2" method="post" action="login.php">
		<?php 
            if(isset($_GET['message'])){ 
                $message=$_GET['message'];
                echo "<h3 style='color:rgb(140, 198, 202)'>$message</h3>";
            }
        ?>
    <h3>
    <table >
    <tr>
        <td><input class="input2" type="text" name="username" placeholder="Username" ></td>
        <td><input class="input2" type="password" name="password" placeholder="Password"></td>
        <td><input class="input2" type="submit" name="submit" value="Login"></td>
    </tr>
    </table>
    </h3>
 
	</form>
    <h2 style="color:rgb(140, 198, 202);font-family:sans-serif">Sign Up Here...</h2>
    <h4>
    	<form method="post" action="register.php" style="height:700px" >
        <input type="text" name="username" placeholder="Username" class = "input"></br>
		<input type="text" name="name" placeholder="Name" class = "input"></br>
		<input type="text" name="lastname" placeholder="Lastname" class = "input"></br>
        <input type="password" name="password" placeholder="Password" class = "input"></br>
        <input type="password" name="confirm" placeholder="Confirm Password" class = "input" ></br>
        <input type="submit" name="submit" class = "input" value="Submit">
        </form>
    </h4>
    <?php 
            if(isset($_GET['message1'])){ 
                $message=$_GET['message1'];
                echo "<h5>$message</h5>";
            }
        exit;
        }
                if(isset($_GET['username'])){
                $_GET['username'];
                }
    ?>

	<script src="./jq/jquery.min.js"></script>
	<script>

	function submitchat(){
		if(form1.msg.value == ''){ //exit if one of the field is blank
			alert('Enter your message !');
			return;
		}
		var msg = form1.msg.value;
		var xmlhttp = new XMLHttpRequest(); //http request instance
		
		xmlhttp.onreadystatechange = function(){ //display the content of insert.php once successfully loaded
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById('chatlogs').innerHTML = xmlhttp.responseText; //the chatlogs from the db will be displayed inside the div section
			}
		}
		xmlhttp.open('GET', 'insert.php?msg='+msg, true); //open and send http request
		xmlhttp.send();
		document.getElementById("msgbox").value = "";
	}
	$(document).ready(function(e) {
			$.ajaxSetup({cache:false});
			setInterval(function() {$('#chatlogs').load('logs.php');}, 2000);
		});
		
	</script>
</head>
<body>
<h3><a href="logout.php">Logout</a></h3>
<h2 style="color:rgb(140, 198, 202)">Hello, <?php echo $_SESSION['username']; ?></h2>
<?php
	$adminu=$_SESSION['username'];
	//echo $adminu;
	$admin = "SELECT admin FROM login WHERE username='$adminu'";
    
    $query = $con->query($admin);

    $cp=0;
    while($row = $query->fetch_assoc()){
        $cp = $row['admin'];
    }
	if($cp>0){
		echo "<h2 align='right'><a href='cp/cpindex.php'>Go to control panel</a></h2>";
	}

?>
	<div id="chatlogs"> 
    	LOADING CHATLOG, PLEASE WAIT...
    </div>
<form name="form1">
	</br> <textarea id="msgbox" onKeyPress="submitMe(event)" maxlength="255" name="msg" placeholder="Your message here..." 
	style="width:590px; height:100px;background-color:rgba(91, 228, 251, 0.27);color:white;overflow:scroll;resize: none;"></textarea>
	<a href="#"  onClick="submitchat()" class="button">Send</a></br></br>
</form>
    </div>
</div>


 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
 
<div id="profileinfo">
	<?php

		$tempus = $_SESSION['username'];
		//echo $_SESSION['username'];
		$idsql = "SELECT id FROM login WHERE username='$tempus'";
		$queryid=$con->query($idsql);
		$id="";
		while($row = $queryid->fetch_assoc()){
            $id = $row['id'];
		}
	
		echo "<a id='editprofile' href='editprofile.php?id=$id' ><input type='button' value='Edit profile info' class='input5'/></a>";
		
		function getInfo($s,$tempuss){
			require('db/db.php');
			$infosql = "SELECT ".$s." FROM personalinfo WHERE username='$tempuss' ";
				$queryinfo=$con->query($infosql);
				$info="";
				while($row = $queryinfo->fetch_assoc()){
					$info = $row[''.$s.''];
				}
				echo "<td class='tdp2'>$info</td>";	
			
		}
	?>



	<table id="uinfo">
		<tr>
			<td class="tdp">Avatar:</td>

			<td>
			<?php
			$infosql = "SELECT username FROM personalinfo WHERE username='$tempus' ";
				$queryinfo=$con->query($infosql);
				$info="";
				while($row = $queryinfo->fetch_assoc()){
					$info ="avatars/".$row['username']."_avatar.jpg";
				}
				
			?>
				<img src="<?php echo $info; ?>" />
			</td>
		
		</tr>
		<tr><td class="tdp">Username:</td>
			<?php
				getInfo('username',$tempus);
			?>
		</tr>
		<tr><td class="tdp">Name:</td>
		
		<?php
				getInfo('name',$tempus);
			?>
		</tr>
		<tr><td class="tdp">Lastname:</td>
		<?php
				getInfo('lastname',$tempus);
			?>
		</tr>
		<tr><td class="tdp">E-mail:</td>
		<?php
				getInfo('email',$tempus);
			?>
		</tr>
		<tr><td class="tdp">Age:</td>
		<?php
				getInfo('age',$tempus);
			?>
		</tr>
		<tr><td class="tdp">Gender:</td>
		<?php
				getInfo('gender',$tempus);
			?>
		</tr>
		<tr><td class="tdp">City:</td>
		<?php
				getInfo('city',$tempus);
			?>
		</tr>

	</table>
	
	

</div>
	<?php
	echo "<div id='search'>";
	
	
	echo "<table id='t1'>";
	
	echo "<tr>";
		echo "<td><input type=text id='searchbox' name='searchbox' placeholder='SEARCH MEMBER BY USERNAME' class='input3'/></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td><input type='submit' id='searchbtn' name='searchbtn' placeholder='SEARCH' value='SEARCH' class='input3'/></td>";
	echo "</tr>";
	if(isset($_POST['searchbtn'])){

		$srchusername = $_POST['searchbox'];
		if(empty($srchusername)){
			echo "<tr>";
			echo "<td class='input6'>0 results found.</td>";
			echo "</tr>";
		}else{
			$srchsql = "SELECT username FROM login WHERE username LIKE '%$srchusername%'";
			$querysrch=$con->query($srchsql);

			$noOfResults=0;
			while($row = $querysrch->fetch_assoc()){
				if(!empty($row['username'])){
					$noOfResults++;
				}
			}
			echo "<tr>";
			echo "<td class='input6'>$noOfResults results found.</td>";
			echo "</tr>";

			$srchsql = "SELECT username , id FROM login WHERE username LIKE '%$srchusername%'";
			$querysrch=$con->query($srchsql);

			$sresult="";
			$sid=0;
			while($row = $querysrch->fetch_assoc()){
				$sresult = $row['username'];
				$sid=$row['id'];
				echo "<tr>";
				echo "<td class='input6'><a id='searchtabl' name='searchtable' href='userpage.php?id=$sid' >$sresult</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		} 
	}
	?>
	
	
</form>


</body>
</html>