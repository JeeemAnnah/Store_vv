<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>

<?php

if($_POST){

    //print_r($_POST);

    $nombre = $_POST['nombre'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['descripcion'];

    $fecha = new DateTime(); //usamos para que si las imagenes tienen el mismo nombre se diferencien por la fecha


    $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];

    $imagen_temporal = $_FILES['archivo']['tmp_name'];

    move_uploaded_file( $imagen_temporal,"imagenes/".$imagen);

    $objConexion = new conexion();
    $sql = "INSERT INTO `productos` (`id`, `nombre`, `costo`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$costo','$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);

    //Para que al recargar la pagina no se duplique la información
    header("location:producto.php");

}

if($_GET){

    $id=$_GET['borrar'];
    $objConexion = new conexion();

    //borrado en del archivo
    $imagen = $objConexion->consultar("SELECT imagen FROM `productos` WHERE id=".$id);
    unlink("imagenes/".$imagen[0]['imagen']);
    
    //borrado de la base de datos
    $sql = "DELETE FROM `productos` WHERE `productos`.`id` =".$id;
    $objConexion->ejecutar($sql);

    header("location:productos.php");

}

$objConexion = new conexion();
$productos = $objConexion->consultar("SELECT * FROM `productos`");

//print_r($resultado);


?>



<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Datos del Producto
             </div>
                <div class="card-body">
                <form action="producto.php" method="post" enctype="multipart/form-data">
                    Nombre <input required class="form-control" type="text" name="nombre" id="">
                    Costo <input required class="form-control" type="text" name="costo" id="">
                <br/>
                    Imagen: <input required class="form-control" type="file" name="archivo" id="">   
                <br>
                    Descripción
                <textarea required class="form-control" name="descripcion" id="" rows="3"></textarea>
                <br/>

                <input class="btn btn-success" type="submit" value="Guardar Producto">
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
            <th>Costo</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($productos as $product){ //lee de uno en uno los datos?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['nombre']; ?></td>
            <td><?php echo $product['costo']; ?></td>
            
            <td>
                <img width="100" src="imagenes/<?php echo $product['imagen']; ?>" alt="">
            </td>
            <!--<td></?php// echo $proyecto['imagen']; ?></td>-->

            <td><?php echo $product['descripcion']; ?></td>
         
            <td><a class="btn btn-danger" href="?borrar=<?php echo $product['id'];?>">Eliminar</a></td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>


            
        </div>
        
    </div>
</div>





<?php include("pie.php"); ?>