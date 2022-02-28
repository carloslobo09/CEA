        <html lang="en">
                <head>
                  <!-- Required meta tags -->
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              
                  <!-- Bootstrap CSS -->
                  <link rel="stylesheet" href="css/bootstrap.css">
                  <link rel="stylesheet" href="css2/all.min.css">

                  <title>Login</title>
                  <style>
                      .lienzo
                        {background-image: url(https://st3.depositphotos.com/9966530/13345/i/1600/depositphotos_133458342-stock-photo-wallpaper-texture-background-in-light.jpg);
                        background-size: 100%; 
                        font-family: Helvetica;
                      }
                     
                  </style>
                </head>
                <?php
                include "conexion.php";
                $con = new conexion();
                $conn = new mysqli($con->getservername(), $con->getusername(),$con->getpassword(),$con->getdbname());
                      if (isset($_POST["login"])&&isset($_POST["password"])) {
                          $login=$_POST["login"];
                          $pass=$_POST["password"];
                          $sql ="SELECT * FROM usuarios";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if ($login==$row["usuario"] && $pass==$row["password"]) {
                                    header("Location:indexxx.php");
                                }else{
                                   echo"<div align='center' class='alert alert-danger' role='alert'>
  <strong>Usuario no registrado:</strong> Probablemente usted ingreso mal el usuario o su contraseña, intente de nuevo por favor!
</div>";
                                }
                            }
                        }
                      }
                
                
                ?>
<body class="lienzo">
<br><br>
<center>&nbsp;<img src="user.png" alt="" width="200"></center><br>
<h2 ALIGN="center" class="letrabl">&nbsp;&nbsp;&nbsp;INICIAR SESION</h2>
    <form class="letrabl" name="Conexion" method="post" action="index.php">
    <center>
        <div class="col-6">
        <div class="col-md-6 col-md-offset-3">
            <table class="table"><tr>
        <td width=20%><label for="usuario"><strong>Usuario:</strong></label></td>
        <td width=80%><input type="text" size="20" name="login"></td>
                    </tr><tr>
        <td width=20%><label for="contraseña"><strong>Contraseña:</strong></label></td>
        <td width=80%><input type="password" size="20" name="password"></td></tr>
        </table>
        <div align="center">
                 <button type="submit"  class="btn btn-success">Conectar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button href="index.html" type="reset" class="btn btn-warning">Reset</button>
        </div>
        
        </div>
                    </div></center>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>