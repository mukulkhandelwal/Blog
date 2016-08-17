<?php
/*session_start();

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
</html>*/

//connect to database

include('../includes/db_connect.php');
//get record of database
$record_count=$db->query("SELECT * FROM posts");
//amount displayed
$per_page=2;
//number of pages
$pages=ceil($record_count->num_rows/$per_page);
if(isset($_GET['p']) && is_numeric($_GET['p']));
{
	$page=$_GET['p'];
}else{
	$page=1;
}
if($page<=0){
	$start=0;
}
else
{
	$start=$page*$per_page -$per_page;
}

$prev=$page-1;
$next=$page+1;
$query=$db->prepare("SELECT post_id,title,LEFT(body,100)AS body,category
 FROM posts INNER JOIN categories ON categories.category_id=posts.category_id 
 order by post_id desc limit $start $page");
$query->execute();

$query->bind_result($post_id,$title,$body,$category);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=9">

<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.in.js"></script>

	<title> Index file</title>
</head>
<style type="text/css">
	#container{
		margin: auto;
		width: 800px;

	}
</style>
<body>
<div id="container">
<?php
while($query->fetch());
	$lastspace=strpos($body,' ');
	?>
	<article>
	<h2><?php echo $title?></h2>
	<p><?php echo substr($body,0,$lastspace)."<a href='post.php?id=$post_id'>..</a>"?></p>
	<p>Category:<?php echo $category ?></p>
	</article>
<?php endwhile; ?>

<?php
if($prev>0){
	echo "<a href='index.php?p=$prev'>Prev</a>"
}
if($page<$pages)
{
	echo "<a href='index.php?p=$next'>Next</a>"
}
	
</div>
</body>
</html>