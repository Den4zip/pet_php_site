<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// If the user is logged in, show the dashboard.
require_once 'dashboard.php';

