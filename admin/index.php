<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	# code...
	header('location: login.php');
	exit();
}

		include('../includes/db_connect.php');

//post count 
$post_count=$db->query('SELECT * FROM posts');

//comments count
$comment_count=$db->query('SELECT * FROM comments');

?>
 <!DOCTYPE html>
<html>
<head>
	<title> Index Page</title>

<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE-9"/>

<style type="text/css">
	
body{
}
	#container{
		padding: 10px;
		width: 1000px;
		margin:auto;
		background: white;
	}

	#menu{
		height: 40px;
		line-height: 40px;
	}

	#menu ul{

		margin: 0;
		padding: 0;
	}

	#menu ul li{
		display: inline;
		list-style: none;
		margin-right: 10px;
		font-size: 30px;
		margin: 0;
	}

#mainContent{

	clear:both;
	margin-top: 5px;
	font-size: 25px;
}
	#header{
		height: 80px;
		line-height: 80px;
	}
	#container #header h1{
		font-size: 45px;
		margin: 0;
	}



</style>
</head>
<body><div id="container">

<div id ="menu">
	<ul>
		<li> <a href="#">Home</a></li>
		<li><a href="#">Create New Post</a></li>
		
		<li> <a href="#">Delete Post</a></li>

		<li> <a href="logout.php">Log Out</a></li>
		<li> <a href="#">Blog Home Page</a></li>
	</ul>

</div>

<div id="mainContent">
	<table>
		<tr>
			<td>
				Total Blog Post
			</td>
			<td><?php echo $post_count->num_rows?>
			</td>
		</tr>
		
		<tr> 
		<td>Total Comments</td>
		<td><?php echo $comment_count->num_rows ?></td>

		</tr>
	</table>
</div>
</div>
</body>
</html>