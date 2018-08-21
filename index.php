<?php
session_start();

require 'controller/Router.php';

$router = new Router();
$router -> routRequest();