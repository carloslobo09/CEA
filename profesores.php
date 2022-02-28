<?php
include ("conexion.php");
class profesores{
    protected $nombre;
    protected $dni;
    protected $celular;
    protected $direccion;
    protected $sexo;
    protected $fdnac;
    protected $foto;
    protected $email;
    protected $redsoc;
    protected $especialidad;
    
    function __construct($nombre,$dni,$celular,$direccion,$sexo,$fdnac,$foto,$email,$redsoc,$especialidad){
        $this->nombre = $nombre;
        $this->dni=$dni;
        $this->celular= $celular;
        $this->direccion= $direccion;
        $this->sexo=$sexo;
        $this->fdnac= $fdnac;
        $this->foto= $foto;
        $this->email= $email;
        $this->redsoc= $redsoc;
        $this->especialidad= $especialidad;
        $this->conexion = new conexion();
    }
public function setnombre($nom){
    $this->nombre = $nom;
}
public function getnombre(){
    return $this->nombre;
}
public function setdni($d){
    $this->dni= $d;
}
public function getdni(){
    return  $this->dni;
}
public function setcelular($cel){
    $this->celular= $cel;
}
public function getcelular(){
    return  $this->celular;
}
public function setdireccion($dir){
    $this->direccion= $dir;
}
public function getdireccion(){
    return $this->direccion;
}
public function setsexo($sx){
    $this->sexo= $sx;
}
public function getsexo(){
    return  $this->sexo;
}
public function setfdnac($fdn){
    $this->fdnac= $fdn;
}
public function getfdnac(){
    return $this->fdnac;
}
public function setfoto($ft){
    $this->foto= $ft;
}
public function getfoto(){
    return $this->foto;
}
public function setemail($em){
    $this->email= $em;
}
public function getemail(){
    return $this->email;
}
public function setredsoc($rs){
    $this->redsoc= $rs;
}
public function getredsoc(){
    return $this->redsoc;
}
public function setespecialidad($esp){
    $this->especialidad= $esp;
}
public function getespecialidad(){
    return $this->especialidad;
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
    $sql="CREATE TABLE profesores(id_prof integer auto_increment,
        nombre varchar(40) NOT NULL,
        dni bigint(8) NOT NULL,
        celular bigint(10) NOT NULL,
        direccion varchar(80),
        sexo varchar(1) NOT NULL default 'M',
        fdnac date NOT NULL,
        foto longblob,
        email blob,
        redsoc blob,
        especialidad varchar(40),
        PRIMARY KEY (id_prof));";
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
            $sql = "INSERT INTO profesores (nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,especialidad) VALUES 
            ('".$this->nombre ."','".$this->dni ."','".$this->celular."','".$this->direccion."','".$this->sexo."','".$this->fdnac."','".$this->foto."','".$this->email."','".$this->redsoc."','".$this->especialidad."');";
            
            if ($conn->query($sql) === TRUE) {
                return  " ";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_prof){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_prof,nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,especialidad FROM profesores where id_prof=" . $id_prof ;
    $result = $conn->query($sql);
    
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
           $this->nombre = $row["nombre"];
           $this->dni = $row["dni"];
           $this->celular = $row["celular"];
           $this->direccion = $row["direccion"]; 
           $this->sexo= $row["sexo"];
           $this->fdnac = $row["fdnac"];
           $this->foto = $row["foto"];
           $this->email = $row["email"];
           $this->redsoc = $row["redsoc"];
           $this->especialidad = $row["especialidad"];
        }
    } 
    $conn->close();
}


public function modificar($id_prof){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_prof FROM profesores where id_prof=".$id_prof.";" ;
    $result = $conn->query($sql);       
    $sql = "UPDATE profesores SET nombre='".$this->nombre."',dni='".$this->dni."',celular='".$this->celular."',direccion='".$this->direccion."',sexo='".$this->sexo."',fdnac='".$this->fdnac."',foto='".$this->foto."',email='".$this->email."',redsoc='".$this->redsoc."',especialidad='".$this->especialidad."' WHERE id_prof=".$id_prof;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $this->nombre = $row["nombre"]; 
           $this->dni = $row["dni"];
           $this->celular = $row["celular"];
           $this->direccion = $row["direccion"]; 
           $this->sexo = $row["sexo"];
           $this->fdnac = $row["fdnac"]; 
           $this->foto = $row["foto"];
           $this->email = $row["email"];
           $this->redsoc = $row["redsoc"];
           $this->especialidad = $row["especialidad"];
        }
    } 
    $conn->close();
}
public function borrar($id_prof){
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(),
      $this->conexion->getpassword(),
       $this->conexion->getdbname());
            
    $sql = "DELETE FROM profesores WHERE id_prof='".$id_prof."';";
    $result = $conn->query($sql);
    $conn->close();
}


public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_prof,nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,especialidad FROM profesores";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;

}
}
?>
