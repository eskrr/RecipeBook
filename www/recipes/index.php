<?php
	include '../common/query.php';
	include "../common/session.php";

	$user = getSession();

	if (!$user) {
		$error_message = "Please log in.";
		header("Location: /log_in?error_message=$error_message");
		exit();	
	}

	$db = db();

	$consulta = "SELECT Recipe.id, Recipe.name, Recipe.created_at, Recipe.description, User.name AS 'author_name', AVG(Rating.value) AS rating FROM Recipe INNER JOIN User ON Recipe.author_id = User.id LEFT JOIN Rating ON Rating.recipe_id = Recipe.id GROUP BY Recipe.id";

	try {
		$result = query($db, $consulta);
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
		<script src="https://unpkg.com/feather-icons"></script>
		<title>RecipeBook</title>
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/recipes/index">RecipeBook</a>
				<div class="d-flex">
					<a href="/user/show?id=<?php echo $user['id'] ?>">	
						<img src="<?php echo $user['image_url'] ?>" class="profile-pic border rounded-circle">
					</a>
					<a class="nav-link nav-item mt-2" href="/log_out">Log out</a>
				</div>
			</nav>
			<?php if (isset($_GET['error_message'])): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $_GET['error_message'] ?>
				</div>
			<?php endif; ?>
			<?php if (isset($_GET['success_message'])): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $_GET['success_message'] ?>
				</div>
			<?php endif; ?>
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
								<div class="w-100">
									<div class="d-flex flex-row w-100">
										<a href="/recipes/show?id=<?php echo $row['id']; ?>">
											<h3 id="recipeName"><?php echo $row['name']; ?></h3>
										</a>
										<div class="ml-auto mr-4">
											<?php for ($i=0; $i < floor($row["rating"]); $i++): ?>
												<i data-feather='star' fill="yellow" class="text-yellow"></i>
											<?php endfor; ?>
										</div>
									</div>
									<strong>By: <span id="recipeAuthorName"><?php echo $row['author_name']; ?></span></strong><br>
									<small id="recipeCreatedAt"><?php echo $row['created_at']; ?></small>
								</div>
							</div>
							<p class="m-2" id="recipeDescription"><?php echo $row['description'] ; ?></p>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</main>
	</body>
	<script>
      feather.replace()
    </script>
</html>
