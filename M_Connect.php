<?php

class M_Connect 
{
    private $db; //
    private static $instance;
    
    public static function Instance()
    {
        if(self::$instance == null)        
            self::$instance = new M_Connect();
        return self::$instance;        
    }
    
    function __construct()
    {
        $hostname = 'localhost';
        $db_name = 'testdatabase';
        $user = 'root';
        $pass = '';
        try
        {
            $this->db = new PDO("mysql:host=$hostname;dbname=$db_name",$user,$pass);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()."<br/>";
            die();
        }
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    function __destruct()
    {
        $this->db = null;
        self::$instance = null;
    }
    
    public function query($sql)
    {
        try
        { 
            $result = $this->db->query($sql);            
            while($row = $result->fetch(PDO::FETCH_BOTH))
            {
                $arr[] = $row;
            } 
            return $arr;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()."<br/>";
            die();
        }        
    }
}
