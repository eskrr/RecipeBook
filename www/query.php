<?php
	function query() {
		$mysqli = new mysqli("db", "root", "test", "RecipeBook");
		if ($mysqli->connect_errno) {
		    // echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		    return false;
		}

		$q = 'SELECT email, password FROM User WHERE email = "2@gmail.com"';

		$resultado = $mysqli->query($q);
			// while ($fila = $resultado->fetch_assoc()) {
		 //        printf ("%s (%s)\n", $fila["email"], $fila["password"]);
		 //    }
		 //    /* liberar el conjunto de resultados */
		 //    $resultado->close();
		return $resultado;
	}
?>