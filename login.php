<?php
$msg="";
session_start();
if(isset($_POST["button"])){
	if ($_POST["email"]=="" || $_POST["pwd"]=="") {
		$msg="Debe completar todos los campos";
	}else{
		$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
		$ssql= "SELECT * FROM `usuarios`";
		$res = mysqli_query($con,$ssql);
		if(mysqli_num_rows($res)>0){
			while($fila= mysqli_fetch_array($res, MYSQLI_ASSOC)){
				if ($_POST["email"] == $fila["email"] && $_POST["pwd"]== $fila["password"]) {
					$_SESSION["last_email"] = $_POST["email"];
					$_SESSION["last_pwd"] = $_POST["pwd"];
					$_SESSION["last_id"] = mysqli_fetch_array(mysqli_query($con, "SELECT `idUsuario` FROM `usuarios` WHERE `email`='".$_POST["email"]."'"), MYSQLI_ASSOC)["idUsuario"];
					echo $_SESSION["last_id"];
					header("Location: panel.php");
					die();
				}else{
					$msg="El usuario o la contraseña son incorrectos";
				}
			}

		}else{
					$msg="No existen usuarios";
				}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
</head>
<body>
	<h1><center>webgenerator Candela Agustina Dominguez</center></h1>
	<center><form action="" method="POST">
		<input type="text" name="email" placeholder="Ingrese Email"><p>
		<input type="password" name="pwd" placeholder="Ingrese Contraseña"><p>
		<a href="register.php">Registrarse</a><p>
		<input type="submit" name="button" value="Ingresar"><br>
		<?php echo $msg ?>
	</form>
	</center>
</body>
</html>