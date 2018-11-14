<?php

include("db_connect.php");
$err_msg ='';
session_start();

if(isset($_POST['submit']))
{
	$query = "select * from users where uname =:uname";
	$statement = $connect->prepare($query);
	$statement->execute(array(
			':uname' =>$_POST["uname"]
		)
	);
	$count = $statement->rowCount();
	if($count>0) 
	{
		$result=$statement->fetchAll();
		foreach($result as $row){
			if($row['upwd'] == $_POST['upwd']){
				$_SESSION['curusrid'] = $row['user_id'];
				$_SESSION['curusrname'] = $row['uname'];

				$sub_query = 'INSERT INTO login_details(userid,uname)  values("'.$_SESSION['curusrid'].'","'.$_SESSION['curusrname'].'")';
				$statement = $connect->prepare($sub_query);
				$statement->execute();

				$_SESSION['login_id'] = $connect->lastInsertId();
				header('location:index.php');
			}
			else{
				$err_msg = "<label>Wrong Password</label>";
			}
		}
	}
	else
	{
		$err_msg = "<label>Wrong Username</label>";
	}
}


?>



<!DOCTYPE html>

<html>

<head>
<title>Chatting Website</title>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
	<div class="container">
		<br><br><h3 align="center">Chatsite Welcomes you</h3>
		<div class="panel panel-default">
		<div class="panel-heading center">Use your credentials</div>
		<p class="text-danger"> &nbsp;<?php  echo $err_msg; ?></p>
		<div class="panel-body">
		<form method="POST">
			
			<div class="form-group">
				<label name='username'>Enter Username</label>
				<input type='text' id='uname' name='uname' class='form-control' required />
			</div>
			<div class="form-group">
				<label name='pass' >Enter Password</label>
				<input type="password" name="upwd" class="form-control" required/>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Login" class="btn btn-info"/>
			</div>
		</form>
	</div>
	</div>
	</div>

</body>

</html>