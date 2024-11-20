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
	$password2 = $_POST['password2'];
	$sql2 = "SELECT email,password FROM usuarios WHERE email = '$mail'";
	$result2 = $conn->query($sql2);
	$result2 = $result2->fetch_all(MYSQLI_ASSOC);
	

	if(count($result2) == 0){
		if($password == $password2){
		$sql = "INSERT INTO `usuarios`(`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (null,'$mail','$password',NOW())";
		$result = $conn->query($sql);
			header('location:login.php');
		

		}else{
			$error = "las contraseñas no coinciden";
		}

		

	}else{
		$error = "este email ya esta registrado";
	}

}
echo $error;
?>

<h1>Registrarse es simple</h1>
<form method="POST">
	<input type="mail" name="email" placeholder="email">
	<input type="text" name="password" placeholder="contraseña">
		<input type="text" name="password2" placeholder="confirmar contraseña">
	<input type="submit" name="subir" >
</form>