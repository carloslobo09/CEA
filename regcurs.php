<?php
ob_start();
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css2/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Cursos</title>
</head>

<body class="fondo">
<?Php
        include "cursos.php";
        if(isset($_GET["id_cur"])){
            $id_cur=$_GET["id_cur"];
            $cur = new cursos("","","","","");
            $cur->getbyId($id_cur);
            $id_prof=$cur->getid_prof(); 
            $ncurso= $cur->getnombre();
            $duracion= $cur->getduracion(); 
            $pinscrip= $cur->getpinscrip();
            $precio= $cur->getprecio();
        }
        else{
            $id_prof= "";
            $ncurso=""; 
            $duracion="";
            $pinscrip= "";
            $precio="";
            $id_cur=0;
        }
        if(isset($_POST["id_prof"]) &&
           isset($_POST["ncurso"]) &&
           isset($_POST["duracion"]) &&
           isset($_POST["pinscrip"]) &&
           isset($_POST["precio"]) &&
           isset($_POST["id_cur"])){
            $id_cur = $_POST["id_cur"]; 
            $ncurso = $_POST["ncurso"];
            $id_prof = $_POST["id_prof"];
            $duracion = $_POST["duracion"];
            $pinscrip = $_POST["pinscrip"];
            $precio = $_POST["precio"];
            $objeto = new cursos($id_prof,$ncurso,$duracion,$pinscrip,$precio);
            $objeto->conectar();
            $objeto->creartb();
            if($id_cur==0){
                echo $objeto->guardar();
                header("Location:http://localhost:8080/CEA/regcurs.php");
                ob_end_flush();
                exit;
            }
            else{
                echo $objeto->modificar($id_cur); 
                header("Location:http://localhost:8080/CEA/regcurs.php");
            } 
        }
    ?>
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
           <li class="sidebar-brand"><a id="menu-toggle" href="indexx.html">Menu<i id="main_icon" class="fas fa-align-justify"></i></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
              <li><a  href="regalumn.php">Alumno<i class="sub_icon fas fa-address-book"></i></span></a></li>
              <li><a  href="regprof.php">Personal<i class="sub_icon far fa-address-book"></i></a></li>
            <li><a  href="regcurs.php">Cursos<i class="sub_icon fas fa-university"></i></a></li>
          <li><a href="regusu.php">Usuarios<i class="sub_icon fas fa-users"></i></a></li>
          <li><a href="listcuo.php">Cuotas<i class="sub_icon fas fa-money-check-alt"></i></a></li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
          <li><a class="btn-outline-success" href="cerrar_sesion.php">Salir<i class="sub_icon fas fa-door-open"></a></i>
        </ul>
      </div>
      <div id="page-content-wrapper">
        <div class="page-content inset">    
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <h4 class="letrabl" align="center">Registro</h4>
                <form method="POST" action="regcurs.php" name="tuformulario2">
                    <div class="form-group">
                        <?php
                    $con = new conexion();
                    $conn = new mysqli($con->getservername(),
                     $con->getusername(),
                      $con->getpassword(),
                       $con->getdbname());
                       $sql = "SELECT id_prof,nombre,dni FROM profesores";
                       $result = $conn->query($sql);
                       echo "<select class='form-control'  name='id_prof'>";
                       echo "<option selected hidden>Selecciona un profe</option>";
                       if ($result->num_rows> 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=".$row["id_prof"].">".$row["nombre"]." - ".$row["dni"]."</option>";
                    }
                    echo "</select>";
                    $conn->close();  
                }     
                    ?><br>
                            <input type="text" class="form-control" name="ncurso" aria-describedby="emailHelp" placeholder="Nombre del curso" value="<?PHP echo $ncurso?>">
                            <br>
                            <select class="form-control" name="duracion">
                            <option selected hidden>Duracion del curso</option>
                            <option value="1">1 Mes</option>
                            <option value="2">2 Meses</option>
                            <option value="3">3 Meses</option>
                            <option value="4">4 Meses</option>
                            <option value="5">5 Meses</option>
                            <option value="6">6 Meses</option>
                            </select><br>
                            <input type="text" class="form-control" name="pinscrip" aria-describedby="emailHelp" placeholder="Precio de Inscripcion($)" value="<?PHP echo $pinscrip?>">
                            <br>
                            <input type="text" class="form-control" name="precio" aria-describedby="emailHelp" placeholder="Precio MENSUAL($)" value="<?PHP echo $precio?>">
                        <input type="hidden" class="form-control" name="id_cur" aria-describedby="emailHelp" value="<?PHP echo $id_cur?>"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-guardar-curs" >Guardar</button>
                    <a href="recurs.php" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
            <div class="col-10">
                <h4 class="letrabl" align="center">Lista de cursos</h4>
                <div class="busqueda">
                <input class="form-control" id="myInput" type="text" placeholder="Ingrese los valores a buscar" style="width:300px;height:30px">

                </div>
                <?Php
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());
                
        $sql = "SELECT id_cur,cursos.id_prof,profesores.nombre,ncurso,duracion,pinscrip,precio,(duracion*precio)+pinscrip as Total FROM cursos INNER JOIN profesores ON profesores.id_prof=cursos.id_prof";
        $result = $conn->query($sql);
        
        echo "<table  class='table table-bordered formreg'>
        <thead class='thead-dark'><tr>
        <th scope='col'><center>Profe</center></th>
        <th scope='col'><center>Nombre Curso</center></th>
        <th scope='col'><center>Duracion(Meses)</center></th>
        <th scope='col'><center>Precio Incripcion</center></th>
        <th scope='col'><center>Precio Cuota</center></th>
        <th scope='col'><center>Total</center></th>
        <th scope='col'><center>Acciones</center></th>
        </tr></thead>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tbody id='myTable'><tr>
                <td><center>" . $row["ncurso"]."</center></td>
                <td><center>" . $row["nombre"]."</center></td>
                <td><center>". $row["duracion"]."</center></td>
                <td><center>$" . $row["pinscrip"]."</center></td>
                <td><center>$" . $row["precio"]."</center></td>
                <td><center>" . $row["Total"]."</center></td>
                <td><center><a  href='regcurs.php?id_cur=".$row["id_cur"]."'><i class='fas fa-user-edit'></i></a>
                <a class='btn-exit-curs' href='eliminar.php?id_cur=".$row["id_cur"]."'><i class='fas fa-user-times'></i></td>
                </tr></tbody>";
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
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
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v4.0"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>