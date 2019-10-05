<?php
require_once 'database.php';
require_once 'baseCrud.php';

class usuarios extends baseCrud{
	protected $tabla = 'usuarios';

	public function login($datos){
		$datos['password'] = md5($datos['password']);
		return parent::select($datos);
	}

	public function insert($datos){
		$datos['password'] = md5($datos['password']);
		return parent::insert($datos);
	}
}