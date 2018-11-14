<?php

include("db_connect.php");
session_start();

$query = 'INSERT INTO login_details login_dt_tm = now() where login_id ="'$_SESSION['login_id'].'"';
$statement =$connect->prepare($query);
$statement->execute();


?>