<?php
require_once 'database.php';

class baseCrud{
	protected $tabla;

	public function select($datos){
		$db = new database();
		return $db->select($this->tabla,$datos);
	}

	public function insert($datos){
		$db = new database();
		return $db->insert($this->tabla,$datos);	
	}

	public function update($datos){
		$db = new database();
		return $db->update($this->tabla,$datos);	
	}
}