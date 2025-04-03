<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/includes/functions.php';
require_once BASE_PATH . '/includes/router.php';
require_once __DIR__ . '/includes/env.php';
