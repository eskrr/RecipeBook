<?php if(isset($_GET['id'])): ?>
	<?php
		include("../query.php");
		//echo 'si HAY ID: ', $_GET['id'];
		
		//Declaración de variables
		$auxId = $_GET['id'];
		$queryRecipe = "SELECT Recipe.id, Recipe.name, Recipe.created_at, Recipe.description, User.name AS 'author_name' FROM Recipe INNER JOIN User ON Recipe.author_id = User.id where Recipe.id = $auxId";
		$receta = array();
		$autor = array();
		$ingredientes = array();
		$pasos = array();

		//Query para receta
		try {
			$recipe = query($queryRecipe);
			
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		if($fila = $recipe->fetch_assoc()){
			$receta = $fila;
		}

		//Query para ingredientes
		$queryIngredients = "SELECT * FROM Ingredient where recipe_id=".$receta["id"];
		try {
			$ingredients = query($queryIngredients);
			
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		$querySteps = "SELECT * FROM Step where recipe_id=".$receta["id"];
		try {
			$steps = query($querySteps);
			
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="/css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/show.js"></script>
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
				<a id="recipeAuthorImage">
					<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle m-4">
				</a>
				<div class="">
					<h1 id="recipeName"><?php echo $receta["name"]; ?></h1>
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
			<form class="border border-light p-4 mt-5">
				<input type="hidden" id="author_id">
				<h3>Leave a Rating</h3>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Description: </label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				  </div>
				<label for="nombre">Rating: </label><br>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
					<label class="form-check-label" for="inlineRadio1">1</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">2</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">3</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">4</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">5</label>
				</div>
				<div class="center">
					<button type="submit" class="btn btn-primary mt-2">Submit</button>
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
</html>
<?php else: ?>
	<?php
		header("Location: /home.html");
		exit();
	?>
<?php endif; ?>