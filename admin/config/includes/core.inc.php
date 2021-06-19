<?php

    // This is the core configuration file, it will contain
    // all the core files needed and only this file will be 
    // included where we need out file

    $today = date("Y-m-d");

    require 'session.inc.php';
    require 'db_connect.inc.php';
    require 'functions.inc.php';
    require 'queries.php';

    $display = ''; $sub = ''; $view = '';

    if(isset($_SESSION['display'])) {
        $display = $_SESSION['display'];

    }
    if(isset($_SESSION['sub'])) {
        $sub = $_SESSION['sub'];

    }
    if(isset($_SESSION['view'])) {
        $view = $_SESSION['view'];

    }


    if ($display === 'user_mgmt')
    {
        //count grops
        $group_count = qRowCount("user_access_level", "none", $route);
        //user couns
        $users_count = qRowCount("users", "none", $route);
        if($sub === 'group') {
           
        }
    }

    