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
			'stampy'
		);	
		if ($this->conection->connect_errno) {
			return false;
        }
        return true;
    }

    protected function executeQuery($query) {
        if ($this->conection->query($query)) {
            return true;
        }		
        return false;        
    }

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

?>