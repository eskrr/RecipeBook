<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
<?php
	include ("common/query.php");

	$db = db();

	$nombre			= $_POST["nombre"];
	$description	= $_POST["description"];
	$email       	= $_POST["email"];
	$password  		= $_POST["password"];
	$image_url  		= $_POST["image_url"];

	//Se utiliza el correo como salt para que la encripcion sea unica.
	$hash = hash_hmac('SHA256', $password, $email);

	$consulta = "INSERT INTO User (`name`, `description`, `email`, `password`, `image_url`) VALUES ('$nombre', '$description', '$email', '$hash', '$image_url')";

	try {
		$result = query($db, $consulta);
	} catch (Exception $e) {
		$error_message = $e->getMessage();
		header("Location: /sign_up?error_message=$error_message");
		exit();
	}

	$db->close();
	$success_message = "Usuario creado correctamente.";
	header("Location: /log_in?success_message=$success_message");
	exit();
?>
<?php else: ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
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
		<script>
		function check_pass() {
			const password = document.querySelector('input[name=password]');
			const password_confirmation = document.querySelector('input[name=password_confirmation]');
			if (password_confirmation.value === password.value) {
				password_confirmation.setCustomValidity('');
			} else {
				password_confirmation.setCustomValidity('Passwords do not match');
			}
		}
		</script>
		<script>
		function check_email() {
			const email = document.querySelector('input[name=email]');
			const email_confirmation = document.querySelector('input[name=email_confirmation]');
			if (email_confirmation.value === email.value) {
				email_confirmation.setCustomValidity('');
			} else {
				email_confirmation.setCustomValidity('Emails do not match');
			}
		}
		</script>
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/">RecipeBook</a>
				<div class="d-flex">
					<a class="nav-link nav-item" href="/sign_up">Sign up</a>
					<a class="nav-link nav-item" href="/log_in">Log in</a>
					<a class="nav-link nav-item" href="/about">About</a>
				</div>
			</nav>
			<?php if (isset($_GET['error_message'])): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $_GET['error_message'] ?>
				</div>
			<?php endif; ?>
		</header>
		<main class="m-4">
			<form class="border border-light" id="signUpForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
					<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" onchange='check_email();'>
				</div>
				<div class="form-group">
					<label for="email_confirmation">Confirm Email address</label>
					<input type="email" class="form-control" name="email_confirmation" id="email_confirmation" aria-describedby="emailHelp" placeholder="Enter email" onchange='check_email();'>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" onchange='check_pass();'>
				</div>
				<div class="form-group">
					<label for="password_confirmation">Confirm Password</label>
					<input type="password" class="form-control"  name="password_confirmation" placeholder="Password" onchange='check_pass();'>
				</div>
				<!-- <span id='message'></span> -->
				<div class="form-group">
					<label for="image_url">Image</label>
					<input required type="url" class="form-control" id="image_url" name="image_url" placeholder="www.image.com/image.png">
				</div>
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