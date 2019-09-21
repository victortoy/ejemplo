<?php
require_once 'database.php';

class baseCrud{
	protected $tabla;

	public function select($datos){
		$db = new database();
		return $db->select($this->tabla,$datos);
	}
}