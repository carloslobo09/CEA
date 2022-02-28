<?php
include ("conexion.php");
class usuarios{
    protected $usuario;
    protected $password;
    
    function __construct($usuario,$password){
        $this->usuario = $usuario;
        $this->password = $password;
        $this->conexion = new conexion();
    }
public function setusu($nom){
    $this->usuario = $nom;
}
public function getusu(){
    return $this->usuario;
}
public function setpassword($cap){
    $this->password = $cap;
}
public function getpassword(){
    return  $this->password;
}


public function conectar(){
    $conn= new mysqli($this->conexion->getservername(), $this->conexion->getusername(), $this->conexion->getpassword());
    if($conn->connect_error){
        echo "Fallo la conexion" . $conn->connect_error;
    }
    else{
        echo "Conectada";
    }
    
        $sql="CREATE DATABASE institutocea";
    if(mysqli_query( $conn,$sql)){
        echo "Base de datos creada";
    }
    else{
        echo "La base de datos ya existe!" . mysqli_error($conn);
    }
    }
public function creartb(){
    $conn= new mysqli($this->conexion->getservername(), $this->conexion->getusername(), $this->conexion->getpassword(), $this->conexion->getdbname());
    $sql="USE institutocea";
    $sql="CREATE TABLE usuarios(id_usu integer auto_increment,
        usuario varchar(40) NOT NULL,
        password varchar(40) NOT NULL,
        PRIMARY KEY (id_usu));";
    if($conn->query($sql)===true){
       echo "Se creo la tabla";
    }
    else{
        echo "error" . $conn->error; 
       }


}


public function guardar(){
       
    $conn = new mysqli($this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else{
            $sql = "INSERT INTO usuarios(usuario,password) VALUES 
            ('".$this->usuario."','".$this->password."')";
            
            if ($conn->query($sql) === TRUE) {
                return  " ";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_usu){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_usu,usuario,password FROM usuarios where id_usu=".$id_usu;
    $result = $conn->query($sql);
    
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
           $this->usuario = $row["usuario"]; 
           $this->password = $row["password"];
        }
    } 
    $conn->close();
}


public function modificar($id_usu){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_usu FROM usuarios where id_usu=".$id_usu.";" ;
    $result = $conn->query($sql);       
    $sql = "UPDATE usuarios SET usuario='".$this->usuario."',password='".$this->password."' WHERE id_usu=".$id_usu;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $this->usuario = $row["usuario"]; 
           $this->password = $row["password"];
        }
    } 
    $conn->close();
}
public function borrar($id_usu){
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(),
      $this->conexion->getpassword(),
       $this->conexion->getdbname());
            
    $sql = "DELETE FROM usuarios WHERE id_usu='".$id_usu."';";
    $result = $conn->query($sql);
    $conn->close();
}


public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_usu,usuario,password FROM usuarios";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;

}
}
?>
