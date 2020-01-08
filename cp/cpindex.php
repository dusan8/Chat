<?php 

require('../db/db.php');
session_start();





 ?>


 <html>
 <head><title>Admin Control Panel</title></head>
 <a href="../logout.php" id="r" style="color:white"><input type='button' value='log out'/></a>
 <a href="../index.php" id="l" style="color:white"><input type='button' value='back'/></a>
	<br/>
	<br/>
	<br/>
 <link href="../css/cpindex.css" rel="stylesheet" type="text/css">





 <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

 

<div id="login">
<h2>Admin Control Panel</h2>
</div>
<div class="container">

  <a class="btn btn-stroke-black" href="showUsers.php">Users</a>
  <a class="btn btn-stroke-black" href="showChatLog.php">Chat Log</a>
  <a class="btn btn-stroke-black" href="showIpAdresses.php">IP addresses</a>
</div>

 </form>
 
 
 </div>
 
 
 </form>
 
 
 
 </html>