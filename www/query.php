<?php
	function query($q) {
		$mysqli = new mysqli("db", "root", "test", "RecipeBook");
		if ($mysqli->connect_errno) {
		    throw new Exception('Error de conexion a la Base de Datos.');
		}

		$result = $mysqli->query($q);

		if (!$result)
			throw new Exception($mysqli->error);

		$mysqli->close();

		return $result;
	}
?>