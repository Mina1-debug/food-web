<?php

    require '../includes/core.inc.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']))
    {

        //get values from form
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);

        login($username , $password, $route);
    }

    //logout
    else if (isset($_GET['logout'])) {
        logout();
    }