<?php
	include '../query.php';

	$consulta = "SELECT Recipe.id, Recipe.name, Recipe.created_at, Recipe.description, User.name AS 'author_name' FROM Recipe INNER JOIN User ON Recipe.author_id = User.id";

	try {
		$result = query($consulta);
	} catch (Exception $e) {
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>RecipeBook</title>
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/recipes/index.html">RecipeBook</a>
				<a href="/user/show.html">
					<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle">
				</a>
			</nav>
		</header>
		<main class="m-4">
			<div class="d-flex">
				<div class="row" id="recipeDisp">
					<?php while ($row = $result->fetch_array()): ?>
						<div class="border border-white rounded w-100 mt-4 p-2">
							<div class="d-flex">
								<a id="recipeAuthorImage">
									<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle m-4">
								</a>
								<div class="">
									<a href="/recipes/show?id=<?php echo $row['id']; ?>">
										<h3 id="recipeName"><?php echo $row['name']; ?></h3>
									</a>
									<strong>By: <span id="recipeAuthorName"><?php echo $row['author_name']; ?></span></strong><br>
									<small id="recipeCreatedAt"><?php echo $row['created_at']; ?></small>
								</div>
							</div>
							<p class="m-2" id="recipeDescription"><?php echo $row['description']; ?></p>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</main>
	</body>
</html>
