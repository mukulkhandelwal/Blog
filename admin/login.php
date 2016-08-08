<?php 
if(isset($_POST['submit'])){

	$user=$_POST['username'];
	$pwrd=$_POST['pwrd'];

	include('../includes/db_connect.php');

	if(empty($user||empty($pwrd))){
		echo'Missing Information';
	}
	else
	{
		$user=strip_tags($user);
		$user=$db->real_escape_string($user);
		$pwrd=strip_tags($pwrd);
		$pwrd=md5($pwrd);
		$pwrd=$db->real_escape_string($pwrd);
	
	$query=$db->query("SELECT user_id,username FROM user WHERE username='$user' 
						AND password='$pwrd'");
	echo $query->num_rows;

	}
}

 ?>

<!Doctype <!DOCTYPE html>
<html>
<head>
<meta charset-"utf-8"/>

<meta http-equiv="K-UA-Compatible" content="IE-9"/>
	<script type="text/javascript" scr="http://code.jquery.com/jquery-1.5.min.js"></script>
	<title> 1st page</title>
</head>
<body>
<div id="container">
	
<form action="login.php" method="post">
	<p>
		<label>
			Username
		</label><input type="text" name="username"/>

	</p>
	<p>
		<label>
			Password
		</label>
		<input type="password" name="pwrd">
	</p>

	<input type="submit" name="submit" value="logIn" >

</form>

</div>
</body>
</html>