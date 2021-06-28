<?php
include 'conn.php';
include 'message.php';

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

    // ====================== CRUD OPERATION FOR USERS ======================== //
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
            if(empty(trim($value)) && $key != "id") {
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
        $new_filename = empty($new_filename) ? '' : 'user_'.$new_filename;
        $sql = "INSERT INTO users (first_name, last_name, username, password, profile_image, role, added_by) VALUES ('$first_name', '$last_name', '$username', '$password', '$new_filename', '$role', '$admin_id')";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "User added successfully",
                "data" => []
            ]));
        }

    } else if($_POST['action'] == "update_user" || $_POST['action'] == "update_self") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if($key != "date_of_birth")
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

        $id = $_POST['action'] == "update_self" ? $_SESSION['user_details']['id'] : $id;

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

            if(!move_uploaded_file($source, "../images/uploads/user_" . $new_filename)) {
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
        if(isset($password)) if($results['password'] != $password) $password = md5($password);
        $new_filename = $new_filename == $results['profile_image'] ? '' : "profile_image = 'user_".$new_filename."',";

        $date_of_birth = isset($date_of_birth) ? "date_of_birth = '$date_of_birth'," : '';
        $username = isset($username) ? "username = '$username'," : '';
        $password = isset($password) ? "password = '$password'," : '';
        $role = isset($role) ? "role = '$role'," : '';

        $sql = "UPDATE users SET $date_of_birth $username $password $new_filename $role first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'";
        
        if(mysqli_query($conn, $sql)) {
            if($_POST['action'] == "update_self") {
                $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
                $query = mysqli_query($conn, $sql);
                $results = mysqli_fetch_array($query);

                $_SESSION['user_details'] = $results;
            }

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

    // ====================== CRUD OPERATION FOR FOODS ======================== //
    } else if ($_POST['action'] == "add_food") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value)) && $key != "id") {
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

        $sql = "SELECT * FROM foods WHERE name = '$name'";
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
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
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
        $new_filename = empty($new_filename) ? '' : 'food_'.$new_filename;
        $sql = "INSERT INTO foods (name, image, added_by) VALUES ('$name', '$new_filename', '$admin_id')";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "Food added successfully",
                "data" => []
            ]));
        }

    } else if ($_POST['action'] == "get_food") {
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

        $sql = "SELECT * FROM foods WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) < 1) {
            exit(json_encode([
                "status" => "NO_FOOD",
                "message" => "No food exist with selected parameters",
                "data"=> []
            ]));
        } else {
            exit(json_encode([
                "status" => "OK",
                "message" => "Food details fetch was successfully",
                "data"=> mysqli_fetch_array($query)
            ]));
        }
    } else if ($_POST['action'] == "update_food") {
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

        $sql = "SELECT * FROM foods WHERE name = '$name'";
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
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
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
        $new_filename = empty($new_filename) ? '' : ', image = food_'.$new_filename;
        $sql = "UPDATE foods name = '$name' $new_filename WHERE id = '$id'";
        
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "Food updated successfully",
                "data" => []
            ]));
        } else {
            exit(json_encode([
                "status" => "error",
                "message" => "Food was not updated successfully",
                "data" => []
            ]));
        }

    } else if($_POST['action'] == "delete_food") {
        if(isset($_POST['id'])) {
            $sql = "DELETE FROM foods WHERE id = '$id'";
            if(mysqli_query($conn, $sql)) {
                exit(json_encode([
                    "status" => "OK",
                    "message" => "Food deleted successfully",
                    "data" => []
                ]));
            } else {
                exit(json_encode([
                    "status" => "FAILED",
                    "message" => "Food could not be deleted",
                    "data" => []
                ]));
            }
        }

        exit(json_encode([
            "status" => "ERROR",
            "message" => "Food identifier parameter missing",
            "data" => []
        ]));


    // ====================== CRUD OPERATION FOR ACCOMPANIMENTS ======================== //
    } else if ($_POST['action'] == "add_accompaniment") {
        $error_handler = [
            "status" => "",
            "message" => "",
            "data" => []
        ];

        foreach ($_POST as $key => $value) {
            if(empty(trim($value)) && $key != "id") {
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

        $sql = "SELECT * FROM accompaniment WHERE name = '$name' AND food_item = '$food_item'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);

        if($count >= 1) {
            exit(json_encode([
                "status" => "ACCOMPANIMENT_EXIST",
                "message" => "Accompaniment with this food item already exist!!",
                "data" => []
            ]));
        }

        $admin_id = $_SESSION['user_details']['id'];
        $sql = "INSERT INTO accompaniment (name, food_item, added_by) VALUES ('$name', '$food_item', '$admin_id')";
        if(mysqli_query($conn, $sql)) {
            exit(json_encode([
                "status" => "OK",
                "message" => "Accompaniment added successfully",
                "data" => []
            ]));
        }
    } else if ($_POST['action'] == "get_accompaniment") {
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

        $sql = "SELECT * FROM accompaniment WHERE id = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) < 1) {
            exit(json_encode([
                "status" => "NO_ACCOMPANIMENT",
                "message" => "No accompaniment exist with selected parameters",
                "data"=> []
            ]));
        } else {
            exit(json_encode([
                "status" => "OK",
                "message" => "Accompaniment details fetch was successfully",
                "data"=> mysqli_fetch_array($query)
            ]));
        }

    } else if ($_POST['action'] == "update_accompaniment") {
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

        $sql = "UPDATE accompaniment SET name = '$name', food_item = '$food_item' WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);

        if(!$query) {
            exit(json_encode([
                "status" => "NO_ACCOMPANIMENT",
                "message" => "No accompaniment exist with selected parameters",
                "data"=> []
            ]));
        } else {
            exit(json_encode([
                "status" => "OK",
                "message" => "Accompaniment details was update successfully",
                "data"=> []
            ]));
        }

    } else if($_POST['action'] == "delete_accompaniment") {
        if(isset($_POST['id'])) {
            $sql = "DELETE FROM accompaniment WHERE id = '$id'";
            if(mysqli_query($conn, $sql)) {
                exit(json_encode([
                    "status" => "OK",
                    "message" => "Accompaniment deleted successfully",
                    "data" => []
                ]));
            } else {
                exit(json_encode([
                    "status" => "FAILED",
                    "message" => "Accompaniment could not be deleted",
                    "data" => []
                ]));
            }
        }

        exit(json_encode([
            "status" => "ERROR",
            "message" => "Accompaniment identifier parameter missing",
            "data" => []
        ]));


    } else if ($_POST['action'] == "food_payment") {
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
            exit(json_encode([
                "status" => "error",
                "message" => "All Fields are required."
            ]));
            
        } else {
            $food_details = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM foods WHERE id = '{$food}'"));
            $accompaniment_details = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM accompaniment WHERE id = '{$accompaniment}' AND food_item = '{$food}'"));
            if($food_details == null) {
                exit(json_encode([
                    "status" => "error",
                    "message" => "No food exists."
                ]));
            } else if ($accompaniment_details == null) {
                exit(json_encode([
                    "status" => "error",
                    "message" => "No accompaniment exist with such food."
                ]));
            }

            $id = $_SESSION['user_details']['id'];
            $sql = mysqli_query($conn, "INSERT INTO food_payment (name, contact, amount, food_id, accompaniment_id, user_id) VALUES ('$name', '$contact', '$amount', '$food', '$accompaniment', '$id')");
            if($sql) {
                $alert = new Message();
                $alert->sender("$name", "$contact", "$amount", "Dear $name, You have made a purchase for {$food_details['name']} with {$accompaniment_details['name']} at GHS $amount.");
                $resp = $alert->submit();
                 
                exit(json_encode([
                    "data" => $resp,
                    "status" => "success",
                    "message" => "Your food payment was successful."
                ]));
    
            } else {
                exit(json_encode([
                    "status" => "error",
                    "message" => "Your food payment was not successful."
                ])); 
    
            }       
        }
    
        exit(json_encode([
            "status" => "error",
            "message" => "There was an unknown error"
        ])); 

    }
}

exit(json_encode([
    "status" => "UNKNOWN_ERROR",
    "message" => "An unknown error occurred, Please try again later!!"
]));
