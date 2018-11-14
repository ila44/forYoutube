<?php

include("db_connect.php");
session_start();

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
		<br><h3 align="center">Let's chat with you buddies</h3><br>
		<div class="table-responsive">
			<h4 align="center"> Please click to chat with below users</h4>
		<p align="right"> Hi <?php echo $_SESSION['curusrname']; ?> - <a href="logout.php">Logout</a> </p>
		<div id="user_details"></div>
		<div id="chat_box"></div>
	</div>
</div>
</body>

</html>

<script >

$(document).ready(function() {

fetch_user();

setInterval(function() {
	last_update();
	fetch_user();
},5000);

function fetch_user() {
	$.ajax({
		url:"fetch_user.php",
		method:"POST",
		success:function(data){
			$("#user_details").html(data);
		}
	})
}

function last_update(uid,uname){

	$.ajax({
		url:"last_update.php",
		success:function(){

		}
	})
}

function make_chat_db(to_user_id,to_user_name){

	var cont ='';
	cont += '<div id="chat_dialog_'+to_user_id +'"class="user_dialog" title="You have chat with '+to_user_name+'">';
	cont += '<div class="chat_history" style="height:400px;border:1px solid #ccc; overflow-y:scroll; margin-bottom:24px; padding:16px;" id = "chat_history_'+to_user_id+'" data-touserid="'+to_user_id+'">';
	cont += '</div><div class="form-group">';
	cont += '<textarea class="form-control" name="message_'+to_user_id+'" id="message_'+to_user_id+'"></textarea>';
	cont += '</div>';
	cont += '<div class="form-group" align="right">';
	cont += '<button type="button" id="'+to_user_id+'" name="send_chat" class="btn btn-info">Send</button></div></div>';
	

	$('#chat_box').html(cont);
}


$(document).on('click','.start_chat',function() {

	var to_user_id =$(this).data('touserid');
	var to_user_name=$(this).data('tousername');

	make_chat_db(to_user_id,to_user_name);

	$("#chat_dialog_"+to_user_id).dialog({
		autoOpen:false,
		width:400
	});

	$("#chat_dialog_"+to_user_id).dialog('open');


});





});
	
</script>