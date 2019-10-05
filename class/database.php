<?php

class database extends mysqli{
	private $DB_HOST = 'localhost';
	private $DB_USER = 'root';
	private $DB_PASS = '';
	private $DB_NAME = 'ejemplo';

	public function __construct(){
		parent::__construct($this->DB_HOST,$this->DB_USER,$this->DB_PASS,$this->DB_NAME);
		if(mysqli_connect_errno()){
			printf("Fallo la conexión: %s", mysqli_connect_error());
			exit();
		}

		if(!$this->set_charset("utf8")){
			printf("Fallo utf-8 %s", $this->error);
			exit();
		}
	}

	public function select($tabla, $datos){
		$sql = "SELECT * FROM $tabla WHERE 1";
		foreach ($datos as $key => $value) {
			$sql .= " AND $key = '$value'";
		}
		return $this->ejecutarConsulta($sql);
	}

	public function insert($tabla, $datos){
		$sql = "INSERT INTO $tabla SET ";
		foreach ($datos as $key => $value) {
			$sql .= "$key = '$value',";
		}
		$sql .= "creado_por = 1, fecha_creacion=NOW()";
		return $this->ejecutarConsulta($sql);
	}

	public function update($tabla, $datos){
		$sql = "UPDATE $tabla SET ";
		foreach ($datos as $key => $value) {
			$sql .= "$key = '$value',";
		}
		$sql .= "modificado_por = 1, fecha_modificacion=NOW()";
		$sql .= " WHERE id=$datos[id]";
		return $this->ejecutarConsulta($sql);
	}

	public function ejecutarConsulta($sql){
		$respuesta = [];
		$resultado = $this->query($sql);
		if($resultado === TRUE){
			$respuesta['ejecuto'] = true;
			$respuesta['insertId'] = $this->insert_id;
		}elseif(is_object($resultado)){
			$respuesta['ejecuto'] = true;
			$respuesta['data'] = [];
			while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
				$respuesta['data'][] = $row;
			}
			$resultado->free();
		}else{
			$respuesta['ejecuto'] = false;
			$respuesta['codigoError'] = $this->errno;
			$respuesta['mensajeError'] = $this->error;
		}
		$this->close();
		return $respuesta;
	}
}