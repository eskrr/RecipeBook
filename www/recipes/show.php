<?php if(isset($_GET['id'])): ?>
<?php
	include("../common/query.php");
	include "../common/session.php";

	$user = getSession();

	if (!$user) {
		$error_message = "Please log in.";
		header("Location: /log_in?error_message=$error_message");
		exit();	
	}

	$db = db();
	
	//Declaración de variables
	$auxId = $_GET['id'];
	$queryRecipe = "SELECT Recipe.author_id, Recipe.id, Recipe.name, Recipe.created_at, Recipe.description, User.name AS 'author_name' FROM Recipe INNER JOIN User ON Recipe.author_id = User.id where Recipe.id = $auxId";
	$receta = array();
	$autor = array();
	$ingredientes = array();
	$pasos = array();

	$db = db();

	//Query para receta
	try {
		$recipe = query($db, $queryRecipe);
		
	} catch (Exception $e) {
		header("Location: /?error_message=$e->getMessage()");
		exit();
	}
	if($fila = $recipe->fetch_assoc()){
		$receta = $fila;
	} else {
		$error_message = "Recipe not found.";
		header("Location: /?error_message=$error_message");
		exit();
	}

	//Query para ingredientes
	$queryIngredients = "SELECT * FROM Ingredient where recipe_id=".$receta["id"];
	try {
		$ingredients = query($db, $queryIngredients);
		
	} catch (Exception $e) {
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
	$querySteps = "SELECT * FROM Step where recipe_id=".$receta["id"];
	try {
		$steps = query($db, $querySteps);
		
	} catch (Exception $e) {
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
	$queryRatings = "SELECT Recipe.created_at, Rating.description, User.name AS 'author_name', Rating.value AS rating FROM Recipe INNER JOIN User ON Recipe.author_id = User.id INNER JOIN Rating ON Rating.recipe_id = Recipe.id where Recipe.id = $auxId";
	try {
		$ratings = query($db, $queryRatings);
		
	} catch (Exception $e) {
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}

	$db->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="/css/application.css">
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
		</header>
		<main class="m-4">
			<div class="d-flex">
				<a id="recipeAuthorImage">
					<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle m-4">
				</a>
				<div class="">
					<div class="d-flex flex-row justify-content-between">
						<h1 id="recipeName"><?php echo $receta["name"]; ?></h1>
						<?php if($user['id'] == $receta['author_id']): ?>
							<form action="/recipes/delete" method="post" style="margin:0px; padding:0px; display:inline;">
								<input type="hidden" id="recipe_id" name="recipe_id" value="<?php echo $receta['id'] ?>" onsubmit="return confirm('Are you sure?');">
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						<?php endif; ?>
					</div>
					<strong>By: <?php echo $receta["author_name"]; ?><span id="recipeAuthorName"></span></strong><br>
					<small id="recipeCreatedAt"><?php echo $receta["created_at"]; ?></small>
				</div>
			</div>
			<p class="mt-5" id="recipeDescription"></p>
			<h3>Ingredients:</h3>
			<ul id="recipeIngredients">
			<?php while ($row = $ingredients->fetch_array()): ?>
				<li><strong><?php echo $row["name"]; ?></strong>: <?php echo $row["quantity"]," ",$row["unit"]; ?></li>
			<?php endwhile; ?>
			</ul>
			<h3>Steps:</h3>
			<ol id="recipeSteps">
			<?php while ($row = $steps->fetch_array()): ?>
					<div class="d-flex mt-4 ingredient">
						<li id="stepDescription">
							<?php echo $row["description"]; ?>
						</li>
						<?php if (strlen($row["image_url"]) > 0): ?>
							<div id="stepImage">
							<img class="step-image border rounded m-4" src="<?php echo $row['image_url']; ?>">

							</div>
						<?php endif; ?>
					</div>
			<?php endwhile; ?>
			</ol>
			<?php while ($row = $ratings->fetch_array()): ?>
						<div class="border border-white rounded w-100 mt-4 p-2">
							<div class="d-flex">
								<a id="recipeAuthorImage">
									<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle m-4">
								</a>
								<div class="w-100">
									<div class="d-flex flex-row w-100">
									<div class="ml-auto mr-4">
										<?php for ($i=0; $i < floor($row["rating"]); $i++): ?>
											<i data-feather='star' fill="yellow" class="text-yellow"></i>
										<?php endfor; ?>
									</div>
									</div>
									<strong>By: <span><?php echo $row['author_name']; ?></span></strong><br>
									<small id="recipeCreatedAt"><?php echo $row['created_at']; ?></small>
								</div>
							</div>
							<p class="m-2" id="recipeDescription"><?php echo $row['description'] ; ?></p>
							
							
						</div>
					<?php endwhile; ?>
			<form class="border border-light p-4 mt-5" action="/ratings/create.php" method="post">
				<input type="hidden" name="author_id" id="author_id" value="<?php echo $user['id'];?>">
				<input type="hidden" name = "recipe_id" id="recipe_id" value="<?php echo $auxId; ?>">
				<h3>Leave a Rating</h3>
				<h2 id = "confirmationRating"></h2>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Description: </label>
					<textarea class="form-control" name="exampleFormControlTextarea1" id="exampleFormControlTextarea1" rows="3"></textarea>
				  </div>
				<label for="nombre">Rating: </label><br>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
					<label class="form-check-label" for="inlineRadio1">1</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
					<label class="form-check-label" for="inlineRadio2">2</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
					<label class="form-check-label" for="inlineRadio2">3</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
					<label class="form-check-label" for="inlineRadio2">4</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5" checked>
					<label class="form-check-label" for="inlineRadio2">5</label>
				</div>
				<div class="center">
					<button type="submit" class="btn btn-primary mt-2", id = "buttonRating">Submit</button>
				</div>
			</form>
			
		</main>
	</body>
	<template id="stepTemplate">
		<div class="d-flex mt-4 ingredient">
			<li id="stepDescription">
			</li>
			<div id="stepImage">
			</div>
		</div>
	</template>
	<script>
      feather.replace()
    </script>
</html>
<?php else: ?>
<?php
	$error_message = "Url invalido.";
	header("Location: /?error_message=$error_message");
	exit();
?>
<?php endif; ?>