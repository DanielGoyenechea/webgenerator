<?php
$servername = "mattprofe.com.ar";
$username = "6929";
$password = "tigre.manzano.silla";
$dbname = "6929";
$port = 3306; 

$error = "";
$conn = new mysqli($servername, $username, $password, $dbname, $port);
session_start();


if(isset($_SESSION['user'])){
	header('location:panel.php');
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 



if(isset($_POST['subir'])){
	
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT idUsuario,email,password FROM usuarios WHERE email = '$mail'";
	$result = $conn->query($sql);
	$result = $result->fetch_all(MYSQLI_ASSOC);
	if(count($result) == 0){
		$error = "email no registrado";

	}else
	if ($password == $result[0]['password']) {
		$_SESSION['id'] = $result[0]['idUsuario'];
		$_SESSION['user'] = $mail;
		header('location:panel.php');
		
	}else{
		$error = "las contraseñas no coinciden";
	}

	
	
	
}
echo $error;
?>


<h1>web generator goyenechea daniel</h1>
<form method="POST" action="">
	<input type="mail" name="email" placeholder="email" required>
	<input type="text" name="password" placeholder="contraseña" required>
	<input type="submit" name="subir" >
</form>
<a href="register.php">No tienes cuenta?</a>