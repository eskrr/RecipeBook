<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
	<?php
		include ("query.php");

		$nombre			= $_POST["nombre"];
		$description	= $_POST["description"];
		$email       	= $_POST["email"];
		$password  		= $_POST["password"];

		$consulta = "INSERT INTO User (`name`, `description`, `email`, `password`) VALUES ('$nombre', '$description', '$email', '$password')";

		try {
			$result = query($consulta);
			if($result)
				echo "<br><br> Datos guardados.";
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}


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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<style>
			.center, #title {
			  display: flex;
			  justify-content: center;
			  align-items: center;
			}
			form {
				margin: 0 auto; 
				width:500px;
				padding:20px;
			}
		</style>
		<title>RecipeBook</title>
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
			<form class="border border-light" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<h1 class="text-center">Register</h1>
				<div class="form-group">
					<label for="nombre">Complete Name</label>
					<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Name(s) Last Name">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" name="description" id="description" placeholder="Something about you...">
				</div>
				<!-- <div>
					<p>Birthdate: <input type="text" id="datepicker"></p>
				</div> -->
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="email_confirmation">Confirm Email address</label>
					<input type="email" class="form-control" id="email_confirmation" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="password_confirmation">Confirm Password</label>
					<input type="password" class="form-control" id="password_confirmation" placeholder="Password">
				</div>
				<!-- <div class="form-group">
					<label for="image">Choose Profile Picture</label>
					<input type="file" accept="image/*" class="form-control-file" id="image">
				</div> -->
				<div class="center">
					<br><br><br><button type="submit" class="btn btn-primary">Submit</button>
				</div>
			  </form>
		</main>
	</body>
	<script type="text/javascript">
		$('#datepicker').datepicker();
	</script>
</html>
<?php endif; ?>