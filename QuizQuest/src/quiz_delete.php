<?php

use Fhooe\Router\Router;

require_once("functions.php");

// Delete the quiz with the given id
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = connectToDatabase();

    $id = $_POST['id'];

    // Soft delete the quiz

    $sql = "UPDATE Quiz SET DeletedAt = NOW() WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect to the quiz_overview.html.twig using the router
    Router::redirectTo('/quizoverview');
}

?>
