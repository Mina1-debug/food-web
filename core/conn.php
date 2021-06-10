<?php
if(session_status() == PHP_SESSION_NONE) session_start();

$_server = "127.0.0.1";
$_username = "root";
$_password = "N@n@k0j0";
$_database = "corner_inn_tmp";

$conn = mysqli_connect($_server, $_username, $_password, $_database);