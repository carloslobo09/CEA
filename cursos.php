<?php
include ("conexion.php");
class cursos{
    protected $id_prof;
    protected $ncurso;
    protected $duracion;
    protected $pinscrip;
    protected $precio;
    
    function __construct($id_prof,$ncurso,$duracion,$pinscrip,$precio){
        $this->id_prof = $id_prof;
        $this->ncurso = $ncurso;
        $this->duracion = $duracion;
        $this->pinscrip = $pinscrip;
        $this->precio = $precio;
        $this->conexion = new conexion();
    }
public function setid_prof($prof){
    $this->id_prof = $prof;
}
public function getid_prof(){
    return  $this->id_prof;
}
public function setnombre($nom){
    $this->ncurso = $nom;
}
public function getnombre(){
    return $this->ncurso;
}
public function setduracion($dur){
    $this->duracion = $dur;
}
public function getduracion(){
    return $this->duracion;
}
public function setpinscrip($pi){
    $this->pinscrip = $pi;
}
public function getpinscrip(){
    return $this->pinscrip;
}
public function setprecio($pre){
    $this->precio = $pre;
}
public function getprecio(){
    return $this->precio;
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
    $sql="CREATE TABLE cursos(id_cur integer auto_increment,
        id_prof integer(5) NOT NULL,
        ncurso varchar(40) NOT NULL,
        duracion integer(5) NOT NULL,
        pinscrip decimal (10,2) NOT NULL,
        precio decimal(10,2) NOT NULL,
        PRIMARY KEY (id_cur),
        FOREIGN KEY (id_prof) REFERENCES profesores (id_prof));";
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
            $sql = "INSERT INTO cursos(id_prof,ncurso,duracion,pinscrip,precio) VALUES 
            ('".$this->id_prof."','".$this->ncurso."','".$this->duracion."','".$this->pinscrip."','".$this->precio."')";
            
            if ($conn->query($sql) === TRUE) {
                return  " ";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_cur){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_cur,id_prof,ncurso,duracion,pinscrip,precio FROM cursos where id_cur=".$id_cur;
    $result = $conn->query($sql);
    
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
            $this->id_prof = $row["id_prof"];
            $this->ncurso = $row["ncurso"];
            $this->duracion = $row["duracion"];
            $this->pinscrip = $row["pinscrip"]; 
            $this->precio = $row["precio"]; 
        }
    } 
    $conn->close();
}


public function modificar($id_cur){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_cur FROM cursos where id_cur=".$id_cur.";" ;
    $result = $conn->query($sql);       
    $sql = "UPDATE cursos SET id_prof='".$this->id_prof."',ncurso='".$this->ncurso."',duracion='".$this->duracion."',pinscrip='".$this->pinscrip."',precio='".$this->precio."' WHERE id_cur=".$id_cur;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $this->id_prof = $row["id_prof"];
            $this->ncurso = $row["ncurso"]; 
            $this->pinscrip = $row["pinscrip"]; 
            $this->precio = $row["precio"]; 
        }
    } 
    $conn->close();
}


public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_cur,id_prof,ncurso,duracion,pinscrip,precio FROM cursos";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;

}
}
?>