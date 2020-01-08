<?php 

require'db/db.php';

function getUserIP(){
	
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    else if(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}



function checkUser($username){
    //echo $username;
    require'db/db.php';
    $CheckUsername="SELECT banned FROM login where username='$username'";
    $query=$con->query($CheckUsername);

    $banned="";
    while($row = $query->fetch_assoc()){
        $banned=$row['banned'];
    }
    return $banned;
}

?>


