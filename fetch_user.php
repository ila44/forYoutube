<?php

include("db_connect.php");
session_start();

$query ='select * from users where user_id !="'.$_SESSION["curusrid"].'"';

$statement=$connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$content ='';
$content .= '<table class="table table-bordered table-striped">';
$content .= '<tr><th>Username</th>';
$content .= '<th>Status</th>';
$content .= '<th>Action</th></tr>';

foreach($result as $row){
	$status='';
	$timestamp = strtotime(date('Y-m-d H:i:s').'-10 second');
	$timestamp = date('Y-m-d H:i:s',$timestamp);
	$user_last_active =fetch_user_last_activity($row['user_id'],$connect);
	
	if($user_last_active > $timestamp){
		$status ="<span class='label label-success'>Online</span>";
	}
	else {
		$status ="<span class='label label-danger'>Offline</span>";
	}
	
	$content .= '<tr><td>'.$row['uname'].'</td>';
	$content .= '<td>'.$status.'</td>';
	$content .= '<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" 
				data-tousername="'.$row['uname'].'">Start Chat</button></td></tr>';
}

$content .='</table>';
echo $content;

?>