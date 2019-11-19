<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'vendor/autoload.php';

use Pubapi\Controllers\CreatePost;
use Pubapi\Controllers\Authentication;
session_start();

$router = new Router();
$router->before('/', function() {
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        return true;
    }
    header("Location: login");

    return false;
});

$router->get('/', function() {
      echo <<<HTML
  <h1>Hello world</h1>
HTML;
});

$router->get('/login', function() {
  include 'src/public/views/login.html';
});

$router->get('/logout', function() {
    $_SESSION = [];
    session_destroy();

    header("Location: login");
});

$router->post('/verify', function() {
    $auth = new Authentication($_REQUEST);
    $ret = $auth->verify();
});

$router->get('/post', function() {
  include 'src/public/views/post.html';
});

$router->post('/post', function() {
  $post = new CreatePost($_REQUEST);
  $post->publishPost();
});
