<?php

    //go back functions
    function gb()
    {
        header("Location:".$_SERVER['HTTP_REFERER']);
    }

    //select from table
    function getRow($table , $condition , $con)
    {

        if ($condition === 'none')
        {
            $sql = "SELECT * FROM `$table`";
        }
        else
        {
            $sql = "SELECT * FROM `$table` WHERE $condition";
        }

        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    //row count
    function qRowCount($table , $cond , $con)
    {
        if ($cond === 'none')
        {
            $sql = "SELECT * FROM `$table`";
        }
        else
        {
            $sql = "SELECT * FROM `$table` WHERE $cond";
        }

        $stmt  = $con->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
        die();
    }

    //get sum of column
    function sum($table , $column, $condition , $con)
    {
        if ($con === 'none')
        {
            $sql = "SELECT SUM($column) FROM `$table`";
        }
        else
        {
            $sql = "SELECT SUM($column) FROM `$table` WHERE $condition";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["SUM($column)"];
    }

    //insert
    function insert($table , $colums , $values , $con)
    {
        $sql = "INSERT INTO `$table` ($colums) VALUES ($values)";
        $stmt = $con->prepare($sql);
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    //login function
    function login($username , $password , $conn) {
        //check if user exist...
        if (qRowCount('users' , "`username` = '$username'" , $conn) > 0) {
            //get user details...
            $user_details = getRow('users' , "`username` = '$username'" , $conn);
            $db_name = $user_details['username'];
            $db_password = $user_details['key'];
            $user_id = $user_details['id'];

            //validate password
            if (password_verify($password , $db_password)) {
                //set sessions
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user_details['username'];
                $_SESSION['login'] = true;
                $_SESSION['display'] = 'dashboard';
                $_SESSION['role'] = $user_details['role'];
            } else {
                $_SESSION['password_err'] = 'Password did not match';
            }
        } else {
            $_SESSION['username_err'] = "Account does not exist";
        }

        gb();
    }

    //logout function
    function logout()
    {
        @session_start();

        $_SESSION = array();
        session_destroy();
        gb();
    }

    //set notification
    function notification($message)
    {
        @session_start();
        $_SESSION['notification'] = $message;
    }

    //update row
    function update ($table , $set , $condition , $con)
    {
        if ($condition === 'none')
        {
            $sql = "UPDATE $table SET $set";
        }
        else
        {
            $sql = "UPDATE $table SET $set WHERE $condition";
        }
        $stmt = $con->prepare($sql);
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }