<?php
session_start();
?>

<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "paradise";
$tbl_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['nombre'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username'";

$result = $conexion->query($sql);


if ($result->num_rows === 1) {
 $row = $result->fetch_array(MYSQLI_ASSOC); 
 
 if (password_verify($password, $row['password'])) { 
 
 $_SESSION['loggedin'] = true;
 $_SESSION['username'] = $username;
 $_SESSION['start'] = time();
 $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

if($_SESSION['username'] == "admin"){
    header('Location:http://localhost/paradise/panelcontrol.php');
}else{
    header('Location:http://localhost/paradise/index.html');
}

 } else { 
 echo "Username o Password estan incorrectos.";

 echo "<br><a href='login.html'>Volver a Intentarlo</a>";
 }
}
mysqli_close($conexion) 
?>