<?php

declare(strict_types=1);

use Fhooe\Router\Router;
use Fhooe\Twig\RouterExtension;
use Fhooe\Twig\SessionExtension;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require "../vendor/autoload.php";
require_once("../src/quiz.php");

/**
 * When working with sessions, start them here.
 */
session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes and run it.
 */
// Create a new Router object.
$router = new Router();

// Create a monolog instance for logging in the skeleton. Pass it to the router to receive its log messages too.
$logger = new Logger("skeleton-logger");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/router.log"));
$router->setLogger($logger);

// Create a new Twig instance for advanced templates.
$twig = new Environment(
    new FilesystemLoader("../views"),
    [
        "cache" => "../cache",
        "auto_reload" => true,
        "debug" => true
    ]
);

// Add the router extension to Twig. This makes the url_for() and get_base_path() functions available in templates.
$twig->addExtension(new RouterExtension($router));
// Add the session extension to Twig. This makes the session() function available in templates to access entries in $_SESSION.
$twig->addExtension(new SessionExtension());
// Add the debug extension to Twig. This makes the dump() function available in templates to dump variables.
$twig->addExtension(new DebugExtension());

if (isset($_SESSION)) {
    $twig->addGlobal("_session", $_SESSION);
}

// Set a base path if your code is not in your server's document root.
$router->setBasePath("/fhooe-hyp2-ue8/QuizQuest/public");

// Set a 404 callback that is executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $twig).
$router->set404Callback(fn() => $twig->display("404.html.twig"));

// Define all routes here.
$router->get("/", function () use ($twig) {
    $twig->display("index.html.twig");
});

$router->get("/login", function () use ($twig) {
    $twig->display("login.html.twig");
});

$router->get("/register", function () use ($twig) {
    $twig->display("register.html.twig");
});

$router->post("/register", function () use ($twig) {
    require __DIR__ . "/../src/register.php";
});

$router->get("/quizoverview", function () use ($twig) {
    $quizzes = getQuizzes();
    $twig->display("quiz_overview.html.twig", ['quizzes' => $quizzes]);
});

$router->get("/quizmodify", function () use ($twig) {
    $quiz = getQuiz($_GET['id']);
    $twig->display("quiz_modify.html.twig", ['quiz' => $quiz]);
});

$router->post("/quizmodify", function () use ($twig) {
    require __DIR__ . "/../src/quiz_modify.php";
});

$router->get("/quiz", function () use ($twig) {
    $quiz = getQuiz($_GET['id']);
    $twig->display("quiz_open.html.twig", ['quiz' => $quiz]);
});

$router->get("/quizcreate", function () use ($twig) {
    $twig->display("quiz_modify.html.twig");
});

$router->get("/quizquestions", function () use ($twig) {
    $quiz = getQuiz($_GET['id']);
    $twig->display("quiz_questions.html.twig", ['quiz' => $quiz]);
});

$router->post("/quizquestions", function () use ($twig) {
    require __DIR__ . "/../src/quiz_questions.php";
});

$router->post("/quizcreate", function () use ($twig) {
    require __DIR__ . "/../src/quiz_create.php";
});

$router->post("/quizdelete", function () use ($twig) {
    require __DIR__ . "/../src/quiz_delete.php";
});

$router->post("/login", function () use ($twig) {
    // This should check if the user is logged in and if the credentials are correct. Check it in database.
    require __DIR__ . "/../src/login.php";
});

$router->get("/logout", function () use ($twig) {
    $_SESSION = [];
    session_destroy();
    Router::redirectTo("/");
});

// Run the router to get the party started.
$router->run();
