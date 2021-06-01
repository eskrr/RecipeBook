
<?php
	include 'query.php';

	$query = sprintf('SELECT id, email, password FROM User WHERE email = "%s"', $_POST['email']);

	if ($result = query('SELECT id, email, password FROM User WHERE email = ')) {
		echo 'HAY RESULTADO';
		if ($row = $result->fetch_assoc()) {
			$pw = hash('sha256', $_POST['password']);
			if ($pw == $row['password'] && $_POST['email'] == $row['email']) {
				echo 'CORRECTO';
				exit();
			}
	       // printf ("%s (%s)\n", $row["email"], $row["password"]);
	    }
		// liberar el conjunto de resultados */
		// $result->close();
	}
	echo 'NO';
?>