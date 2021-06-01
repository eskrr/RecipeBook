<?php if(isset($_GET['id'])): ?>
	<?php
		echo 'si HAY ID: ', $_GET['id'];

		$RECIPE = array("name" => 'FALAFEL'); // SELECT FROM TABLE WHERE ID = ID
		// $ingerdientes SELECT FROM INGREDIENTES WHERE RECIPE_ID = ID
		// $pasos ... 
		// $usuario ... 1 resultado
		// $RECIPE['name'] = 'FALAFEL';
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
					<h1 id="recipeName"><?php echo $RECIPE['name']; ?></h1>
					<strong>By: <span id="recipeAuthorName"></span></strong><br>
					<small id="recipeCreatedAt"></small>
				</div>
			</div>
			<p class="mt-5" id="recipeDescription"></p>
			<h3>Ingredients:</h3>
			<ul id="recipeIngredients">
			</ul>
			<h3>Steps:</h3>
			<ol id="recipeSteps">
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
		echo 'no hay id redireccionar a home.';
	?>
<?php endif; ?>