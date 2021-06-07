<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Bootstrap StyleSheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--  -->
    <link rel="stylesheet" href="css/general.css">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="js/loader.js"></script>

</head>

<body>
    <!--LOGIN FORM-->
    <div style="background-image: url('images/rest_kit1.jpg');" class=" bg_img h-100">
        <div class="w-100 h-100 d-flex bg_t80 flex-wrap align-content-center justify-content-center">
            <div class="formholder card shadow">
                <div class="card-body p-2">
                    <form action="home.php" method="post">
                        <h3 class="text_lg bold text-center m-3">Admin Login</h3>

                        <!--USERNAME-->
                        <div class="form-group my-4">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Username" name="username" required>
                            <div class="mb-3">
                                <i class="text_sm text-info"></i>
                            </div>
                        </div>

                        <!--PASSWORD-->
                        <div class="form-group my-4">
                            <input type="password" class="form-control" autocomplete="off" placeholder="Password" name='password' required>
                            <div class="mb-3">
                                <i class="text_sm text-info"></i>
                            </div>
                        </div>

                        <button class="btn btn-info w-100" name="login">LOGIN</button>
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
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>