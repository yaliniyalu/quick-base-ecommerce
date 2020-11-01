<?php
require_once __DIR__ . "/functions.php";

auth_session_start();
session_destroy();
header('Location: index.php');