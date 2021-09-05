<?php
$msg="";
if (isset($_POST["btn"])) {
	$verif=true;
	if ($_POST["pwd"] == "" || $_POST["pwd2"]== "" || $_POST["email"]=="" ) {
		$msg="Debe completar todos los campos";
	}else{
		if ($_POST["pwd"] == $_POST["pwd2"]) {
		    $con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
		    $ssql= "SELECT * FROM `usuarios`";
		    $res = mysqli_query($con,$ssql);
		    if(mysqli_num_rows($res)>0){
			    while ($fila= mysqli_fetch_array($res, MYSQLI_ASSOC)) {
				    if ($fila["email"] == $_POST["email"]) {
					    $msg="El email ya esta registrado";
					    $verif=false;
				    }
			    }
			    if ($verif) {
			    	$pwd=$_POST["pwd"];
			    	$email=$_POST["email"];
			    	$con->query('INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL, "'.$email.'", "'.$pwd.'", CURRENT_TIMESTAMP)');
			    	$_SESSION["last_email"] = $_POST["email"];
			    	$_SESSION["last_pwd"] = $_POST["pwd"];
					$_SESSION["last_id"] = mysqli_fetch_array(mysqli_query($con, "SELECT `idUsuario` FROM `usuarios` WHERE `email`='".$_POST["email"]."'"), MYSQLI_ASSOC)["idUsuario"];
			    	header("Location: login.php");
			    	die();
			    }
		    }else{
			    header("Location: login.php");
			    die();
		    }
	    }else{
		    $msg="Las contraseñas no son iguales";
	    }
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>
<body>
	<h1><center>Registrarte es simple</center></h1>
	<center><form action="" method="POST">
		<input type="text" name="email" placeholder="Ingrese Email"><p>
		<input type="password" name="pwd" placeholder="Ingrese Contraseña"><p>
		<input type="password" name="pwd2" placeholder="Confirme Contraseña"><p>
		<input type="submit" name="btn" value="Registrarse"><p>

	</form>
	<?php echo $msg ?>
</center>
</body>
</html>