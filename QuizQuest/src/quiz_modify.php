<?php

use Fhooe\Router\Router;

require_once("functions.php");

// Modify the given quiz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = connectToDatabase();

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $startedAt = $_POST['startedAt'];
    $closedAt = $_POST['closedAt'];
    $joinCode = $_POST['joinCode'];
    $difficulty = $_POST['difficulty'];
    $category = $_POST['category'];

    // Convert the date strings to a format that the database understands
    $startedAt = date("Y-m-d H:i:s", strtotime($startedAt));
    $closedAt = date("Y-m-d H:i:s", strtotime($closedAt));

    $sql = "UPDATE Quiz SET Title = :title, Category = :category, Difficulty = :difficulty, Description = :description, Status = :status, Joincode = :joinCode,
     StartedAt = :startedAt, ClosedAt = :closedAt, Creator_ID = :userID WHERE ID = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':startedAt', $startedAt);
    $stmt->bindParam(':closedAt', $closedAt);
    $stmt->bindParam(':joinCode', $joinCode);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':userID', $_SESSION['userId']);

    $stmt->execute();

    // Redirect to the quiz_overview.html.twig using the router
    Router::redirectTo('/quizoverview');
}