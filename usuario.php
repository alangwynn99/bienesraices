<?php 

//importar conexion 
require 'includes/app.php';
$db = conectarDB();

//crear email y password
$email = "correo@correo.com";
$password = "123";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

echo $query;

exit;

//agregarlo a la base de datos
mysqli_query($db, $query);