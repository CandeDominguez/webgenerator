<?php 
$msg ="";
$name="";
session_start();
if (!isset($_SESSION["last_id"]) || !isset($_SESSION["last_email"])) {
	header("Location: login.php");
}
 if (isset($_POST["btn"])) {
 	$verif=true;
 	if ($_POST["name"] == "") {
 		$msg="Completar los campos";
 	}else{
 		$name= $_SESSION["last_id"].$_POST["name"];
 		$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
		$ssql= "SELECT * FROM `webs`";
		$res = mysqli_query($con,$ssql);
		if(mysqli_num_rows($res)>0){
			while ($fila= mysqli_fetch_array($res, MYSQLI_ASSOC)) {
				if ($fila["dominio"] == $name) {
					    $msg="El dominio ya esta registrado";
					    $verif=false;
				    }
			}
		}
		if ($verif) {
				$con->query('INSERT INTO `webs` (`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES (NULL, "'.$_SESSION["last_id"].'", "'.$name.'", CURRENT_TIMESTAMP)');
				shell_exec('./wix.sh '.$name.' '.$name);
				$msg="Se creo el sitio web con éxito";
			}
 	}
 }
 	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1><center>Bienvenido a tu Panel</h1>
	<center><a href="logout.php">Cerrar sesión de <?php echo $_SESSION["last_id"]; ?></a>
		<h1><center>Generar web de:</h1><p>
			<form method="POST" action="">
				<input type="text" name="name" placeholder="Nombre de la nueva web"><p>
				<input type="submit" name="btn" value="Crear web">
			</form>
			<?php echo $msg ;
			$con = mysqli_connect("mattprofe.com.ar", "3678", "3678", "3678");
			if ($_SESSION["last_email"] == "admin@server.com" && $_SESSION["last_pwd"] == "serveradmin") {
				$res = mysqli_query($con,"SELECT * FROM `webs`");
			}else{
				$res= mysqli_query($con,"SELECT * FROM `webs` WHERE `idUsuario` ='".$_SESSION["last_id"]."'");
			}
			if (mysqli_num_rows($res)>0) {
				echo ("<h4>Sus páginas web: </h4>");
				while ($fila= mysqli_fetch_array($res)) {
					echo ("<a href='".$fila["dominio"]."/index.php'>".$fila['dominio']."</a> ---> <a href='descarga.php?dominio=".$fila['dominio']."'> Descargar web</a> || <a href='eliminar.php?dominio=".$fila['dominio']."'>Eliminar</a><p>");
				}

			}else{
				echo "No tiene sitios web";
			}
			?>
</body>
</html>