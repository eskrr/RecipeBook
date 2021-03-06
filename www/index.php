<?php
	include 'common/session.php';
	$user = getSession();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>RecipeBook</title>
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/">RecipeBook</a>
				<div class="d-flex">
					<?php if ($user): ?>
						<a href="/user/show?id=<?php echo $user['id'] ?>">
							<img src="<?php echo $user['image_url'] ?>" class="profile-pic border rounded-circle">
						</a>
						<a class="nav-link nav-item mt-2" href="/log_out">Log out</a>
					<?php else: ?>
						<a class="nav-link nav-item" href="/sign_up">Sign up</a>
						<a class="nav-link nav-item" href="/log_in">Log in</a>
						<a class="nav-link nav-item" href="/about">About</a>
					<?php endif; ?>
				</div>
			</nav>
			<?php if (isset($_GET['error_message'])): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $_GET['error_message'] ?>
				</div>
			<?php endif; ?>
		</header>
		<main class="m-4 text-center">
			<h1 id="titleHome">??Cocina las mejores recetas, cuando quieras!</h1>
			<div class="secciones">
				<div class="container border rounded" style="background-color:#A593BA;">
					<div class="titleAndSubtitle">
						<h2>
							Busca una receta f??cil y sencillo!
						</h2>
						<br>
						<p>
							Ingresa a la p??gina para encontrar nuevas recetas para poder expandir tus conocimientos culinarios.
						</p>
					</div>
					<div>
						<img src="images/firstImg.jpeg" alt="Foto varias recetas" title="Foto varias recetas" class="imgHome"/>
					</div>
				</div>
				<div class="container border rounded" style="background-color:#B993BA;">
					<div class="titleAndSubtitle">
						<h2>
							Aprende a cocinar recetas faciles y sencillas!
						</h2>
						<br>
						<p>
							Aprende a cocinar con recetas con pasos sencillos, paso a paso y recetas claras.
						</p>
					</div>
					<div>
						<img src="images/aprenderCocinar.jpeg" alt="Aprende a cocinar" title="Aprende a cocinar" class="imgHome"/>
					</div>
				</div>
			</div>
			<div class="secciones">
				<div class="container border rounded" style="background-color:#905C6E;">
					<div class="titleAndSubtitle">
						<h2>
							Toda la variedad de recetas
						</h2>
						<br>
						<p>
							Desde una hamburgesa "tapa artereas", hasta una deliciosa ensalada."
						</p>
					</div>
					<div>
						<img src="images/ensalada.jpeg" alt="Foto ensalada" title="Foto ensalada" class="imgHome"/>
					</div>
				</div>
				<div class="container border rounded"  style="background-color:#F5EFF1;">
					<div class="titleAndSubtitle">
						<h2>
							Recetas guardadas generaciones y generaciones a tu disposicion.
						</h2>
						<br>
						<p>
							Recuerdas el famoso sazon de la abuela, bueno aqui podras encontrar esas recetas tan especiales.
						</p>
					</div>
					<div>
						<img src="images/hotdog.jpeg" alt="Foto hot dog" title="Foto hot dog" class="imgHome"/>
					</div>
				</div>
			</div>
			
		</main>
	</body>
	<footer id="footerId">
		<br>
            Copyright &copy; 2020-2021 RecipeBook - Todos los derechos reservados
	</footer>
</html>