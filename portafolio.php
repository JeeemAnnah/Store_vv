<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>

<?php

if($_POST){

    //print_r($_POST);

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $fecha = new DateTime(); //usamos para que si las imagenes tienen el mismo nombre se diferencien por la fecha


    $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];

    $imagen_temporal = $_FILES['archivo']['tmp_name'];

    move_uploaded_file( $imagen_temporal,"imagenes/".$imagen);

    $objConexion = new conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);

    //Para que al recargar la pagina no se duplique la información
    header("location:portafolio.php");

}

if($_GET){

    $id=$_GET['borrar'];
    $objConexion = new conexion();

    //borrado en del archivo
    $imagen = $objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$id);
    unlink("imagenes/".$imagen[0]['imagen']);
    
    //borrado de la base de datos
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id;
    $objConexion->ejecutar($sql);

    header("location:portafolio.php");

}

$objConexion = new conexion();
$proyectos = $objConexion->consultar("SELECT * FROM `proyectos`");

//print_r($resultado);


?>



<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Datos del cliente
             </div>
                <div class="card-body">
                <form action="portafolio.php" method="post" enctype="multipart/form-data">
                    Nombre: <input required class="form-control" type="text" name="nombre" id="">
                    Apellido: <input required class="form-control" type="text" name="descripcion" id="">
                <br/>
                    Imagen: <input required class="form-control" type="file" name="archivo" id="">   
                <br>

                <input class="btn btn-success" type="submit" value="Guardar Cliente">
            </form>
        </div>
</div>
        </div>


        <div class="col-md-4">
        <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($proyectos as $proyecto){ //lee de uno en uno los datos?>
        <tr>
            <td><?php echo $proyecto['id']; ?></td>
            <td><?php echo $proyecto['nombre']; ?></td>
            <td><?php echo $proyecto['descripcion']; ?></td>
            <td>
                <img width="100" src="imagenes/<?php echo $proyecto['imagen']; ?>" alt="">
            </td>
            <!--<td></?php// echo $proyecto['imagen']; ?></td>-->


            
            <td><a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'];?>">Eliminar</a></td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>


            
        </div>
        
    </div>
</div>





<?php include("pie.php"); ?>