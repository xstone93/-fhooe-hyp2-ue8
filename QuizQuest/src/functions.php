<?php
function connectToDatabase() {
    $host = "db:3306";
    $username = "hypermedia"; // ODER 'onlineshop'
    $password = "geheim";
    $database = "QuizQuestNew";

    // Verbindungsstring - Data Source Name (DSN)
    $dsn = "mysql:host=$host;dbname=$database";

    try {
      return new PDO($dsn, $username, $password);
    } catch(PDOException $e) {
      echo "Connection error: " . $e->getMessage();
    }
  }
