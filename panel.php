
<?php
$servername = "localhost";
$username = "adm_webgenerator";
$password = "webgenerator2024";
$dbname = "webgenerator";
$port = 3306; 
$error = "";
$conn = new mysqli($servername, $username, $password, $dbname, $port);

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
$id = $_SESSION['id'];
?>
<h1>Bienvenido a tu panel</h1>
<a href="logout.php">cerrar sesion de <?php echo $_SESSION['id']; ?></a>

<form method="POST" action="">
	<input type="text" name="web" placeholder="crear web" required>
	<input type="submit" name="subir">

</form>
<?php
if($_SESSION['user'] == "admin@server.com"){
	$sql8 = "SELECT dominio FROM webs";
	$result8 = $conn->query($sql8);
	$result8 = $result8->fetch_all(MYSQLI_ASSOC);
	foreach ($result8 as $key => $value) {
	$dominio = $value['dominio'];

	echo "<a href='webs/".$value['dominio']."'>".$value['dominio']."</a><br>";
}
	
}else{
	if (isset($_POST['subir'])) {
	
$conc = $_SESSION['id'].$_POST['web'];

	
	$sql2 = "SELECT dominio FROM webs WHERE dominio = '$conc'";
	$result2 = $conn->query($sql2);
	$result2 = $result2->fetch_all(MYSQLI_ASSOC);
	
	if(count($result2) == 0){
		$sql = "INSERT INTO `webs`(`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES (null,$id,'$conc',NOW())";
		$result = $conn->query($sql);
		shell_exec('./wix.sh '.$conc);


	}else{
		$error = "el dominio ya existe, elija otro";
	}
	
}

$sql3 = "SELECT dominio FROM webs";
	$result3 = $conn->query($sql3);
	$result3 = $result3->fetch_all(MYSQLI_ASSOC);

foreach ($result3 as $key => $value) {
	$dominio = $value['dominio'];

	 shell_exec("zip -r webs/$dominio/".$dominio.".zip "."webs/$dominio");
	echo "<a href='webs/".$value['dominio']."'>".$value['dominio']."</a>
	<a href='webs/".$value['dominio']."/".$value['dominio'].".zip'>Descargar</a>
	<a href='eliminar.php?dominio=".
	$value['dominio']."'>eliminar</a> <br>";
}
		
}


echo $error;
?>