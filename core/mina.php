<?php
include 'conn.php';

if(isset($_POST['action'])) {
    extract($_POST);
    if($_POST['action'] == "login") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                array_push($error_handler['data'], [
                    $key, "This field is required"
                ]);
            }
        }

        if(!empty($error_handler['status'])) {
            exit(json_encode($error_handler));
        }

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);
        $results = mysqli_fetch_array($query);

        if(count($results) < 1) {
            exit(json_encode([
                "status" => "NO_USER",
                "message" => "User account does not exist!!",
                "data" => []
            ]));
        }

        if($results['password'] == md5($password)) {
            $_SESSION['user_details'] = $results;

            exit(json_encode([
                "status" => "OK",
                "message" => "Your login was successful"
            ]));
        } else {
            exit(json_encode([
                "status" => "PASSWORD_MISMATCH",
                "message" => "Your password was incorrect",
                "data" => ["password", "Password was incorrect"]
            ]));
        }

        exit(json_encode([
            "status" => "UNKNOWN_ERROR",
            "message" => "An unknown error occurred, Please try again later!!"
        ]));

    } else if($_POST['action'] == "add_user") {

    } else if ($_POST['action'] == "add_food") {
    
    } else if ($_POST['action'] == "add_accompaniment") {

    }
}
