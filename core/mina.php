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

        if(mysqli_num_rows($query) < 1) {
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

    } else if($_POST['action'] == "logout") {
        unset($_SESSION['user_details']);
        exit(json_encode([
            "status" => "OK",
            "message" => "Your have logged out successfully",
            "data"=> []
        ]));

    } else if($_POST['action'] == "get_user") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                $error_handler['message'] = "Could not fetch user info";
                $error_handler['data'] = [];
            }
        }

        if(!empty($error_handler['status'])) {
            exit(json_encode($error_handler));
        }

        $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) < 1) {
            exit(json_encode([
                "status" => "NO_USER",
                "message" => "No user exist with selected parameters",
                "data"=> []
            ]));
        } else {
            exit(json_encode([
                "status" => "OK",
                "message" => "User details fetch was successfully",
                "data"=> mysqli_fetch_array($query)
            ]));
        }

    } else if($_POST['action'] == "add_user") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                $error_handler['message'] = "Some required field were left empty";
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
        $count = mysqli_num_rows($query);

        if($count >= 1) {
            exit(json_encode([
                "status" => "USER_EXIST",
                "message" => "User account already exist!!",
                "data" => []
            ]));
        }

        $new_filename = "";
        if(isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
            $filename = $_FILES['profile_image']['name'];
            $type = $_FILES['profile_image']['type'];
            $source = $_FILES['profile_image']['tmp_name'];
            $new_filename = time() . "." . explode(".", $filename)[1];

            if(!in_array(explode("/", $type)[1], ["jpeg", "jpg", "png"])) {
                exit(json_encode([
                    "status" => "INVALID_FILE",
                    "message" => "Selected file is not supported",
                    "data" => ["profile_iamge", "Invalid file type. Only supports jpeg, jpg & png"]
                ]));
            }

            if(!move_uploaded_file($source, "../images/uploads/" . $new_filename)) {
                exit(json_encode([
                    "status" => "FILE_UPLOAD_FAILED",
                    "message" => "Your profile picture could not be uploaded",
                    "data" => []
                ]));
            }
        }

        $admin_id = $_SESSION['user_details']['id'];
        $password = md5($password);
        $sql = "INSERT INTO users (first_name, last_name, username, password, profile_image, role, added_by) VALUES ('$first_name', '$last_name', '$username', '$password', '$new_filename', '$role', '$admin_id')";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "User added successfully",
                "data" => []
            ]));
        }

    } else if($_POST['action'] == "update_user") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                $error_handler['message'] = "Some required field were left empty";
                array_push($error_handler['data'], [
                    $key, "This field is required"
                ]);
            }
        }

        if(!empty($error_handler['status'])) {
            exit(json_encode($error_handler));
        }

        $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        $results = mysqli_fetch_array($query);

        if($count < 1) {
            exit(json_encode([
                "status" => "USER_DOES_NOT_EXIST",
                "message" => "User account does not exist!!",
                "data" => []
            ]));
        }

        $new_filename = "";
        if(isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
            $filename = $_FILES['profile_image']['name'];
            $type = $_FILES['profile_image']['type'];
            $source = $_FILES['profile_image']['tmp_name'];
            $new_filename = time() . "." . explode(".", $filename)[1];

            if(!in_array(explode("/", $type)[1], ["jpeg", "jpg", "png"])) {
                exit(json_encode([
                    "status" => "INVALID_FILE",
                    "message" => "Selected file is not supported",
                    "data" => ["profile_iamge", "Invalid file type. Only supports jpeg, jpg & png"]
                ]));
            }

            if(!move_uploaded_file($source, "../images/uploads/" . $new_filename)) {
                exit(json_encode([
                    "status" => "FILE_UPLOAD_FAILED",
                    "message" => "Your profile picture could not be uploaded",
                    "data" => []
                ]));
            }
        } else {
            $new_filename = $results['profile_image'];
        }

        $admin_id = $_SESSION['user_details']['id'];
        if($results['password'] != $password) $password = md5($password);
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', password = '$password', profile_image = '$new_filename', role = '$role' WHERE id = '$id'";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "User updated successfully",
                "data" => []
            ]));
        }

    } else if($_POST['action'] == "delete_user") {
        if(isset($_POST['id'])) {
            $sql = "DELETE FROM users WHERE id = '$id'";
            if(mysqli_query($conn, $sql)) {
                exit(json_encode([
                    "status" => "OK",
                    "message" => "User deleted successfully",
                    "data" => []
                ]));
            } else {
                exit(json_encode([
                    "status" => "FAILED",
                    "message" => "User could not be deleted",
                    "data" => []
                ]));
            }
        }

        exit(json_encode([
            "status" => "ERROR",
            "message" => "User identifier parameter missing",
            "data" => []
        ]));
    } else if ($_POST['action'] == "add_food") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                $error_handler['message'] = "Some required field were left empty";
                array_push($error_handler['data'], [
                    $key, "This field is required"
                ]);
            }
        }

        if(!empty($error_handler['status'])) {
            exit(json_encode($error_handler));
        }

        $sql = "SELECT * FROM food WHERE name = '$food_name'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);

        if($count >= 1) {
            exit(json_encode([
                "status" => "FOOD_EXIST",
                "message" => "Food item already exist!!",
                "data" => []
            ]));
        }

        $new_filename = "";
        if(isset($_FILES['food_image']) && !empty($_FILES['food_image']['name'])) {
            $file = $_FILES['food_image'];
            $filename = $file['name'];
            $type = $file['type'];
            $source = $file['tmp_name'];
            $new_filename = time() . "." . explode(".", $filename)[1];

            if(!in_array(explode("/", $type)[1], ["jpeg", "jpg", "png"])) {
                exit(json_encode([
                    "status" => "INVALID_FILE",
                    "message" => "Selected file is not supported",
                    "data" => ["food_image", "Invalid file type. Only supports jpeg, jpg & png"]
                ]));
            }

            if(!move_uploaded_file($source, "../images/uploads/food_$new_filename")) {
                exit(json_encode([
                    "status" => "FILE_UPLOAD_FAILED",
                    "message" => "Your profile picture could not be uploaded",
                    "data" => []
                ]));
            }
        }

        $admin_id = $_SESSION['user_details']['id'];
        $sql = "INSERT INTO foods (name, image, added_by) VALUES ('$food_name', '$new_filename', '$admin_id')";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "Food added successfully",
                "data" => []
            ]));
        }
    
    } else if ($_POST['action'] == "add_accompaniment") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value))) {
                $error_handler['status'] = "MISSING_PARAMETERS";
                $error_handler['message'] = "Some required field were left empty";
                array_push($error_handler['data'], [
                    $key, "This field is required"
                ]);
            }
        }

        if(!empty($error_handler['status'])) {
            exit(json_encode($error_handler));
        }

        $sql = "SELECT * FROM accompaniment WHERE name = '$accompaniment_name' AND food_id = '$food_item'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);

        if($count >= 1) {
            exit(json_encode([
                "status" => "ACCOMPANIMENT_EXIST",
                "message" => "Accompaniment with this food item already exist!!",
                "data" => []
            ]));
        }

        $new_filename = "";
        $file = $_FILES['accompaniment_image'];
        if(isset($file) && !empty($file['name'])) {
            $filename = $file['name'];
            $type = $file['type'];
            $source = $file['tmp_name'];
            $new_filename = time() . "." . explode(".", $filename)[1];

            if(!in_array(explode("/", $type)[1], ["jpeg", "jpg", "png"])) {
                exit(json_encode([
                    "status" => "INVALID_FILE",
                    "message" => "Selected file is not supported",
                    "data" => ["accompaniment_image", "Invalid file type. Only supports jpeg, jpg & png"]
                ]));
            }

            if(!move_uploaded_file($source, "../images/uploads/accompaniment_$new_filename")) {
                exit(json_encode([
                    "status" => "FILE_UPLOAD_FAILED",
                    "message" => "Your profile picture could not be uploaded",
                    "data" => []
                ]));
            }
        }

        $admin_id = $_SESSION['user_details']['id'];
        $sql = "INSERT INTO accompaniment (name, image, food_id, added_by) VALUES ('$accompaniment_name', '$new_filename', '$food_item', '$admin_id')";
        var_dump($sql);   
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "Accompaniment added successfully",
                "data" => []
            ]));
        }
    }
}

exit(json_encode([
    "status" => "UNKNOWN_ERROR",
    "message" => "An unknown error occurred, Please try again later!!"
]));
