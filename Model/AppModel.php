<?php

/**
 * Class AppModel
 * 
 * @Description Here the useful processes to all the tables are defined.
 * 
 */
class AppModel
{
    /**
     * executeQuery
     * @param $query
     */
    protected $conection;

    /**
     * This recovers the connection to the database
     * 
     */
	protected function getConection() {
        $this->conection = new mysqli(
            'localhost',
			'root',
			'pagos123',
			'stampy'
		);	
		if ($this->conection->connect_errno) {
			return false;
        }
        return true;
    }

    /**
     * This runs a query against the database
     * 
     */
    protected function executeQuery($query) {
        if ($this->conection->query($query)) {
            return true;
        }		
        return false;        
    }

    /**
     * This retrieves the data based on a query
     * 
     */
    protected function getData($query) {
        $result = $this->conection->query($query);
		if ($result) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				foreach ($row as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
            }
            return $data;
        }
        return [];
        
	}
}
