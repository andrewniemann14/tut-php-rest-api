<?php
// https://code.tutsplus.com/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000
// data.niemann.app/index.php/user/list?limit=2

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
  header("HTTP/1.1 404 Not Found");
  exit();
}

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";

$objFeedController = new UserController();
$strMethodName = $uri[3] . 'Action';
$objFeedController->{$strMethodName}();
?>