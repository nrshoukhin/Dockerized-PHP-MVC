<?php

class Model extends Database{

	private $sql = '';
	private $bindings = array();

	public function fetchAll( $data = array() ){

		if( empty($data) ){
			$this->sql .= "SELECT * FROM $this->tablename";
		}else{
			$this->sql .= "SELECT ".implode(',', $data)." FROM $this->tablename";
		}

		//return $this->query($this->sql);

	}

	public function where( $whereConditions = array() ){

		$whereClause = '';

		if (!empty($whereConditions)) {
		  	$whereClause = ' WHERE ';
		  	$conditions = array();

		  	foreach ($whereConditions as $column => $value) {
		    	$conditions[] = $column . ' = :' . $column;
		    	$this->bindings[':' . $column] = $value;
		  	}

		  	$whereClause .= implode(' AND ', $conditions);

		  	$this->sql .= $whereClause;
		}

	}

	public function get(){
		return $this->query( $this->sql, $this->bindings );
	}

	public function insert( $data = array() ){

		if( empty($data) ){
			return;
		}

		$columns = implode(', ', array_keys($data));
		$placeholders = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO $this->tablename ($columns) VALUES ($placeholders)";

		return $this->insertQuery($sql, $data);

	}
}