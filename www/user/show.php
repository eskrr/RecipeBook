<?php if(isset($_GET['id'])): ?>
<?php
	include "../common/query.php";
	include "../common/session.php";

	$currentUser = getSession();

	if (!$currentUser) {
		$error_message = "Please log in.";
		header("Location: /log_in?error_message=$error_message");
		exit();	
	}

	$auxId = $_GET['id'];

	$db = db();
	$q = "SELECT * FROM User WHERE id = $auxId";

	try {
		$userResult = query($db, $q);		
	} catch (Exception $e) {
		header("Location: /?error_message=$e->getMessage()");
		exit();
	}

	if (!($user = $userResult->fetch_assoc())) {
		$error_message = "Url invalido.";
		header("Location: /?error_message=$error_message");
		exit();	
	}

	$consulta = "SELECT Recipe.id, Recipe.name, Recipe.created_at, Recipe.description, Recipe.author_id FROM Recipe WHERE Recipe.author_id = $auxId";

	try {
		$recipesResult = query($db, $consulta);
	} catch (Exception $e) {
		$error_message = $e->getMessage();
		header("Location: /?error_message=$error_message");
		exit();	
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
	</head>
	<body class="bgcolor-secondary">
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/recipes/index">RecipeBook</a>
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
			<div id="userProfile" class="p-4">
				<div class="border border-white rounded p-4 w-100 d-flex">
					<div class="w-25">
						<img src="<?php echo $user['image_url'] ?>" class="img-thumbnail">
					</div>
					<div class="p-4 w-75">
						<h1><?php echo $user['name'] ?></h1>
						<a href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a>
						<p class="mt-4"><?php echo $user['description'] ?></p>
					</div>
				</div>
			</div>
			<div id="userRecipes" class="p-4">
				<div class="d-flex flex-row">
					<h2> Recipes </h2>
					<?php if($currentUser['id'] == $user['id']): ?>
						<a class="btn btn-primary ml-4" href="/recipes/create" role="button">Create</a>
					<?php endif; ?>
				</div>
				<?php while ($recipe = $recipesResult->fetch_array()): ?>
					<div class="mt-4">
						<div  class="border border-white rounded p-4 w-50 d-flex flex-row justify-content-between">
							<a href="/recipes/show?id=<?php echo $recipe['id']; ?>">
								<h3><?php echo $recipe['name']; ?></h3>
							</a>
							<div>
								<?php if($currentUser['id'] == $user['id']): ?>
									<form action="/recipes/delete" method="post" style="margin:0px; padding:0px; display:inline;">
										<input type="hidden" id="recipe_id" name="recipe_id" value="<?php echo $recipe['id'] ?>" onsubmit="return confirm('Are you sure?');">
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
									<a class="btn btn-success" href="/recipes/edit?id=<?php echo $recipe['id'] ?>" role="button">Edit</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
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