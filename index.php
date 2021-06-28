<?php
include 'core/conn.php';
if(isset($_SESSION['user_details'])) {
    header("Location:" . ($_SESSION['user_details']['role'] == "Admin" ? "home.php" : "wonder copy.php"));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Bootstrap StyleSheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome StyleSheet -->
    <link href="lib/font-awesome-pro/css/all.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/general.css">

    <!-- SweetAlert StyleSheet -->
    <link href="lib/sweetalert2/sweetalert2.css" rel="stylesheet", type="text/css">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="js/loader.js"></script>

</head>

<body>
    <?php include 'loader.php';?>
    <!--LOGIN FORM-->
    <div style="background-image: url('images/rest_kit1.jpg');" class=" bg_img">
        <div class="w-100 d-flex bg_t80 flex-wrap align-content-center justify-content-center" style="height: 100vh">
            <div class="formholder card shadow">
                <div class="card-body px-4">
                    <form class="w-100" action-type="login" method="post" autocomplete="off">

                        <div class="logo"><img src="images/inn.png" alt="logo" width="120px" height="70px"></div>

                        <h3 class="text_lg bold text-center m-3">Admin Login</h3>

                        <!--USERNAME-->
                        <div class="form-group my-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3">
                                <i class="text_sm text-info error_info" input-name="username"></i>
                            </div>
                        </div>

                        <!--PASSWORD-->
                        <div class="form-group my-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Passowrd" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3">
                                <i class="text_sm text-info error_info" input-name="password"></i>
                            </div>
                        </div>

                        <button class="btn btn-info w-100" name="login"><i class="fas fa-sign-in-alt"></i> LOGIN</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</body>
</html>


<!-- jQuery library -->
<script src="lib/jquery/jquery.js"></script>

<!-- Latest compiled JavaScript -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>

<!-- SweetAlert JavaScript -->
<script src="lib/sweetalert2/sweetalert2.js"></script>  

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $("input").on("keyup", function () {
            $(".error_info[input-name='" + $(this).attr("name") + "']").text("");
        });

        $("form").on("submit", function(e) {
            e.preventDefault();
            var _formData = new FormData(this);
            _formData.append("action", $(this).attr("action-type"))

            $.ajax({
                url: "core/mina.php",
                method: "post",
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                data: _formData,
                error: (e) => {
                    console.log(e);
                },
                beforeSend: () => {

                },
                success: (response) => {
                    if(response['status'] == "OK") {
                        window.location = "index.php";
                    } else {
                        Swal.fire({
                            title: "Login Failed",
                            text: "No user exist with this account details",
                            icon: "error"
                        });
                        response['data'].forEach(item => {
                            $(".error_info[input-name='" + item[0] + "']").text(item[1]);
                        });
                    }
                }
            });
        })
    });
</script>