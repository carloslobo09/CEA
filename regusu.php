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
    <title>Usuarios</title>
</head>

<body class="fondo">
<?Php
        include "usuarios.php";
        if(isset($_GET["id_usu"])){
                $id_usu=$_GET["id_usu"];
                $usu = new usuarios("","");
                $usu->getbyId($id_usu);
                $usuario=$usu->getusu(); 
                $password= $usu->getpassword(); 
        }
        else{
            $usuario= "";
            $password= ""; 
            $id_usu=0;
        }
        if(isset($_POST["usuario"]) &&
           isset($_POST["password"]) &&
           isset($_POST["passconf"]) &&
           isset($_POST["id_usu"])){
            if ($_POST["password"]==$_POST["passconf"]) {
                $id_usu = $_POST["id_usu"]; 
                $usuario = $_POST["usuario"];
                $password = $_POST["password"];
                $objeto = new usuarios($usuario,$password);
                $objeto->conectar();
                $objeto->creartb();
                if($id_usu==0){
                    echo $objeto->guardar();
                    header("Location:http://localhost:8080/CEA/regusu.php");
                    ob_end_flush();
                    exit;
                }
                else{
                    echo $objeto->modificar($id_usu); 
                    header("Location:http://localhost:8080/CEA/regusu.php");
                } 
            } else {
                echo"<div align='center' class='alert alert-danger' role='alert' style='position:absolute;top:60;left:500'>
  <strong>Error:</strong>  Las contraseñas deben coincidir, intente de nuevo por favor!
</div>";
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
            <div class="col-2">
                <?php
                if (isset($_GET["id_usu"])) {
                    $passconf="";
                    echo " <h4 class='letrabl' align='center'>Registro</h4>
                    <form method='POST' action='regusu.php' name='tuformulario4'>
                       <input type='text' class='form-control' placeholder='Usuario' name='usuario' value='".$usuario."'><br>
                       <input type='password' class='form-control' placeholder='Password' name='password' ><br>
                       <input type='password' class='form-control' placeholder='Confirma password' name='passconf' value='".$passconf."'><br>
                       <input type='hidden' name='id_usu' value='".$id_usu."'>
                        <button type='submit' class='btn btn-success btn-guardar-usu'>Guardar</button>
                        <a href='regusu.php' class='btn btn-danger'>Cancelar</a>
                    </form>";
                }
                ?>
               
            </div>
            <div class="col-6">
                <br><br><h4 class="letrabl" align="center">Editar usuario</h4>

                <?Php
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());
                
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-offset-4'><table class='table formreg' style='font-size:20px'><tbody><tr>
                <td><center>Usuarios:</center></td>
                <td><center>" . $row["usuario"]."</center></td></tr>
                <tr><td><center>Password:</center></td>
                <td><center><input type='password' class='form-control' size='5' value='".$row["password"]."'></center></td></tr>
                <td colspan='2'><center><a  href='regusu.php?id_usu=".$row["id_usu"]."'><i class='fas fa-user-edit'></i></a>
                </tr></tbody></table></div>";
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
<script src="op3.js"></script>
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