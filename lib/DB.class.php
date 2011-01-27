<?php

class DB extends PDOException {
	
	public static $instance;
	
	public static function connect($host, $usuario, $senha, $db ){
		
        if(!isset(self::$instance)){
			try {
				self::$instance = new PDO("mysql:host=$host;dbname=$db", $usuario, $senha);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$instance;
			
	}
	
	public function disconnect() {
        
		//return @mysql_close($this->_dbHandle) != 0;
    }

    public function getParse(){
        return DbYaml::getParse();
    }
	   
}

?>
