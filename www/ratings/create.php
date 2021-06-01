<?php
    include('../common/query.php');

    $db = db();

    $description=   $_POST['exampleFormControlTextarea1'];
    $value=         $_POST['inlineRadioOptions'];
    $userID=        $_POST['author_id'];
    $recipeID=      $_POST['recipe_id'];

    $sql = "INSERT INTO `Rating`(`value`, `recipe_id`, `user_id`, `description`) VALUES ($value, $recipeID, $userID, '$description')";

    try {
        $result = query($db, $sql);
        header("Location: /recipes/show?id=$recipeID");
        exit();
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        header("Location: /?error_message=$error_message");
	    exit();
    }
?>

