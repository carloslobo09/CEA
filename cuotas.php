<?php
include ("conexion.php");
class cuotas{
    protected $id_cuo;
    protected $concepto;
    protected $importe;
    protected $saldo;
    protected $f_pago;
    protected $f_venc;
    protected $estado;
    
    function __construct($id_alum,$concepto,$importe,$saldo,$f_pago,$f_venc,$estado){
        $this->id_alum = $id_alum;
        $this->concepto= $concepto;
        $this->importe=$importe;
        $this->saldo=$saldo;
        $this->f_pago= $f_pago;
        $this->f_venc= $f_venc;
        $this->estado= $estado;
        $this->conexion = new conexion();
    }
public function setid_alum($id_a){
    $this->id_alum = $id_a;
}
public function getid_alum(){
    return $this->id_alum;
}
public function setconcepto($con){
    $this->concepto= $con;
}
public function getconcepto(){
    return $this->concepto;
}
public function setimporte($imp){
    $this->importe= $imp;
}
public function getimporte(){
    return  $this->importe;
}
public function setsaldo($sldo){
    $this->saldo= $sldo;
}
public function getsaldo(){
    return $this->saldo;
}
public function setf_pago($fpag){
    $this->f_pago= $fpag;
}
public function getf_pago(){
    return $this->f_pago;
}
public function setf_venc($fvenc){
    $this->f_venc= $fvenc;
}
public function getf_venc(){
    return $this->f_venc;
}
public function setestado($em){
    $this->estado= $em;
}
public function getestado(){
    return $this->estado;
}

public function conectar(){
    $conn= new mysqli($this->conexion->getservername(), $this->conexion->getusername(), $this->conexion->getpassword());
    if($conn->connect_error){
        echo "Fallo la conexion" . $conn->connect_error;
    }
    else{
        echo "Conectada";
    }
    
        $sql="CREATE DATABASE IF NOT EXISTS institutocea";
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
    $sql="CREATE TABLE IF NOT EXISTS cuotas(id_cuo bigint auto_increment,
    id_alum integer(11) NOT NULL,
    concepto varchar(12) NOT NULL,
    importe decimal(10,2) NOT NULL,
    saldo decimal(10,2) NOT NULL,
    f_pago date NOT NULL,
    f_venc date NOT NULL,
    estado tinyint (1) default '1' NOT NULL,
    FOREIGN KEY (id_alum) REFERENCES alumnos(id_alum) on delete cascade,
    PRIMARY KEY (id_cuo));";
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
            $sql = "INSERT INTO cuotas (id_alum,concepto,importe,saldo,f_pago,f_venc,estado) VALUES 
            ('".$this->id_alum."','".$this->concepto."','".$this->importe."','".$this->saldo."',NOW(),'".$this->f_venc."','".$this->estado."');";
            
            if ($conn->query($sql) === TRUE) {
                return  " ";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    $conn->close();
}
public function getbyId($id_cuo){
        
    $conn = new mysqli( $this->conexion->getservername(),
     $this->conexion->getusername(), 
     $this->conexion->getpassword(),
      $this->conexion->getdbname());
            
    $sql = "SELECT id_alum,concepto,importe,saldo,f_pago,f_venc,estado FROM cuotas WHERE id_cuo=".$id_cuo ;
    $result = $conn->query($sql);
    
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()){
           $this->id_alum = $row["id_alum"];
           $this->concepto = $row["concepto"]; 
           $this->importe= $row["importe"];
           $this->saldo = $row["saldo"];
           $this->f_pago = $row["f_pago"];
           $this->f_venc = $row["f_venc"];
           $this->estado = $row["estado"];
        }
    } 
    $conn->close();
}


public function modificar($id_cuo){
    
    $conn = new mysqli( $this->conexion->getservername(), 
    $this->conexion->getusername(), 
    $this->conexion->getpassword(), 
    $this->conexion->getdbname());
    $sql = "SELECT id_cuo FROM cuotas where id_cuo=".$id_cuo.";" ;
    $result = $conn->query($sql);
    $sql = "UPDATE cuotas SET importe='".$this->importe."',saldo='".$this->saldo."',f_pago=NOW(),estado=1 WHERE id_cuo=".$id_cuo;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $this->id_alum = $row["id_alum"];
           $this->concepto = $row["concepto"]; 
           $this->importe = $row["importe"];
           $this->saldo = $row["saldo"];
           $this->f_pago = $row["f_pago"];
           $this->f_venc = $row["f_venc"];
           $this->estado = $row["estado"];
        }
    } 
    $conn->close();
}

public function getLista(){

    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "institutocea";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT id_cuo,nro_cuota,concepto,importe,saldo,f_pago,f_venc,estado FROM cuotas";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;
}

}
?>
