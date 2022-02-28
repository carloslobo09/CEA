<?php
ob_start();
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css2/all.min.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Profesores</title>
</head>
<body>
<?Php
        include "profesores.php";
        if(isset($_GET["id_prof"])){
            $id_prof=$_GET["id_prof"];
            $prof = new profesores("","","","","","","","","","");
            $prof->getbyId($id_prof);
            $nombre = $prof->getnombre();
            $dni= $prof->getdni(); 
            $celular = $prof->getcelular();
            $direccion = $prof->getdireccion(); 
            $sexo= $prof->getsexo();
            $fdnac = $prof->getfdnac();
            $foto = $prof->getfoto();
            $email = $prof->getemail();
            $redsoc = $prof->getredsoc(); 
            $especialidad = $prof->getespecialidad();
        }
        else{
            $nombre = ""; 
            $dni= "";
            $celular = "";
            $direccion = ""; 
            $sexo= "";
            $fdnac = "";
            $foto = "";
            $email = "";
            $redsoc = "";   
            $especialidad= "";
            $id_prof=0;
        }
        if(isset($_POST["nombre"]) &&
        isset($_POST["dni"]) && 
        isset($_POST["celular"]) &&
        isset($_POST["direccion"]) &&  
        isset($_POST["sexo"]) && 
        isset($_POST["fdnac"]) &&
        isset($_POST["foto"]) &&
        isset($_POST["email"]) &&
        isset($_POST["redsoc"]) &&
        isset($_POST["especialidad"]) && 
        isset($_POST["id_prof"]) ){
            $id_prof = $_POST["id_prof"];
            $nombre = $_POST["nombre"];
            $dni = $_POST["dni"];
            $celular = $_POST["celular"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fdnac = $_POST["fdnac"];
            $foto = $_POST["foto"];
            $email = $_POST["email"];
            $redsoc = $_POST["redsoc"];
            $especialidad = $_POST["especialidad"];
            $objeto = new profesores($nombre,$dni,$celular,$direccion,$sexo,$fdnac,$foto,$email,$redsoc,$especialidad);
            $objeto->conectar();
            $objeto->creartb();
            if($id_prof==0){
                echo $objeto->guardar();
                header("Location:http://localhost:8080/CEA/regprof.php");
                ob_end_flush();
                exit;
            }
            else{
                echo $objeto->modificar($id_prof); 
                header("Location:http://localhost:8080/CEA/regprof.php");
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
           <li class="sidebar-brand"><a id="menu-toggle" href="indexxx.php">Menu<i id="main_icon" class="fas fa-align-justify"></i></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
              <li><a  href="regalumn.php">Alumno<i class="sub_icon fas fa-address-book"></i></span></a></li>
              <li><a  href="regprof.php">Personal<i class="sub_icon far fa-address-book"></i></a></li>
            <li><a  href="regcurs.php">Cursos<i class="sub_icon fas fa-university"></i></a></li>
          <li><a href="regusu.php">Usuarios<i class="sub_icon fas fa-users"></i></a></li>
          <li><a href="listcuo.php">Cuotas<i class="sub_icon fas fa-money-check-alt"></i></a></li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
          <li><a class="btn-outline-success btn-exit-usu" href="cerrar_sesion.php">Salir<i class="sub_icon fas fa-door-open"></a></i>
        </ul>
      </div>
      <div id="page-content-wrapper">
        <div class="page-content inset"> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 ">
                <form name="tuformulario" method="post" action="regprof.php">
                <h4 class="letrabl" align="center">Registro</h4>
                    <div class="form-group">
                        
                            <input type="text" name ="nombre" class="form-control" aria-describedby="emailHelp" placeholder="Nombre" value="<?PHP echo $nombre ?>">
                        
                        <br>
                        
                            <input type="text" name="dni" class="form-control" aria-describedby="emailHelp" placeholder="DNI" value="<?PHP echo $dni?>">
                        
                            <br>
                        
                                <input type="text" name="celular" class="form-control" aria-describedby="emailHelp" placeholder="Telefono" value="<?PHP echo $celular?>">
                            
                                <br>
                        
                            <input type="text" name="direccion" class="form-control" aria-describedby="emailHelp" placeholder="Direccion" value="<?PHP echo $direccion?>">
                            <br>
                        
                        <select class="form-control" name="sexo">
                            <option selected hidden>Selecciona un sexo</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                        </select>
                        Fecha de Nacimiento:
                        <input class="form-control" name="fdnac" type="date" value="<?PHP echo $fdnac ?>"><br>
                        
                            <input type="hidden" name="foto" class="form-control" aria-describedby="emailHelp" placeholder="Copie el enlace de la foto" value="<?PHP echo $foto?>">
                            <br>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="<?PHP echo $email?>">
                            <br>
                            <input type="text" name="redsoc" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese el link del perfil" value="<?PHP echo $redsoc?>">
                            <br>
                            <input type="text" name="especialidad" class="form-control" aria-describedby="emailHelp" placeholder="Ej: Matematicas-Barberia-Tec. Electronica-etc." value="<?PHP echo $especialidad?>">
                            <br>
                            <input type="hidden" class="form-control" name="id_prof" aria-describedby="emailHelp" value="<?PHP echo $id_prof?>"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-guardar-prof">Guardar</button>
                    <a href="regprof.php" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
            <div class="col-10">
                <h4 class="letrabl"  align="center">Lista de profesores</h4>
                <div class="busqueda">
                <input class="form-control" id="myInput" type="text" placeholder="Ingrese los valores a buscar" style="width:300px;height:30px">
                </div>
                <?Php
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());
                
        $sql = "SELECT id_prof,nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,especialidad FROM profesores";
        $result = $conn->query($sql);
        echo "<table  class='table table-bordered formreg '>
        <thead class='thead-dark'><tr>
        <th scope='col'><center>Nombre</center></th>
        <th scope='col'><center>DNI</center></th>
        <th scope='col'><center>Celular</center></th>
        <th scope='col'><center>Direccion</center></th>
        <th scope='col'><center>Sexo</center></th>
        <th scope='col'><center>Fecha de Nacimiento</center></th>
        <th scope='col'><center>Especialidades</center></th>
        <th scope='col'><center>Acciones</center></th>
        </tr></thead>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tbody id='myTable'><tr>
                <td><img class='fotoperf' src='".$row["foto"]."'><center>" . $row["nombre"]."</center></td>
                <td><center>". $row["dni"]."</center></td>
                <td><center>" . $row["celular"]."</center></td>
                <td><center>" . $row["direccion"]."</center></td>
                <td><center>" . $row["sexo"]."</center></td>
                <td><center>" . $row["fdnac"]."</center></td>   
                <td><center>" . $row["especialidad"]."</center></td>
                <td><center><a  href='regprof.php?id_prof=".$row["id_prof"]."'><i class='fas fa-user-edit'></i></a>
                <a class='btn-exit-alumn' href='eliminar.php?id_prof=".$row["id_prof"]."'><i class='fas fa-user-times'></i></td>
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