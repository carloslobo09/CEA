<?php
include ("conexion.php");
class aulas{
    protected $naula;
    protected $capacidad;
    protected $detalle;
    
    function __construct($naula,$capacidad,$detalle){
        $this->naula = $naula;
        $this->capacidad = $capacidad;
        $this->detalle=$detalle;
        $this->conexion = new conexion();
    }
public function setnombre($nom){
    $this->naula = $nom;
}
public function getnombre(){
    return $this->naula;
}
public function setcapacidad($cap){
    $this->capacidad = $cap;
}
public function getcapacidad(){
    return  $this->capacidad;
}
public function setdetalle($det){
    $this->detalle= $det;
}
public function getdetalle(){
    return  $this->detalle;
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
    $sql="CREATE TABLE aulas(id_aul integer auto_increment,
        naula varchar(40) NOT NULL,
        capacidad integer(5) NOT NULL,
        detalle nvarchar(200) NOT NULL,
        PRIMARY KEY (id_aul));";
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
            $sql = "INSERT INTO aulas(naula,capacidad,detalle) VALUES 
            ('".$this->naula."','".$this->capacidad."','".$this->detalle."')";
            
            if ($conn->query($sql) === TRUE) {
                return  " ";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_aul){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_aul,naula,capacidad,detalle FROM aulas where id_aul=".$id_aul;
    $result = $conn->query($sql);
    
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
           $this->naula = $row["naula"]; 
           $this->capacidad = $row["capacidad"];
           $this->detalle = $row["detalle"];
        }
    } 
    $conn->close();
}


public function modificar($id_aul){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_aul FROM aulas where id_aul=".$id_aul.";" ;
    $result = $conn->query($sql);       
    $sql = "UPDATE aulas SET naula='".$this->naula."',capacidad='".$this->capacidad."',detalle='".$this->detalle."' WHERE id_aul=".$id_aul;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $this->naula = $row["naula"]; 
           $this->capacidad = $row["capacidad"];
           $this->detalle = $row["detalle"];
        }
    } 
    $conn->close();
}
public function borrar($id_aul){
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(),
      $this->conexion->getpassword(),
       $this->conexion->getdbname());
            
    $sql = "DELETE FROM aulas WHERE id_aul='".$id_aul."';";
    $result = $conn->query($sql);
    $conn->close();
}


public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_aul,naula,capacidad,detalle FROM aulas";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;

}
}
?>
