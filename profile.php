<?php 
include 'core/conn.php';
include 'core/functions.php';
if(!isset($_SESSION['user_details'])) {
    header("Location: index.php");
} else {
    if($_SESSION['user_details']['role'] != "Admin") header("Location: index.php");
}

$user = $_SESSION['user_details'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="lib/font-awesome-pro/css/all.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Datatable StyleSheet -->
    <link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet" , type="text/css">

    <!-- SweetAlert StyleSheet -->
    <link href="lib/sweetalert2/sweetalert2.css" rel="stylesheet" , type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Profile</title>

    <style>
        .user-image img {
            width: 150px;
            height: 150px;
            border-radius: 100%;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'components/sidebar.php'?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'components/header.php'?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>

                    </div>

                    <div class="row d-flex justify-content-center">
                        <!-- Area Chart -->
                        <div class="col-xl-4 col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $user['first_name']?> <?php echo $user['last_name']?></h6>
                                </div>
                                <div class="card-body">

                                    <div class="card-block">
                                        <div class="user-image d-flex justify-content-center">
                                            <img src="<?php echo !empty($user['profile_image']) ? 'images/uploads/'.$user['profile_image'] : 'images/undraw_profile.svg'?>" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <!-- <h6 class="text-center mt-1 mb-3"><a href="#">Change Profile</a></h6> -->
                                        <p class="text-center text-muted mt-3"> <?=$user['gender']?> | <?=$user['role']?></p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
                                </div>
                                <div class="card-body">

                                    <form action-type="update_self">
                                        <div class="row">

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="first_name" class="col-form-label">First Name:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="first_name" class="form-control" value="<?=$user['first_name']?>">
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="first_name"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="last_name" class="col-form-label">Last Name:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="last_name" class="form-control" value="<?=$user['last_name']?>">
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="last_name"></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="date_of_birth" class="col-form-label">Date Of Birth:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" name="date_of_birth" class="form-control" value="<?=$user['date_of_birth']?>">
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="date_of_birth"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="profile_image" class="col-form-label">Profile Image:</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="profile_image" type="file" class="custom-file-input" id="profile_image">
                                                            <label class="custom-file-label" for="profile_image">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="profile_image"></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row d-flex justify-content-end">
                                            <div class="col-lg-3 mb-3">
                                                <input type="submit" class="btn btn-primary form-control" value="Save">
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>


                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'components/footer.php'?>
            <!-- End of Footer -->

        </div>
        <!-- End of Page Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables javaScript -->
    <script src="lib/datatables/dataTables.bootstrap4.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/jquery-easing/jquery.easing.min.js"></script>

    <!-- FontAwesome JavaScript -->
    <script defer src="lib/font-awesome-pro/js/pro.js"></script>

    <!-- SweetAlert JavaScript -->
    <script src="lib/sweetalert2/sweetalert2.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="lib/chart.js/Chart.min.js"></script>
    <script src="lib/datatables/jquery.dataTables.min.js"></script>
    <script src="lib/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/chart-area-demo.js"></script> -->
    <!-- <script src="js/chart-pie-demo.js"></script> -->
    <script src="js/datatables-demo.js"></script>
    <script src="js/main.js"></script>

</body>

</html>