<?php
class conexion{
    private $servername ;
    private $username ;
    private $password;
    private $dbname;

    public function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "rootroot";
        $this->dbname = "institutocea";
    }

    public function getservername(){
        return $this->servername;
    }

    public function getusername(){
        return $this->username;
    }
    
    public function getpassword(){
        return $this->password;
    }
    
    public function getdbname(){
        return $this->dbname;
    }
    
}
?>