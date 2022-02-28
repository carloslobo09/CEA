<?php
ob_start();
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css2/all.min.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Alumnos</title>

  </head>
<body class="fondo">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div id="fb-root"></div>
<div id="wrapper" class="">
    <!-- Sidebar -->
            <!-- Sidebar -->
            <nav class="navbar navbar-dark bg-dark" id="navbarSupportedContent">
        <div class="collapse navbar-collapse">
        <img style="position:absolute;left:43%;top:10%;" src="cea.jpg" width="120">
            <ul class="navbar-nav mr-auto">
            <p style="color:white;position:absolute;left:1050;top:20;font-size:20px"><strong>Bienvenido:</strong>Cristian CEA</p>
                    </ul>
        </div>
    </nav>
    <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
        <li class="sidebar-brand"><a id="menu-toggle" href="indexxx.php">Menu<i id="main_icon" class="fas fa-align-justify"></i></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
              <li><a  href="regalumn.php">Alumno<i class="sub_icon fas fa-address-book"></i></span></a></li>
              <li><a  href="regprof.php">Personal<i class="sub_icon far fa-address-book"></i></a></li>
            <li><a  href="regcurs.php">Cursos<i class="sub_icon fas fa-university"></i></a></li>
          <li><a href="regusu.php">Usuarios<i class="sub_icon fas fa-users"></i></a></li>
          <li><a href="listcuo.php">Cuotas<i class="sub_icon fas fa-money-check-alt"></i></a></li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
          <li><a class="btn-outline-success btn-exit-usu" href="cerrar_sesion.php">Salir<i class="sub_icon fas fa-door-open"></a></i></ul>
      </div>
      <div id="page-content-wrapper">
        <div class="page-content inset">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <?Php
                include "conexion.php";
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());

                
        $sql ="SELECT alumnos.*,cursos.* FROM alumnos INNER JOIN cursos on cursos.id_cur=alumnos.id_cur WHERE id_alum=".$_GET["id_alum"]; 
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    echo "<br><br><br><br><table class='table'><tr>
                    <td rowspan='3'><center><img src='".$row["foto"]."' alt='¡Sin foto!'></center></td>
                <td><center><strong>Nombre: </strong>" . $row["nombre"]."</center></td>
                <td><center><strong>Curso: </strong>" . $row["ncurso"]."</center></td></tr>
                <tr>
                <td><center><strong>DNI: </strong>". $row["dni"]."</center></td>
                <td><center><strong>Telefono/Celular: </strong>" . $row["celular"]."</center></td>
                </tr>
                <tr>
                <td><center><strong>Sexo: </strong>" . $row["sexo"]."</center></td>
                <td><center><strong>Fecha de nacimiento: </strong>" . $row["fdnac"]."</center></td>
                </tr>
                <tr>
                <td><center><strong>Direccion: </strong>" . $row["direccion"]."</center></td>
                <td><center><strong>Email: </strong>" . $row["email"]."</center></td>
                <td><center><strong>Red social(link): </strong><a href=".$row["redsoc"].">Link</a></center></td>
                </tr></table>";

                
            
                        }
                    }
            
        echo "</table>";
        $conn->close();
                 ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script>
  $("#main_icon").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
</script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="op1.js"></script>
<script src="op2.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/AjaxForms.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/source_lines.js"></script>
<script src="plugins/jtable/jquery-ui.js" type="text/javascript"></script>
<script src="plugins/jtable/jquery.jtable.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>