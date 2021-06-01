<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
<?php
	include ("../common/query.php");

	$db = db();

	$author_id		= $_POST["author_id"];
	$name			= $_POST["name"];
	$description	= $_POST["description"];

	$recipeInsertQ = "INSERT INTO Recipe (author_id, name, description) VALUES ($author_id, '$name', '$description')";

	try {
		query($db, $recipeInsertQ);
	} catch (Exception $e) {
		$error_message = $e->getMessage();
		header("Location: /recipes/create?error_message=$error_message");
		exit();
	}

	$recipe_id = $db->insert_id;

	// foreach ($_POST["ingredients"] as &$ingredient) {
	// 	$name			= $ingredient["name"];
	// 	$quantity		= $ingredient["quantity"];
	// 	$unit			= $ingredient["unit"];

	// 	$ingredientInsertQ = "INSERT INTO Ingredient (recipe_id, name, quantity, unit) VALUES ($recipe_id, '$name', '$quantity', '$unit')";
	// 	try {
	// 		query($db, $ingredientInsertQ);
	// 	} catch (Exception $e) {
	// 		$error_message = $e->getMessage();
	// 		header("Location: /recipes/create?error_message=$error_message");
	// 		exit();
	// 	}
	// }

	// foreach ($_POST["steps"] as &$step) {
	// 	$description	= $step["description"];
	// 	$image_url		= $step["image_url"];

	// 	$ingredientInsertQ = "INSERT INTO Step (recipe_id, description, image_url) VALUES ($recipe_id, '$description', '$image_url')";
	// 	try {
	// 		query($db, $ingredientInsertQ);
	// 	} catch (Exception $e) {
	// 		$error_message = $e->getMessage();
	// 		header("Location: /recipes/create?error_message=$error_message");
	// 		exit();
	// 	}
	// }

	$db->close();
	header("Location: /recipes/show?id=$recipe_id");
	exit();
?>
<?php elseif (isset($_GET['id'])): ?>
<?php
	include "../common/session.php";
	include ("../common/query.php");

	$user = getSession();

	if (!$user) {
		$error_message = "Please log in.";
		header("Location: /log_in?error_message=$error_message");
		exit();	
	}

	$recipe_id = $_GET['id'];

	echo $recipe_id;

	$q = "SELECT * FROM Recipe WHERE id = $recipe_id";
?>
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
		</header>
		<main class="m-4">
			<h1>New recipe</h1>
			<form class="m-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" id="author_id" name="author_id" value="<?php echo $user['id'] ?>">
				<div class="form-group">
					<label for="name">Name</label>
					<input required type="text" class="form-control" id="name" placeholder="Recipe name ..." name="name">
				</div>
				<div class="form-group">
				    <label for="description">Description</label>
				    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
			    </div>
			    <!-- <div class="d-flex">
			    	<h3 class="mr-4">Ingredients</h3>
					<i id="addIngredient" data-feather="plus" class="border border-success rounded bg-success text-white clickable"></i>
			    </div> -->
			    <!-- <div id="ingredients">
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
			    <div class="d-flex">
			    	<h3 class="mr-4">Steps</h3>
					<i id="addStep" data-feather="plus" class="border border-success rounded bg-success text-white clickable"></i>
			    </div>
			    <div id="steps">
				    <div class="step border border-light rounded m-4 p-4">
						<div class="d-flex justify-content-between">
		    				<h4>Step <span class="stepNum">0</span></h4>
						</div>
						<div class="form-group">
						    <label for="steps[0][description]">Description</label>
						    <textarea class="form-control w-100" id="steps[0][description]" rows="3" name="steps[0][description]"></textarea>
					    </div>
						<div class="form-group">
							<label for="steps[0][image_url]">Image</label>
							<input type="url" class="form-control ml-4" id="steps[0][image_url]" name="steps[0][image_url]" placeholder="www.image.com/image.png">
						</div>
				    </div>
				</div> -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</main>
	</body>
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