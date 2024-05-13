<?php

use Fhooe\Router\Router;

require_once("functions.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = connectToDatabase();

    // Abfrage der Daten -- Alle Quizzes in der Tabelle auslesen

    $sql = "SELECT * FROM Player WHERE Username = :username AND Password = :password";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $result = $stmt->fetch();

    if (count($result) > 0) {
        // Set the session variable
        $_SESSION['isLoggedin'] = true;
        $_SESSION['userId'] = $result['ID'];

        // Redirect to the quiz_overview.html.twig using the router
        Router::redirectTo('/');
    } else {
        $twig->display("login.html.twig", ['error' => 'Invalid username or password!']);
    }   
}

?>
