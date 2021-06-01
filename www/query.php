<?php
	function db() {
		$mysqli = new mysqli("db", "root", "test", "RecipeBook");
		if ($mysqli->connect_errno) {
		    throw new Exception('Error de conexion a la Base de Datos.');
		}

		return $mysqli;
	}

	function query($db, $q) {
		$result = $db->query($q);

		if (!$result)
			throw new Exception($db->error);

		return $result;
	}
?>