<?php
// Declaración de variables 
$servername = "172.19.0.3";
$username = "root";
$password = "1234";
$database = "negocio";

// Creo la conexion
$conn = new mysqli($servername, $username, $password, $database);

// Valido la conexion
if ($conn->connect_error) {
  die("Error en la conexion en la base de datos: " . $conn->connect_error);
}
?> 