<?php 
session_start();
if (isset($_SESSION["last_id"]) && isset($_GET["dominio"])) {
	shell_exec("zip ".$_GET['dominio']." ".$_GET['dominio']);
	header("Location: ".$_GET['dominio'].".zip");
	die();
}else{
	header("Location: panel.php");
	die();
}
?>