<?php
// DB CREDENCIALES DE USUARIO.
$username = "root";
$password = "";
$database = "supermk";
// Ahora, establecemos la conexión.
try
{
// Ejecutamos las variables y aplicamos UTF8
$connect = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
$connect->query("set names utf8;");
$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);//
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// permite manejar los errores y a la vez esconder datos que podrían ayudar a alguien a atacar tu aplicación.
$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch (Exception $e)
{
echo "Error: Algo va mal con la Base de datos " . $e->getMessage();
}
?>