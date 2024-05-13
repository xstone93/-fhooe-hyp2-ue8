<?php
 
 require_once("functions.php");

 function getQuizzes()
 {
    // Get all open quizzes from the database
    $pdo = connectToDatabase();

    $sql = "SELECT * FROM Quiz WHERE Status = 'public' AND StartedAt <= NOW() AND ClosedAt >= NOW() AND DeletedAt IS NULL";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
    return $quizzes;
 }

 function getQuizzesFromUser($userId)
 {
    // Get all quizzes from the database that are created by the user
    $pdo = connectToDatabase();

    $sql = "SELECT * FROM Quiz WHERE UserId = :userId AND DeletedAt IS NULL";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $quizzes = $stmt->fetchAll();
    return $quizzes;
 }

 function getQuiz($id)
 {
    // Get the quiz with the given id from the database
    $pdo = connectToDatabase();

    $sql = "SELECT * FROM Quiz WHERE ID = :id AND DeletedAt IS NULL";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $quiz = $stmt->fetch();
    return $quiz;
 }

?>
