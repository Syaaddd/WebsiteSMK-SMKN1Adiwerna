<?php
session_start();
session_destroy();
if (!defined('BASE_URL')) require_once dirname(__DIR__) . '/config/database.php';
header('Location: ' . BASE_URL . '/admin/login.php');
exit;
