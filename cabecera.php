<?php
session_start();
//print_r($_SESSION);  // sirve para seguridad

if( isset($_SESSION['usuario']) != "develoteca"){ //si se quita se van los bloqueos de administrador
    header("location::login.php");
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tikets</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <ul class="nav justify-content-center">
    <li class="nav-item">
    <a class="nav-link active" href="index.php">Inicio</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="portafolio.php">Clientes</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="producto.php">Productos</a>
    </li>
    </ul>
    
    
    
    </br>
    

   