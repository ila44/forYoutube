<?php

$connect = new PDO("mysql:host=localhost;port=1521;sid=xe;dbname=chatsite","system","");

function fetch_user_last_activity($user_id,$connect){
	$query = 'Select * from login_details where user_id="'.$user_id.'"order by login_dt_tm desc LIMIT 1';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row) {
	return $row['login_dt_tm'];
}

}

?>