<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
	<?php
		include ("../query.php");

		// echo 'CREANDO';

		$nombre			= $_POST["name"];
		$description	= $_POST["description"];

		// echo $nombre, ": ", $description, "\n";

		// echo var_dump($_POST["ingredients"]);

		foreach ($_POST["ingredients"] as &$ingredient) {
		    echo $ingredient['name'], "\n";
		    echo $ingredient['quantity'], "\n";
		    echo $ingredient['unit'], "\n";
		}
		// $email       	= $_POST["email"];
		// $password  		= $_POST["password"];

		// $consulta = "INSERT INTO User (`name`, `description`, `email`, `password`) VALUES ('$nombre', '$description', '$email', '$password')";

		// try {
		// 	$result = query($consulta);
		// 	if($result)
		// 		echo "<br><br> Datos guardados.";
		// } catch (Exception $e) {
		// 	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		// }


	?>
<?php else: ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="/css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://unpkg.com/feather-icons"></script>
		<script src="js/create.js"></script>
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
			<h1>New recipe</h1>
			<form class="m-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" id="author_id" value="">
				<div class="form-group">
					<label for="name">Name</label>
					<input required type="text" class="form-control" id="name" placeholder="Recipe name ..." name="name">
				</div>
				<div class="form-group">
				    <label for="description">Description</label>
				    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
			    </div>
			    <div class="d-flex">
			    	<h3 class="mr-4">Ingredients</h3>
					<i id="addIngredient" data-feather="plus" class="border border-success rounded bg-success text-white clickable"></i>
			    </div>
			    <div id="ingredients">
				    <div class="ingredient border border-light rounded m-4 p-4 d-flex">
				    	<div class="w-50">
							<div class="form-group d-flex">
								<label for="ingredients[0][name]">Name</label>
								<input required type="text" class="form-control ml-4" id="ingredients[0][name]" name="ingredients[0][name]" placeholder="Ingredient name ...">
							</div>
							<div class="form-group d-flex">
								<label for="ingredients[0][quantity]">Quantity</label>
								<input required type="text" class="form-control ml-4" id="ingredients[0][quantity]" name="ingredients[0][quantity]" placeholder="Ingredient Quantity ...">
							</div>
							<div class="form-group d-flex">
								<label for="ingredients[0][unit]">Unit</label>
								<select class="form-control ml-4" id="ingredients[0][unit]" name="ingredients[0][unit]">
									<option>cups</option>
									<option>liters</option>
									<option>grams</option>
									<option>pieces</option>
									<option>kilograms</option>
								</select>
							</div>
						</div>
				    </div>
				</div>
			    <!-- <div class="d-flex">
			    	<h3 class="mr-4">Steps</h3>
					<i id="addStep" data-feather="plus" class="border border-success rounded bg-success text-white clickable"></i>
			    </div>
			    <div id="steps">
				    <div class="step border border-light rounded m-4 p-4">
						<div class="d-flex justify-content-between">
		    				<h4>Step <span class="stepNum">0</span></h4>
						</div>
						<div class="form-group">
						    <label for="description">Description</label>
						    <textarea class="form-control w-100" id="description" rows="3"></textarea>
					    </div>
						<div class="form-group">
							<label for="stepImage">Image</label>
							<input type="file" accept="image/*" class="form-control-file" id="stepImage">
						</div>
				    </div>
				</div> -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</main>
	</body>
	<template id="ingredientForm">
	    <div class="ingredient border border-light rounded m-4 p-4 d-flex">
	    	<div class="w-50">
				<div class="form-group d-flex">
					<label for="ingredientName">Name</label>
					<input required type="text" class="form-control ml-4" id="ingredientName" placeholder="Ingredient name ...">
				</div>
				<div class="form-group d-flex">
					<label for="ingredientQuantity">Quantity</label>
					<input required type="text" class="form-control ml-4" id="ingredientQuantity" placeholder="Ingredient Quantity ...">
				</div>
				<div class="form-group d-flex">
					<label for="ingredientUnit">Unit</label>
					<select class="form-control ml-4" id="ingredientUnit">
						<option>cups</option>
						<option>liters</option>
						<option>grams</option>
						<option>pieces</option>
						<option>kilograms</option>
					</select>
				</div>
			</div>
			<div class="w-50 flex-row-reverse d-flex">
				<i data-feather="trash" class="removeIngredient border border-danger rounded bg-danger text-white clickable"></i>
			</div>
	    </div>
	</template>
	<template id="stepForm">
	    <div class="step border border-light rounded m-4 p-4">
			<div class="d-flex justify-content-between">
		    	<h4>Step <span class="stepNum"></span></h4>
				<i data-feather="trash" class="removeStep border border-danger rounded bg-danger text-white clickable"></i>
			</div>
			<div class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control w-100" id="description" rows="3"></textarea>
		    </div>
			<div class="form-group">
				<label for="stepImage">Image</label>
				<input type="file" accept="image/*" class="form-control-file" id="stepImage">
			</div>
	    </div>
	</template>
	<script>
      feather.replace()
    </script>
</html>
<?php endif; ?>