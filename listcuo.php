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
    <title>Cuotas</title>

  </head>
<body class="fondo">
<?Php
        include "cuotas.php";
        if(isset($_GET["id_cuo"])){
            $id_cuo=$_GET["id_cuo"];
            $cuo = new cuotas("","","","","","","","");
            $cuo->getbyId($id_cuo);
            $id_alum = $cuo->getid_cuo();
            $id_cur= $cuo->getid_cur(); 
            $nro_cuota = $cuo->getnro_cuota();
            $concepto = $cuo->getconcepto(); 
            $importe= $cuo->getimporte();
            $saldo = $cuo->getsaldo();
            $f_pago = $cuo->getf_pago();
            $estado = $cuo->getestado();
        }
        if(isset($_GET["id_alum"]) && isset($_GET["id_cur"])){
            $id_alum=$_GET["id_alum"];
            $id_cur=$_GET["id_cur"];
            $nro_cuota = 0;
            $concepto = ""; 
            $importe= 0;
            $saldo = 0;
            $f_pago ="";  
            $estado ="";
            $id_cuo=0;
        }
        if(isset($_POST["id_alum"]) &&
        isset($_POST["id_cur"]) &&
        isset($_POST["nro_cuota"]) &&
        isset($_POST["concepto"]) &&  
        isset($_POST["importe"]) && 
        isset($_POST["saldo"]) &&
        isset($_POST["f_pago"]) &&
        isset($_POST["estado"]) &&
        isset($_POST["id_cuo"]) ){
            $id_cuo =$_POST["id_cuo"];
            $nro_cuota = $_POST["nro_cuota"];
            $concepto = $_POST["concepto"];
            $importe = $_POST["importe"];
            $saldo = $_POST["saldo"];
            $f_pago = $_POST["f_pago"];
            $estado = $_POST["estado"];
            $id_alum=$_POST["id_alum"];
            $id_cur= $_POST["id_cur"];
            $objeto = new cuotas($id_alum,$id_cur,$nro_cuota,$concepto,$importe,$saldo,$f_pago,$estado);
            $objeto->conectar();
            $objeto->creartb();
            if($id_cuo==0){
                echo $objeto->guardar();
                header("listcuo.php");
                ob_end_flush();
                exit;
            }
            else{
                echo $objeto->modificar($id_cuo); 
                header("regalumn.php");
            } 
  
        }    
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
        <div class="col-12">
                <h4 class="letrabl" align="center">Lista de cuotas pagadas</h4>
                <div class="busqueda">
                <input class="form-control" id="myInput" type="text" placeholder="Ingrese los valores a buscar" style="width:300px;height:30px">

                </div>
                <?Php
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());
                
        $sql = "SELECT alumnos.*,cursos.*,cuotas.* FROM cuotas
        INNER JOIN alumnos on alumnos.id_alum=cuotas.id_alum 
        INNER JOIN cursos on cursos.id_cur=alumnos.id_cur  WHERE estado=1 ORDER BY f_pago desc";
        $result = $conn->query($sql);
        echo "<table  class='table table-bordered formreg'>
        <thead class='thead-dark'><tr>
        <th scope='col'><center>Nombre de alumno</center></th>
        <th scope='col'><center>Curso</center></th>
        <th scope='col'><center>Concepto</center></th>
        <th scope='col'><center>Importe</center></th>
        <th scope='col'><center>Saldo</center></th>
        <th scope='col'><center>Fecha de pago</center></th>
        <th scope='col'><center>Fecha de vencimiento</center></th>
        <th scope='col'><center>Acciones</center></th>
        </tr></thead>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tbody id='myTable'><tr>
                <td><center>" . $row["nombre"] ."</center></td>
                <td><center>" . $row["ncurso"] ."</center></td>
                <td><center>" . $row["concepto"]."</center></td>
                <td><center>" . $row["importe"]."</center></td>
                <td><center>" . $row["saldo"]."</center></td>
                <td><center>" . $row["f_pago"]."</center></td>
                <td><center>" . $row["f_venc"]."</center></td>
                <td><center>
                <a class='btn-exit-cuo' href='eliminar.php?id_cuo=".$row["id_cuo"]."'><i class='fas fa-trash-alt'></i></td>
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
  $("#main_icon").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
</script>
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