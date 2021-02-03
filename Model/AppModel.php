<?php
class AppModel
{
    /**
     * executeQuery
     * @param $query
     */
    protected $conection;

	protected function getConection() {
		$this->conection = new mysqli(
			'localhost',
			'root',
			'pagos123',
			'php_mysql_crud'
		);	
		if ($this->conection->connect_errno) {
			return false;
        }
        return true;
    }

    protected function executeQuery($query) {
        if ($this->conexion->query($query)) {
            return true;
        }		
        return false;        
    }
}

?>