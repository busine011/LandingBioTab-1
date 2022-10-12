<?php
//--------------------------------------Conexion base de datos-------------------------------------//
$servidor = "mysql:dbname=alienfb;host=localhost:3306"; 
$usuario = "alienfb"; 
$pass = '1jkl256b8x809**C';
try{$pdo = new PDO($servidor, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));}
catch(PDOException $e){ echo "No se púede conectar" . $e->getMessage();}
?>
