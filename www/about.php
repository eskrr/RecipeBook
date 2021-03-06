<?php
	include "common/session.php";

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
	<body id="imageBG">
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
		</header>
		<main class="m-4">
			<div>
				<h1 id="titleAbout">
					About Us
				</h1>
			</div>
			<div id="infoAbout">
				<div class="divHoriz">
					<h2 class="subTitleAbout">
						Objetivos
					</h2>
					<img src="images/objetivo.jpeg" alt="Objetivo" title="Objetivo" class="objetivoImg">
					<p class="parrAbout">
						Nuestros objetivos principales con este proyecto son: ser un facilitador en la transici??n profesional del estudiante, de una vida familiar a una personal; concientizar por medio de buenos h??bitos alimenticios, acerca de la importancia que tiene una buena nutrici??n en el rendimiento escolar, ya que a veces comer mal sale m??s caro que comer bien; favorecer a que los estudiantes se tomen un tiempo para preparar sus alimentos y que esto les sirva para aclarar sus ideas y despejar su mente de asuntos estudiantiles, esto es un requisito para poder mantener una buena salud mental.
					</p>
				</div>
				<br>
				<div class="divHoriz">
					<h2 class="subTitleAbout">
						Impacto esperado:
					</h2>
					<img src="images/impacto.jpeg" alt="Impacto" title="Impacto" class="objetivoImg">
					<p class="parrAbout">
						Sabemos que este proyecto va a ser de mucha ayuda para todos los estudiantes que est??n comenzando una etapa en la que tienen que aprender a organizar sus tiempos. Esperamos que entre todas las cosas buenas que va a traer nuestro trabajo, podamos mejorar la salud de estudiantes a nivel profesional y postgrado para que aumente su calidad de vida.
						Algo muy relevante que esperamos sea de beneficio para los usuarios es que podamos apoyar la econom??a de los estudiantes, dise??ando un cat??logo de opciones con diferentes rangos de presupuestos. Demostrar que comer bien no es sin??nimo de gastar mucho.
						De igual manera sabemos que es muy importante favorecer que el estudiante pueda emplear su tiempo en cosas productivas y que siempre tenga tiempo para la escuela. Esperamos apoyarlos simplificando la curva de aprendizaje que requieren los buenos h??bitos alimenticios para que les tome el menor tiempo posible el aprender y que comiencen sus carreras profesionales como si ya tuvieran experiencia en estos asuntos.
					</p>
				</div>
			</div>
		</main>
	</body>
	<footer class="text-center my-4">
		Copyright &copy; 2020-2021 RecipeBook - Todos los derechos reservados
	</footer>
</html>