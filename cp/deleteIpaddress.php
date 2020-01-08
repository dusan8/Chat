
<?php 

ob_start();
require 'showIpAdresses.php';
$data = ob_get_clean();

$id = $_GET['id'];

$sqlDelete = "DELETE FROM userip where id='$id'";
$con->query($sqlDelete);
header( "refresh:0;url=showIpAdresses.php" );

?>

 <html>
 <head><title>Delete Message</title>
 <link href="../css/deleteipaddresses.css" rel="stylesheet" type="text/css">
 
 
 </head>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
 <body>

<a href="../logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
<a href="javascript:history.back()" id="l" style="color:white"><input type='button' value='back'/></a>

 </br><h2 style='color:white;' align='center'>Ip address successfuly deleted!</h2>
 <div id="add">
 
 
 </body>
 
 </form>
 
 </html>