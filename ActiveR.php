<?php
include("connection.php"); 

if(isset($_REQUEST["i"]) && (int)$_REQUEST["i"] > 0)
{
	$con->query("Update users set is_active=".(int)$_REQUEST["a"]." where user_id=".(int)$_REQUEST["i"]);
}
?>