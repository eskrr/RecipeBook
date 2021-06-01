<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../css/application.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
		<script>
			window.onload =  async function getRecipes(){
				let response = await fetch("users.json")
        		let data = await response.json()
				console.log(data)
				var content = "";
				content += `
					<div class="border border-white rounded p-4 w-100 d-flex">
						<div class="w-25">
							<img src="${data.image}" class="img-thumbnail">
						</div>
						<div class="p-4 w-75">
							<h1>${data.name}</h1>
							<p>${data.birthdate}</p> 
							<a href="mailto:${data.email}">${data.email}</a>
							<p class="mt-4">${data.description}</p>
						</div>
					</div>
				`;

				$("#userProfile").append(content);


				content = "";
				$.each(data.recipes, function(index, recipe) {
					console.log(recipe.id);
					content += `
						<div class="mt-4">
						<div  class="border border-white rounded p-4 w-100">
							<a href="/recipes/show.html?id=${recipe.id}">
								<h4 id="recipeName">${recipe.name}</h4>
							</a>
						</div> 
						</div>
					`;
				});

				$("#userRecipes").append($($.parseHTML(content)));
			}
		</script>
	</head>
	<body class="bgcolor-secondary">
		<
		<header class="bgcolor-primary">
			<nav class="navbar navbar-light bgcolor-primary justify-content-between">
				<a class="navbar-brand" href="/recipes/index.html">RecipeBook</a>
				<a href="/user/show.html">
					<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" class="profile-pic border rounded-circle">
				</a>
			</nav>
		</header>
		<main class="m-4">
			<div id="userProfile" class="p-4">
			</div>
			<div id="userRecipes" class="p-4">
				<h2> Recipes </h2>
			</div>
		</main>
	</body>
</html>