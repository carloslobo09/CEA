
<?php
require "conexion.php";

$where = "";

if (!empty($_POST))
 {
    $valor = $_POST['campo'];
     if (!empty($valor))
     {
    $where = "WHERE nombre LIKE '%$valor%'";
     }

}

$sql = "SELECT * FROM personas $where";
$resultado = $mysqli->query($sql);
?>

<html lang="es">
 <head>
 <title>Curso PHP y Mysql</title>
<meta name="viewport" content="widht=device-width, initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/jquery.dataTables.min.css" rel="stylesheet">	


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function(){
		$('#mitabla').DataTable({
		});
	});
</script>

</head>
<body>
<div class="container">
<div class="">
 <h2 style="text-align:center">Lista de Clientes</h1>
</div>

<div class="row">

 <a href="nuevo.php" class="btn btn-primary">Nuevo Registro</a>
</div>
</br>
<div class="row">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<b>Nombre: </b><input type="text" id="campo" name="campo" />
<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
</form>

</div>
<br>

<div class = "row table-responsive">
  <table class="table" id="mitabla">
      <thead class="thead-dark">
          <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Telefono</th>
</tr>
</thead>
<tbody>
    <?php
    while ($row = $resultado->fetch_array())
    { ?>
    <tr>
        <td> <?php echo $row['id']; ?> </td>
        <td> <?php echo $row['nombre']; ?> </td>
        <td> <?php echo $row['correo']; ?> </td>
        <td> <?php echo $row['telefono']; ?> </td>
        <td><a class="btn btn-warning" href="modificar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil">Modificar</span></a></td>
        <!-- <td><a href="#" data-href="eliminar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash">Eliminar</span></a></td>
         -->
         <td>
        <a class="btn btn-danger" href="eliminar.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro que deseas eliminar el registro?');"><span class="glyphicon glyphicon-trash">Eliminar</span></a>
        </td>

    </tr>
    <?php } ?>
 </tbody>
 </table>
</div>
</div>
    </body>
</html>