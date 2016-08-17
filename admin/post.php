<?php
/*if('isset($_GET['id'])'){
header('Location:index.php');
}else{
	$id=$_GET['id'];
}
*/
include('includes/db_connect.php');

if('is_numeric($id)'){
	header('Location:index.php');
}
$sql="SELECT title,body FROM posts WHERE post_id='$id'";
$query=$db->$query($sql);

if ($query->num_rows !=1) {
	# code...
	header('Location:index.php');
	exit();
}

if (isset($_POST['submit'])) {
	$email=$_POST['email'];
	$name=$_POST['name'];
	$comment=$_POST['comment'];  

	if($email && $name && $comment){

		$email=$db->real_escape_string($email);

		$name=$db->real_escape_string($name);

		$id=$db->real_escape_string($id);
		$comment=$db->real_escape_string($comment);
	
		if ($addComment=$db->prepare(" INSERT INTO commentS(name,post_id,email_add,comment)
				VALUES (?,?,?,?,?)")) {
			$addComment->bind_param('ssss',$id,$name,$email,$comment);
				
				$addComment->execute(); 
				echo "Thank You Comment was added";
				$addComment->close();
		}else{
			echo " Error" ,$db->error;
		}
	}else{
		echo "Error";
	}
	# code...
}
?>


<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
<meta charset ="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9">

	<title> post</title>
</head>
<style type="text/css">
	
	#container{
		width: 800px;
		padding: 8px;
		margin: auto;
	}

	label{
		display: block;
	}
</style>
<body>

<div id="container">
	<div id="post">
	<?php
	$row=$query->fetch_object();
	echo "<h2> ".$row->title."</h2>";
	echo "<p>".$row->body ."</p>";
		?>
	</div>
	<hr />

	<div id="add-comments">
		<form  action ="<? php echo $_SERVER['PHP_SELF']."?id=$id" ?>"  method="post" >

				<div>
					<label> Email Address</label> <input type="text" name="email">
				</div>
			
					<div>
					<label> Name</label> <input type="text" name="name"/>
				</div>
					<div>
					<label> Comment</label> <textarea name="comment"></textarea>
				</div>
					<div>
					<input type="submit" name="submit" value="Submit">
				</div>
			</form>
	</div>
	<hr />
	<div id "Comments">
	<?php
$query=$db->query("SELECT * FROM comments WHERE post_id='$ID' ORDER BY comment_id DESC");

while ($eow=$query->fetch_object()) 
	# code...


	?>
	<div>
		<h5><?php echo $row->name ?></h5>
		<blockquote> <?php echo $row->comment ?></blockquote>
	</div>
		<endwhile; ?>
	</div>
</div>
</body>
</html>




