
<?php



class DatabaseMop{
  
    
    private $host = "localhost";
    private $db_name = "mopani";
    private $username = "root";
    private $password = "P@ss!123";
   public $conn;
  
 
    public function getConnectionMop(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}

      
?>