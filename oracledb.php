<?php

$connect = oci_connect('system','Ilaya6044','loaclhost/XE');

if(!$connect){
	echo "Fucked";
}
else
{
	echo "Success";
}
?>