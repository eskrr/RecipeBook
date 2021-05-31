<?php
	$mysqli = new mysqli("db", "root", "test", "RecipeBook");
	if ($mysqli->connect_errno) {
	    echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$q = 'SELECT email, password FROM User WHERE email = "2@gmail.com"';

	echo hash('sha256', 'password');

	$resultado = $mysqli->query($q)
		// while ($fila = $resultado->fetch_assoc()) {
	 //        printf ("%s (%s)\n", $fila["email"], $fila["password"]);
	 //    }
	 //    /* liberar el conjunto de resultados */
	 //    $resultado->close();
	return $resultado;
?>
