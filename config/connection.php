<?php
Class Connection {
    private  $server ;
    private  $user ;
    private  $pass ;
    private $options ;
    public $con;
function __construct()
{
    $this->server="mysql:host=localhost;dbname=rustenburg_db";
    $this->user="root";
    $this->pass="";
    $this->options=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
}
    public function openConnection()
    {
        try
        {
            $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
            return $this->con;
        }
        catch (PDOException $e)
        {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }
    public function closeConnection() {
        $this->con = null;
    }
}
