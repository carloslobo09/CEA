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
            $cuo = new cuotas("","","","","","","");
            $cuo->getbyId($id_cuo);
            $id_alum= $cuo ->getid_alum();
            $concepto = $cuo->getconcepto(); 
            $importe= $cuo->getimporte();
            $saldo= $cuo->getsaldo();
            $f_pago = $cuo->getf_pago();
            $f_venc = $cuo->getf_venc();
            $estado = $cuo->getestado();
        }
        else{
            $id_alum=0;
            $concepto =""; 
            $importe= 0;
            $saldo=0;
            $f_pago ="";  
            $f_venc ="";  
            $estado ="";
            $id_cuo= 0;
        }
        if(isset($_POST["id_alum"]) &&
        isset($_POST["concepto"]) &&  
        isset($_POST["importe"]) &&
        isset($_POST["saldo"]) && 
        isset($_POST["f_pago"]) &&
        isset($_POST["f_venc"]) &&
        isset($_POST["estado"]) &&
        isset($_POST["id_cuo"]) ){
            $id_alum =$_POST["id_alum"];
            $concepto = $_POST["concepto"];
            $importe = $_POST["importe"];
            $saldo = $_POST["saldo"];
            $f_pago = $_POST["f_pago"];
            $f_venc = $_POST["f_venc"];
            $estado = $_POST["estado"];
            $id_cuo= $_POST["id_cuo"];
            $objeto = new cuotas($id_alum,$concepto,$importe,$saldo,$f_pago,$f_venc,$estado);
            $objeto->conectar();
            $objeto->creartb();
            if($id_cuo==0){
                echo $objeto->guardar();
                header("Location:http://localhost:8080/CEA/regalumn.php");
                ob_end_flush();
                exit;
            }
            else{
                echo $objeto->modificar($id_cuo,$id_alum); 
                header("Location:http://localhost:8080/CEA/regcuo.php?id_alum='".$id_alum."'&id_cur='".$id_cur."'");
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
            <div class="col-12 ">
                <form class=" formreg" method="post" action="regcuo.php" name="tuformulario1" align="center">
                <h4 class="letrabl">Registro de cuotas</h4>
                <?Php
        if (isset($_GET["id_alum"])){
        $id_alum=$_GET["id_alum"];
        $con = new conexion();$conn = new mysqli($con->getservername(),$con->getusername(),$con->getpassword(),$con->getdbname());
            $sql ="SELECT id_cuo,concepto,estado,saldo FROM cuotas INNER JOIN alumnos on cuotas.id_alum=alumnos.id_alum and alumnos.id_alum=".$id_alum;
            $result = $conn->query($sql) or die($conn->error) ;
            echo "<div style='position:absolute;left:950;top:50;'><strong class='alert alert-danger'><i class='fas fa-arrow-left' style='color:red'></i>&nbsp;RECUERDE</strong><br><br><strong>¡Abonar la INSCRIPCION siempre que se registre un alumno nuevo!<strong></div>
            ";
            echo "<div class='col-md-6 col-md-offset-3'><table style='color:white' class='table table-hover formreg'>";
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $salact=$row["saldo"];
                $saldo=$saldo+$salact;
                
                if ($row["estado"]==1){
                    echo "<tbody><tr onclick="; echo "location='regcuo.php?id_cuo=".$row["id_cuo"]."'"; echo " class='bg-success'> 
                <td><center> ".$row["concepto"]."</center></td>
                <td><center>Pagado</center></td>
                <td><i style='color:green;' class='far fa-check-circle'></i></td>
                </tr></a></tbody>";
                }
                else {
                    echo "<tbody><tr onclick="; echo "location='regcuo.php?id_cuo=".$row["id_cuo"]."'"; echo " class='bg-danger'> 
                <td><center> ".$row["concepto"]."</center></td>
                <td><center>No pagado</center></td>
                <td><i style='color:red;' class='fas fa-ban'></i></td>
                </tr></tbody>";
                }
            }
        }
        echo "</table></div>";
            $conn->close();
    }
                 ?>
                 <?php
    $con = new conexion();
    $conn = new mysqli($con->getservername(), $con->getusername(), $con->getpassword(), $con->getdbname());
       $sql = "SELECT alumnos.nombre,cursos.ncurso,cursos.precio,cursos.pinscrip FROM alumnos INNER JOIN cursos on alumnos.id_cur=cursos.id_cur and alumnos.id_alum=".$id_alum;
       $result = $conn->query($sql);
       if ($result->num_rows> 0) {
        while($row = $result->fetch_assoc()) {
            $nalum=$row["nombre"];
            $ncur=$row["ncurso"];
            $pinscrip=$row["pinscrip"];
            $pprecio=$row["precio"];
    }
    $conn->close();  
       }
       if(isset($_GET["id_cuo"])){
       echo "<div class='col-md-8 col-md-offset-2'>
       <table border=2px align='center' class='table'><tr>
           <td><label for='exampleInputEmail1'>Nombre de Alumno:</label></td>
           <td><input type='text' class='form-control' disabled='disabled' aria-describedby='emailHelp' placeholder='Nombre' value='".$nalum."'></td>
           </tr>    
           <input type='hidden' name='id_alum'  aria-describedby='emailHelp'  value='".$id_alum."'/>
           <tr>   
           <td><label for='exampleInputEmail1'>Curso:</label></td>
           <td><input type='text' class='form-control' disabled='disabled' aria-describedby='emailHelp' placeholder='DNI' size='40' value='".$ncur."'></td>
           </tr>
           <tr>
           <td><label for='exampleInputEmail1'>Concepto:</label></td>
           <td><input type='text' class='form-control' name='concepto' aria-describedby='emailHelp' placeholder='DNI' size='40' value='".$concepto."'></td>        
           </tr><tr>";
            if ($concepto=="INSCRIPCION") {
               echo "<td><label for='exampleInputEmail1'>Importe:</label></td><td><input class='form-control' name='importe' type='text' value='".$pinscrip."'></td></tr>";
           } else {
               echo "<td><label for='exampleInputEmail1'>Importe:</label></td><td><input class='form-control' name='importe' value='".$pprecio."'></td></tr>";
           }
           echo "<tr>
           <td><label for='exampleInputEmail1'>Saldo:</label></td>
           <td><input name='saldo' type='text' class='form-control' aria-describedby='emailHelp' placeholder='DNI' size='40' value='".$saldo."'></td>        
           </tr>
                   <input type='hidden' name='f_pago' class='form-control' aria-describedby='emailHelp'  value='".$f_pago."'>
                   <input type='hidden' name='f_venc' class='form-control' aria-describedby='emailHelp'  value='".$f_venc."'>
                   <input type='hidden' name='estado' class='form-control' aria-describedby='emailHelp'  value='".$estado."'>
                   <input type='hidden' name='id_cuo' aria-describedby='emailHelp' value='".$id_cuo."'/>
           </div>
           </table><button type='submit' class='btn btn-success btn-guardar-cuo'>Pagar</button>
           <a href='regalumn.php' class='btn btn-danger'>Cancelar</a>";}
           else
           {echo "<table class='table'><tr><td><p><strong>Nombre del alumno:</strong>&nbsp".$nalum."</p></td>
               <td rowspan='2's><p style='font-size:50px;'>Saldo:".$saldo."</p></td></tr>
               <tr><td><p><strong>Nombre de curso:</strong>&nbsp".$ncur."</ps></td></tr></table>
               ";}?>
                    
                </form>

       </div>
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

<?php

?>
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