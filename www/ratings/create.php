<?php
include('../query.php');

    $description=   $_POST['exampleFormControlTextarea1'];
    $value=         $_POST['inlineRadioOptions'];
    $userID=        $_POST['author_id'];
    $recipeID=      $_POST['recipe_id'];

    $sql = "INSERT INTO `Rating`(`value`, `recipe_id`, `user_id`, `description`) VALUES ($value, $recipeID, $userID, '$description')";

    echo $sql;

    try {
        $result = query($sql);
        header("Location: /recipes/show?id=$recipeID");
        exit();
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        header("Location: /?error_message=$error_message");
	    exit();
    }

?>

