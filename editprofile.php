<?php 

require 'db/db.php';

ob_start();
require 'index.php';
$data = ob_get_clean();


	$us = $_SESSION['username'];
	//echo $_SESSION['username'];

	$idsql = "SELECT id FROM login WHERE username='$us'";
	$queryid=$con->query($idsql);

	$id="";

	while($row = $queryid->fetch_assoc()){
		$id = $row['id'];
	}



  if(isset($_POST['save'])){

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
    
    //get username
    $sqlun="SELECT username FROM login where id='$id'";
    $query = $con->query($sqlun);
    $varusername="";
    while($row = $query->fetch_assoc()){
        $varusername = $row['username'];
    }

    //setImg($avatar);
    if (($_FILES['avatar']['tmp_name'])) {
        $name = $_FILES["avatar"]["name"];
        $srcExt = end(explode(".", $name));
        $allowedexts = array("jpeg", "JPEG", "jpg", "JPG", "gif", "GIF", "png", "PNG");
        $avatarok = true;
    }
    /*Sets the $error variable to the number of errors.*/
    $error = $_FILES['avatar']['error'];
     if (($_FILES['avatar']['tmp_name'])) {
        $avatarFullPath = '<img alt=Avatar src=avatars/' . $varusername . '_avatar />';
        $avatarThumbPath = '<img alt=Avatar src=avatars/' . $varusername . '_avatar width=45px height=45px />';
    } else {
        $avatarFullPath = '<img alt=Avatar src=avatars/generic.gif />';
        $avatarThumbPath = '<img alt=Avatar src=avatars/generic.gif width=45px height=45px />';
    }
    if ($avatarok == true) {
        /*Get the extension of the uploaded file*/
        $name = $_FILES["avatar"]["name"];
        $ext = end(explode(".", $name));
        /*Create full path from $varuserame*/
        $oldImagePath = "avatars/" . $varusername . "_avatar." . $ext;
        /*Move uploaded file to avatars directory*/
        move_uploaded_file($_FILES['avatar']['tmp_name'], $oldImagePath);
        /*Resize the image*/
        /*Get uploaded image height and width*/
        $srcSize = getimagesize($oldImagePath);
        /*Create source image based on file extension*/
        switch ($ext) {
            case "jpeg":
            case "jpg": $srcImage = imagecreatefromjpeg($oldImagePath); break;
            case "gif": $srcImage = imagecreatefromgif($oldImagePath); break;
            case "png": $srcImage = imagecreatefrompng($oldImagePath); break;
        }
        /*Create new image*/
        $destImage = imagecreatetruecolor(100, 100);
        /*Resample the image*/
        imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, 100, 100, $srcSize[0], $srcSize[1]);
        /*Create new path with .jpg extension*/
        $newImagePath = "avatars/" . $varusername . "_avatar.jpg";
        /*Save resized image*/
        imagejpeg($destImage, $newImagePath, 85);
        /*Remove images from memory*/
        imagedestroy($srcImage);
        imagedestroy($destImage);
        /*Delete the original file from the server as long as it has a 
         different name than the new one (since if it has the same name, the
         new one will have already overwritten it anyway and we don't want
         to delete the new file.  This also prevents the new file from being 
         deleted in the unlikely event that someone uploads an avatar in 
         the exact "username_avatar.jpg" format.)*/
        if ($oldImagePath != $newImagePath) {
            unlink($oldImagePath);
        }
      }
    header("location: index.php");


    
  }else if(isset($_POST['cancel'])){
   header("location: index.php");
  }

  function getEditInfo($s,$id){
	 require('db/db.php');
	  
	$sqlFeild1 = "SELECT DISTINCT $s FROM personalinfo WHERE id='$id'";
    
    $query = $con->query($sqlFeild1);

    $name="";
    while($row = $query->fetch_assoc()){
        $name = $row[''.$s.''];
    }
    echo "<td><p style='color:white;'>".strtoupper($s)."</p><input type='text' name='$s' value='$name' placeholder='Enter $s'/></td>";

	  
  }


 ?>

 <html>
 <head>
	
	<link href="css/editprofile.css" rel="stylesheet" type="text/css">
	
	<title>Edit Personal Info</title>
	
 </head>
 
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
 

<a href="logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
<a href="index.php" id="l" style="color:white"><input type='button' value='back'/></a>

</br><h2 style='color:white;' align='center'>Edit Profile Info</h2>
 
 <style>
 
 
 
 
 </style>
 <div style="text-align:center" id="edittable">
 
 <table align="center">
 <tr>
    
    <td><p style='color:white;'>AVATAR</p><input type="file" name="avatar" id="avatar"/></td>
 
 </tr>
 <tr>
 
 <?php 
	getEditInfo('name',$id);
  ?>
 </tr>
 <tr>
 
 <?php 
	getEditInfo('lastname',$id);
  ?>
 </tr>
 <tr>
 
 <?php 
	getEditInfo('email',$id);
  ?>
 </tr>
 <tr>
 
 <?php 
	getEditInfo('age',$id);

  ?>
 </tr>
  <tr>
  <?php 
	getEditInfo('gender',$id);
  ?>
 </tr>
 <tr>
  <?php 
	getEditInfo('city',$id);
  ?>
 </tr>
 <tr>
 <?php 
    
    $sqlFeild3 = "SELECT DISTINCT password FROM login WHERE id='$id'";
    
    $query = $con->query($sqlFeild3);

    $password="";
    while($row = $query->fetch_assoc()){
        $password = $row['password'];
    }
    echo "<td><p style='color:white;'>PASSWORD</p><input type='text' name='password' value='$password' placeholder='Enter New Password'/></td>";

  ?>
  </tr>
 <tr>
 <td align="center"><input type="submit" name ="save" value="Save"/><input type="submit" name ="cancel" value="Cancel"/></td>
 </tr>
 
 
 </table>

 </div>
 
</form>
 
 </html>