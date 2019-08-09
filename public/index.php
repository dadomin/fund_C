<?php

session_start();

define("__ROOT", dirname(__DIR__));

use Damin\Route;

require(__ROOT . "/autoload.php");
require(__ROOT . "/web.php");

$url = if(isset($_GET['url'])) ? "/" . $_GET['url'] : "/";

Rotue::route($url);