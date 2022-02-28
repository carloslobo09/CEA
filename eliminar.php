<?php
include "conexion.php";
$con = new conexion();
        $conn = new mysqli($con->getservername(),
         $con->getusername(),
          $con->getpassword(),
           $con->getdbname());
                if(isset($_GET["id_alum"])) {
                    $sql = "DELETE FROM alumnos WHERE id_alum='".$_GET['id_alum']."';";
                    $result = $conn->query($sql);

                    header("Location:http://localhost:8080/boostrap/regalumn.php");
                }
                 if(isset($_GET["id_aul"])) {
                    $sql = "DELETE FROM aulas WHERE id_aul='".$_GET['id_aul']."';";
                    $result = $conn->query($sql);

                    header("Location:http://localhost:8080/boostrap/regaulas.php");
                }
                if(isset($_GET["id_prof"])) {
                    $sql = "DELETE FROM profesores WHERE id_prof='".$_GET['id_prof']."';";
                    $result = $conn->query($sql);

                    header("Location:http://localhost:8080/boostrap/regprof.php");
                }
                if(isset($_GET["id_cur"])) {
                    $sql = "DELETE FROM cursos WHERE id_cur='".$_GET['id_cur']."';";
                    $result = $conn->query($sql);

                    header("Location:http://localhost:8080/boostrap/regcurs.php");
                }
                if(isset($_GET["id_cuo"])) {
                    $sql = "UPDATE cuotas SET estado=0 WHERE id_cuo=".$_GET['id_cuo'];
                    $result = $conn->query($sql);
                    header("Location:http://localhost:8080/boostrap/listcuo.php");
                }
                $conn->close();
?>