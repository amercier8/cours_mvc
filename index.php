<?php
session_start();
require 'Autoload.php';

Autoload::autoload();
//require 'controller/Router.php';

$router = new Router();
$router -> routRequest();