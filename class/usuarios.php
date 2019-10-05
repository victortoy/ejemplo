<?php
require_once 'database.php';
require_once 'baseCrud.php';

class usuarios extends baseCrud{
	protected $tabla = 'usuarios';

	public function select($datos){
		$datos['password'] = md5($datos['password']);
		return parent::select($datos);
	}
}