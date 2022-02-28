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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Alumnos</title>

  </head>
<body class="fondo">
<?Php
        include "alumnos.php";
        if(isset($_GET["id_alum"])){
            $id_alum=$_GET["id_alum"];
            $alumn = new alumnos("","","","","","","","","","","");
            $alumn->getbyId($id_alum);
            $nombre = $alumn->getnombre();
            $dni= $alumn->getdni();
            $celular = $alumn->getcelular();
            $direccion = $alumn->getdireccion();
            $sexo= $alumn->getsexo();
            $fdnac = $alumn->getfdnac();
            $foto = $alumn->getfoto();
            $email = $alumn->getemail();
            $redsoc = $alumn->getredsoc();
            $id_cur = $alumn->getid_cur();
            $triggxcuo = $alumn->gettriggxcuo();
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
            $id_cur = "";
            $triggxcuo = "";
            $id_alum=0;
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
        isset($_POST["id_cur"]) &&
        isset($_POST["triggxcuo"]) &&
        isset($_POST["id_alum"]) ){
            echo $_POST["nombre"];
            $id_alum = $_POST["id_alum"];
            $nombre = $_POST["nombre"];
            $dni = $_POST["dni"];
            $celular = $_POST["celular"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fdnac = $_POST["fdnac"];
            $foto = $_POST["foto"];
            $email = $_POST["email"];
            $redsoc = $_POST["redsoc"];
            $id_cur = $_POST["id_cur"];
            $triggxcuo = $_POST["triggxcuo"];
            $con = new conexion();
                    $conn = new mysqli($con->getservername(),
                     $con->getusername(),
                      $con->getpassword(),
                       $con->getdbname());
                       $sql = "SELECT duracion FROM cursos WHERE id_cur=".$id_cur;
                       $result = $conn->query($sql);
                       if ($result->num_rows> 0) {
                        while($row = $result->fetch_assoc()) {
                            $triggxcuo=$row["duracion"];
                    }
                    $conn->close();
                }
            $objeto = new alumnos($nombre,$dni,$celular,$direccion,$sexo,$fdnac,$foto,$email,$redsoc,$id_cur,$triggxcuo);
            $objeto->conectar();
            $objeto->creartb();
            if($id_alum==0){
                echo $objeto->guardar();
                $id_max=$objeto->getbyidmayor();
                header("Location:http://localhost:8080/CEA/regcuo.php?id_alum=".$id_alum."&id_cur=".$id_cur);
                ob_end_flush();
                exit;
            }
            else{
                echo $objeto->modificar($id_alum);
                header("Location:http://localhost:8080/CEA/regalumn.php");
            }

        }
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v4.0"></script>

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
            <div class="col-2 ">
                <form class=" formreg" method="post" action="regalumn.php" name="tuformulario3">
                <h4 class="letrabl" align="center">Registro</h4>
                    <div class="form-group">
                            <input require type="text" name ="nombre" class="form-control" aria-describedby="emailHelp" placeholder="Nombre" value="<?PHP echo $nombre ?>">
                        <br>
                            <input type="text" name="dni" class="form-control" aria-describedby="emailHelp" placeholder="DNI" value="<?PHP echo $dni?>">
                        <br>
                                <input type="text" name="celular" class="form-control" aria-describedby="emailHelp" placeholder="Telefono" value="<?PHP echo $celular?>">
                            <br>
                            <input type="text" name="direccion" class="form-control" aria-describedby="emailHelp" placeholder="Direccion" value="<?PHP echo $direccion?>">
                        <br>
                        <?php
                        if (isset($_GET["id_alum"])) {
                            echo "El sexo ya se encuentra registrado y no se puede editar!<br> <input type='hidden' name='sexo' aria-describedby='emailHelp' placeholder='Telefono' value='$sexo'>";
                            } else {
                            echo "
                            <select class='form-control' name='sexo'>
                            <option selected hidden>Selecciona un sexo</option>
                                <option value='H'>Hombre</option>
                                <option value='M'>Mujer</option>
                            </select>";
                            }
                        ?>

                        Fecha de Nacimiento:
                        <input class="form-control" name="fdnac" type="date" value="<?PHP echo $fdnac ?>">
                        <br>    
                        <input type="text" name="foto" class="form-control" aria-describedby="emailHelp" placeholder="Copie el enlace de la foto" value="<?PHP echo $foto?>">
                        <br>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="<?PHP echo $email?>">
                        <br>
                        <input type="text" name="redsoc" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese el link del perfil" value="<?PHP echo $redsoc?>">
                        <br>
                        <?php
                    $con = new conexion();
                    $conn = new mysqli($con->getservername(),
                     $con->getusername(),
                      $con->getpassword(),
                       $con->getdbname());
                       if (isset($_GET["id_alum"])) {
                        echo "El curso ya se encuentra registrado y no se puede editar!<input type='hidden' name='id_cur' aria-describedby='emailHelp' placeholder='Telefono' value='$id_cur'>";
                        } else {
                       $sql = "SELECT id_cur,ncurso,duracion FROM cursos";
                       $result = $conn->query($sql);
                       echo "<select class='form-control' name='id_cur'> <option selected hidden>Selecciona un curso</option>";
                       if ($result->num_rows> 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<option value=".$row["id_cur"].">".$row["ncurso"]."</option>";
                    }
                    echo "</select>";
                    $conn->close();
                }     }
                    ?><br>
                        <input type="hidden" class="form-control" name="id_alum" aria-describedby="emailHelp" value="<?PHP echo $id_alum?>"/>
                        <input type="hidden" class="form-control" name="triggxcuo" aria-describedby="emailHelp" value="<?PHP echo $triggxcuo?>"/>

                    </div>
                    <button type="submit" class="btn btn-success btn-guardar-alum">Guardar</button>
                    <a href="regalumn.php" class="btn btn-danger">Cancelar</a>
                </form>
       </div>
            <div class="col-10">
                <h4 class="letrabl" align="center">Lista de alumnos</h4>
                <br><table class="border" align="center">
                <tr>
                    <td>¡AL DÍA!&nbsp;&nbsp;</td><td class="list-group-item-success" style="border:1px solid">&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>¡PERIODO DE CANCELACION!&nbsp;&nbsp;</td><td class="table-warning" style="border:1px solid">&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>¡DEUDOR!&nbsp;&nbsp;</td><td class="table-danger" style="border:1px solid">&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>¡PROBABLEMENTE YA NO ASISTA!&nbsp;&nbsp;</td><td class="table-light" style="border:1px solid">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                </table>
                <br>
                <div class="busqueda">
                <input class="form-control" id="myInput" type="text" placeholder="Ingrese los valores a buscar" style="width:300px;height:30px">
                </div>
                <?Php
        $con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());

        date_default_timezone_set('America/Buenos_Aires');
        $actual=strtotime(date("Y-m-d"));
                
        $sql ="SELECT alumnos.*,cursos.*,cuotas.* FROM cuotas
        INNER JOIN (SELECT max(id_cuo) as 'maxid' FROM cuotas where estado=1 group by id_alum) as maxcuo on cuotas.id_cuo=maxcuo.maxid
        INNER JOIN alumnos on alumnos.id_alum=cuotas.id_alum 
        INNER JOIN cursos on cursos.id_cur=alumnos.id_cur 
        ;";
        $result = $conn->query($sql);
        echo "<table  class='table table-bordered formreg'>
        <thead class='thead-dark'><tr>
        <th scope='col'><center>Nombre</center></th>
        <th scope='col'><center>DNI</center></th>
        <th scope='col'><center>Celular</center></th>
        <th scope='col'><center>Curso a registrado</center></th>
        <th scope='col'><center>Vencimiento de la proxima cuota</center></th>
        <th scope='col'><center>Acciones</center></th>
        </tr></thead>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fechven=$row["f_venc"];
                $fechven=strtotime($fechven);
                // echo $fechven."VENCIMIENTO<br>";
                $pcan=strtotime("-10 day",strtotime($row["f_venc"]));
                // echo $pcan."     TACHA<br>";
                $seismes=strtotime("+5 month",strtotime($row["f_venc"]));
                // echo $seismes."     SEIS MESES MAS<br>";
                $comparacion=strtotime(date("2020-08-11"));
                // echo $comparacion."comparacion<br>";
                // echo $fechven."VENCIMIENTO<br>";
                
                
                if($actual<$pcan){
                    echo "<tbody id='myTable'><tr class='table-success'>";
                    echo "<td><center>" . $row["nombre"]."</center></td>
                <td><center>". $row["dni"]."</center></td>
                <td><center>" . $row["celular"]."</center></td>
                <td><center>" . $row["ncurso"]."</center></td>
                <td><center>" . $row["f_venc"]."</center></td>
                <td><center><a  href='regalumn.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-edit'></i></a>
                <a class='btn-exit-alum' href='eliminar.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-times'></i></a>
                <a href='regcuo.php?id_alum=".$row["id_alum"]."&id_cur=".$row["id_cur"]."'><i class='fas fa-comment-dollar'></i></a></td>
                <td style='background-color:white'; border=none;><center><a href='det_alum.php?id_alum=".$row["id_alum"]."'><i class='far fa-address-card'></i></center></td>
                </tr></tbody>";
                }
                if ($actual>=$pcan && $actual<=$fechven) {
                    echo "<tbody id='myTable'><tr class='table-warning'>";
                        echo "<td><center>" . $row["nombre"]."</center></td>
                        <td><center>". $row["dni"]."</center></td>
                        <td><center>" . $row["celular"]."</center></td>
                        <td><center>" . $row["ncurso"]."</center></td>
                        
                        <td><center>" . $row["f_venc"]."</center></td>
                        <td><center><a  href='regalumn.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-edit'></i></a>
                        <a class='btn-exit-alum' href='eliminar.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-times'></i></a>
                        <a href='regcuo.php?id_alum=".$row["id_alum"]."&id_cur=".$row["id_cur"]."'><i class='fas fa-comment-dollar'></i></td>
                        <td style='background-color:white'; border=none;><center><a href='det_alum.php?id_alum=".$row["id_alum"]."'><i class='far fa-address-card'></i></center></td>
                        </tr></tbody>";
                }
                if ($actual>$fechven && $actual<=$seismes) {
                    echo "<tbody id='myTable'><tr class='table-danger'>";
                            echo "<td><center>" . $row["nombre"]."</center></td>
                            <td><center>". $row["dni"]."</center></td>
                            <td><center>" . $row["celular"]."</center></td>
                            <td><center>" . $row["ncurso"]."</center></td>
                            
                            <td><center>" . $row["f_venc"]."</center></td>
                            <td><center><a  href='regalumn.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-edit'></i></a>
                            <a class='btn-exit-alum' href='eliminar.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-times'></i></a>
                            <a href='regcuo.php?id_alum=".$row["id_alum"]."&id_cur=".$row["id_cur"]."'><i class='fas fa-comment-dollar'></i></td>
                            <td style='background-color:white'; border=none;><center><a href='det_alum.php?id_alum=".$row["id_alum"]."'><i class='far fa-address-card'></i></center></td>
                            </tr></tbody>";
                }
                    
                if ($actual>$seismes) {
                    echo "<tbody id='myTable'><tr class='table-light'>";
                                echo "<td><center>" . $row["nombre"]."</center></td>
                                <td><center>". $row["dni"]."</center></td>
                                <td><center>" . $row["celular"]."</center></td>
                                <td><center>" . $row["ncurso"]."</center></td>
                                
                                <td><center>" . $row["f_venc"]."</center></td>
                                <td><center><a  href='regalumn.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-edit'></i></a>
                                <a class='btn-exit-alum' href='eliminar.php?id_alum=".$row["id_alum"]."'><i class='fas fa-user-times'></i></a>
                                <a href='regcuo.php?id_alum=".$row["id_alum"]."&id_cur=".$row["id_cur"]."'><i class='fas fa-comment-dollar'></i></td>
                                <td style='background-color:white'; border=none;><center><a href='det_alum.php?id_alum=".$row["id_alum"]."'><i class='far fa-address-card'></i></center></td>
                                </tr></tbody>";
                }
                        }
                    }
            
        echo "</table>";
        $conn->close();
        // $fechay=date("Y-m-d",$fechay);
        // $fechac=date("Y-m-d",$fechac);
        // $fechap=date("Y-m-d",$fechap);
        // echo $fechay."<br>";
        //         echo $fechac."<br>";
        //         echo $fechap."<br>";
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
<!-- <script src="js/jquery-3.1.1.min.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<script src="js/AjaxForms.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/source_lines.js"></script>
<!-- <script src="plugins/jtable/jquery-ui.js" type="text/javascript"></script>
<script src="plugins/jtable/jquery.jtable.js" type="text/javascript"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>