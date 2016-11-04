<?php
	//	/extensions/MySQLExtension.php
	//	takes the contoller for MySQL and MariaDB

	function db_insert($table, $data) {
		$columns = "";
		$values = "";
		foreach($data as $key => $value) {
			$columns .= $key.", ";
			$values .= "'".$value."', ";
		}

		$columns = substr($columns, 0, -2);
		$values = substr($values, 0, -2);

		$query = "INSERT INTO ".$table."(".$columns.") VALUES (".$values.")";
		mysql_query($query);
	}

	function select($table, $options = false) {

		$sql = '';

		mysql_query("SET NAMES utf8");

		$sql = 'SELECT * FROM '.$table;

		if(is_array($options)) {
			$sql = $sql . ' WHERE '.key($options).' = "'.$options[key($options)].'"';
		}

		$result = mysql_query($sql);
		$result = mysql_to_array($result);

		return $result;

	}

	function db_update() {


	}

	function delete($table = null, $options = false) {

		$sql = 'DELETE FROM ' . $table;

		if(is_array($options)) {
			$sql = $sql . ' WHERE '.key($options).' = "'.$options[key($options)].'"';
			$result = mysql_query($sql);
		} else {
			return false;
		}

		return true;
	}

	function last_record($table) {
		$sql = 'SELECT * FROM urls ORDER BY id DESC LIMIT 1';
		$result = mysql_query($sql);
		$result = mysql_to_array($result);
		echo mysql_error();
		return $result;
	}
?>