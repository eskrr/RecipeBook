<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
	<?php
	include 'query.php';

	$query = sprintf('SELECT id, email, password FROM User WHERE email = "%s"', $_POST['email']);

	if ($result = query($query)) {
		echo 'HAY RESULTADO: ';
		if ($row = $result->fetch_assoc()) {
			$pw = hash_hmac('SHA256', $_POST['password'], $_POST['email']);
			//$pw = hash('sha256', $_POST['password']);
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
<?php else: ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>RecipeBook</title>
		<style>
			.center, .form-group, #title {
			  display: flex;
			  justify-content: center;
			  align-items: center;
			}
			form {
				margin: 0 auto; 
				width:250px;
				padding:20px;
			}
		</style>
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/home.html">RecipeBook</a>
				<div class="d-flex">
					<a class="nav-link nav-item" href="/user/create.html">Sign up</a>
					<a class="nav-link nav-item" href="/log_in.html">Log in</a>
					<a class="nav-link nav-item" href="/about.html">About</a>
				</div>
			</nav>
		</header>
		<main class="m-4">
			<form class="border border-light" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
				<h3 class="text-center">RecipeBook</h3>
				<div class="form-group">
				  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email address" required>
				</div>
				<div class="form-group">
				  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
				</div>
				<div class="center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			  </form>
		</main>
	</body>
</html>
<?php endif; ?>