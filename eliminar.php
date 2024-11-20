<?php
$servername = "mattprofe.com.ar";
$username = "6929";
$password = "tigre.manzano.silla";
$dbname = "6929";
$port = 3306; 
$error = "";
$conn = new mysqli($servername, $username, $password, $dbname, $port);

$elim = $_GET['dominio'];

$sql = "DELETE FROM `webs` WHERE dominio = '$elim'";
$result = $conn->query($sql);
header('location:panel.php');


?>