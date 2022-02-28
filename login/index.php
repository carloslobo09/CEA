<html>
<head>
<title>LOGIN</title>
                  <!-- Required meta tags -->
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              
                  <!-- Bootstrap CSS -->
                  <link rel="stylesheet" href="css/bootstrap.css">
                  <title>Hello, world!</title>
                  <style>
                      .fondo{background-image: url(https://i.pinimg.com/736x/16/e3/af/16e3afca1c0fdd1bfb2cb67ed1519a76.jpg);
                             background-size: 100%; 
                      }
                      .letra, .letra2{
                          text-align: center;
                          font-size: 160px;
                          color:black
                      }
                      .form {
            background-color: white;
        }
        .letrabl {
            color:white;
        }
                      .letra2{
                          font-size: 60px;
                      }
                      .crsn{
                          position: absolute;
                          left:1200;
                      }
                  </style>
<link rel="stylesheet" href="login.css">
</head>
<body class="fondo">
<h2 align="center" class="letrabl">INICIAR SESION:</h2>
<table class="login">
<form action="comprueba_login.php" method="POST">
<tr><td class="izq">User: </td><td class="der"> <input type="text" name="login"></td></tr>
<tr><td class="izq">Password: </td><td class="der"> <input type="password" name="password"></td></tr>
<tr><td colspan="2"><input type="submit" name="enviar" value="Iniciar sesion"></td></tr> 
<form>
</table></br></br>
<center><a href="registrar_usuarios.php"><input type="button" value="Registrarme"></center>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>