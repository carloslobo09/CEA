<?php
include ("conexion.php");
class alumnos{
    protected $nombre;
    protected $dni;
    protected $celular;
    protected $direccion;
    protected $sexo;
    protected $fdnac;
    protected $foto;
    protected $email;
    protected $redsoc;
    protected $id_cur;
    protected $triggxcuo;
    
    function __construct($nombre,$dni,$celular,$direccion,$sexo,$fdnac,$foto,$email,$redsoc,$id_cur,$triggxcuo){
        $this->nombre = $nombre;
        $this->dni=$dni;
        $this->celular= $celular;
        $this->direccion= $direccion;
        $this->sexo=$sexo;
        $this->fdnac= $fdnac;
        $this->foto= $foto;
        $this->email= $email;
        $this->redsoc= $redsoc;
        $this->id_cur = $id_cur;
        $this->triggxcuo = $triggxcuo;
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
public function setid_cur($ic){
    $this->id_cur = $ic;
}
public function getid_cur(){
    return $this->id_cur;
}   
public function settriggxcuo($icg){
    $this->triggxcuo = $icg;
}
public function gettriggxcuo(){
    return $this->triggxcuo;
}  

public function conectar(){
    $conn= new mysqli($this->conexion->getservername(), $this->conexion->getusername(), $this->conexion->getpassword());
    if($conn->connect_error){
        echo "Fallo la conexion" . $conn->connect_error;
    }
    else{
        echo "";
    }
    
        $sql="CREATE DATABASE institutocea";
    if(mysqli_query( $conn,$sql)){
        echo "Base de datos creada";
    }
    else{
        echo "";
    }
    }
public function creartb(){
    $conn= new mysqli($this->conexion->getservername(), $this->conexion->getusername(), $this->conexion->getpassword(), $this->conexion->getdbname());
    $sql="USE institutocea";
    $sql="CREATE TABLE IF NOT EXISTS alumnos(id_alum integer auto_increment,
        nombre varchar(40) NOT NULL,
        dni bigint(8) NOT NULL,
        celular bigint(10) NOT NULL,
        direccion varchar(80),
        sexo varchar(1) NOT NULL default 'M',
        fdnac date NOT NULL,
        foto longblob,
        email blob,
        redsoc blob,
        id_cur integer(5) NOT NULL,
        triggxcuo integer(3) NOT NULL,
        FOREIGN KEY (id_cur) REFERENCES cursos (id_cur) on delete cascade,
        PRIMARY KEY (id_alum));";
    if($conn->query($sql)===true){
       echo "";
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
            $sql ="INSERT INTO alumnos (nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,id_cur,triggxcuo) VALUES 
            ('".$this->nombre ."','".$this->dni ."','".$this->celular."','".$this->direccion."','".$this->sexo."','".$this->fdnac."','".$this->foto."','".$this->email."','".$this->redsoc."','".$this->id_cur."','".$this->triggxcuo."');";
            
            if ($conn->query($sql) === TRUE) {
                return  "";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_alum){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_alum,nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,id_cur,triggxcuo FROM alumnos where id_alum=" . $id_alum ;
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
           $this->id_cur = $row["id_cur"];
           $this->triggxcuo = $row["triggxcuo"];
        }
    } 
    $conn->close();
}
public function getbyidmayor(){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT max(id_alum) as 'maxid' from alumnos";
    $result = $conn->query($sql);
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
            $id=$row["maxid"];
            return $id;
        }}
}


public function modificar($id_alum){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_alum FROM alumnos where id_alum=".$id_alum.";" ;
    $result = $conn->query($sql);       
    $sql = "UPDATE alumnos SET nombre='".$this->nombre."',dni='".$this->dni."',celular='".$this->celular."',direccion='".$this->direccion."',sexo='".$this->sexo."',fdnac='".$this->fdnac."',foto='".$this->foto."',email='".$this->email."',redsoc='".$this->redsoc."',id_cur='".$this->id_cur."',triggxcuo='".$this->triggxcuo."' WHERE id_alum=".$id_alum;
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
           $this->id_cur = $row["id_cur"];
           $this->triggxcuo = $row["triggxcuo"];
        }
    } 
    $conn->close();
}
public function borrar($id_alum){
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(),
      $this->conexion->getpassword(),
       $this->conexion->getdbname());
            
    $sql = "DELETE FROM alumnos WHERE id_alum='".$id_alum."';";
    $result = $conn->query($sql);
    $conn->close();
}


public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_alum,nombre,dni,celular,direccion,sexo,fdnac,foto,email,redsoc,id_cur,triggxcuo FROM alumnos";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;

}

// public function activar($id_alum){
//     $conn = new mysqli( $this->conexion->getservername(),
//      $this->conexion->getusername(),
//       $this->conexion->getpassword(),
//        $this->conexion->getdbname());      
//     $sql = "UPDATE alumnos SET foto= 1  WHERE id_alum=".$id_alum;
//     $result = $conn->query($sql); 
//     $conn->close();
// }
// public function desactivar($id_alum){
//     $conn = new mysqli( $this->conexion->getservername(),
//      $this->conexion->getusername(),
//       $this->conexion->getpassword(),
//        $this->conexion->getdbname());      
//     $sql = "UPDATE alumnos SET foto= 0  WHERE id_alum=".$id_alum;
//     $result = $conn->query($sql); 
//     $conn->close();
// }
}


?>
