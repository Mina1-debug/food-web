<?php
    //start session
    session_start();

    //check if user is loged in
    if (isset($_SESSION['login']) && $_SESSION['login'] === true)
    {
        $login = 'yes';
        $display = $_SESSION['display'];
        if (isset($_SESSION['sub']))
        {
            $sub = $_SESSION['sub'];
        }

        if (isset($_SESSION['view']))
        {
            $view = $_SESSION['view'];
        }

        if(!isset($_SESSION['vq']))
        {
            $_SESSION['vq'] = '*';
        }

        $vq = $_SESSION['vq'];

        $today = date('Y-m-d');
        $user = $_SESSION['username'];

        //show notification
        if (isset($_SESSION['notification']))
        {
            echo "<script> alert('".$_SESSION['notification']."') </script>";
            unset($_SESSION['notification']);
            echo "<script>location.reload()</script>";
        }
    }
    else
    {
        $login = 'no';
    }