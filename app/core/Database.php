<?php

Class Database
{

	private function connect()
	{
		$string = DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME;
		$con = new PDO($string,DBUSER,DBPASS);
		return $con;
	}

	public function query($query, $data = [])
	{

		$con = $this->connect();

		$stm = $con->prepare($query);

		$check = $stm->execute($data);

		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result;
			}
		}

		return [];
	}

	public function insertQuery($sql, $data = [])
	{

		$con = $this->connect();

		$stmt = $con->prepare($sql);

		// Bind the values to the named placeholders
		foreach ($data as $column => $value) {
		  $stmt->bindValue(':' . $column, $value);
		}

		// Execute the prepared statement
		$stmt->execute();
		
		$lastInsertedId = $con->lastInsertId();

		return $lastInsertedId;
	}
	
}