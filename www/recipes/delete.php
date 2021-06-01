<?php
	include ("../common/query.php");

	$recipe_id = $_POST['recipe_id'];

	$db = db();
	$q = "DELETE FROM Recipe WHERE id = $recipe_id";

	try {
		$result = query($db, $q);
	} catch (Exception $e) {
		$error_message = $e->getMessage();
		header("Location: /?error_message=$error_message");
		exit();	
	}
	$msg = "Recipe deleted successfully";
	header("Location: /recipes/index?success_message=$msg");
	exit();	
?>