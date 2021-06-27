<?php

    require '../includes/core.inc.php';
    if(isset($_GET['nav']))
    {
        $nav = $_GET['nav'];
        if ($nav === 'display')
        {
            if ($_GET['display'] === 'menu_master')
            {
                $_SESSION['sub'] = 'category';
                $_SESSION['view'] = 'view';
            }
            elseif ($_GET['display'] === 'user_mgmt') 
            {
                
                $_SESSION['sub'] = 'group';
                $_SESSION['view'] = 'view';
            }

            $_SESSION['display'] = $_GET['display'];
            gb();
        }
    }
    elseif (isset($_GET['sub']))
    {
        $sub = $_GET['sub'];
        $display = $_SESSION['display'];

        if ($display === 'menu_master')
        {
            $_SESSION['view'] = 'view';
        }

        $_SESSION['sub'] = $_GET['sub'];
        gb();
    }

    elseif (isset($_GET['view']))
    {
        $view = $_GET['view'];
        $_SESSION['view'] =$view;
        gb();
    }