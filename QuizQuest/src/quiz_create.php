<?php
require_once("functions.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = connectToDatabase();

    // Get the submitted quiz data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $startedAt = $_POST['startedAt'];
    $closedAt = $_POST['closedAt'];
    $userId = $_SESSION['userId'];
    $joinCode = $_POST['joinCode'];
    $difficulty = $_POST['difficulty'];

    // Convert the date strings to a format that the database understands
    $startedAt = date("Y-m-d H:i:s", strtotime($startedAt));
    $closedAt = date("Y-m-d H:i:s", strtotime($closedAt));

    // Create the quiz in the database
    $sql = "INSERT INTO Quiz (Title, Category, Difficulty, Description, Status, Joincode, StartedAt, ClosedAt, Creator_ID) VALUES 
        (:title, :category, :difficulty, :description, :status, :joincode, :startedAt, :closedAt, :userId)";

    $stmt = $pdo->prepare($sql);    
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category', $title);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':joincode', $joinCode);
    $stmt->bindParam(':startedAt', $startedAt);
    $stmt->bindParam(':closedAt', $closedAt);
    $stmt->bindParam(':userId', $userId);

    $stmt->execute();

    // Informing user in case of successful registration in the register.html.twig file
    $twig->display("quiz_modify.html.twig", ['success' => 'The quiz was created!']);
    
}
?>