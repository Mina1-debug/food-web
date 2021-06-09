<?php
include 'core/conn.php';
if(!isset($_SESSION['user_details'])) {
    header("Location: index.php");
} else {
    if($_SESSION['user_details']['role'] != "Admin") header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A website to manage restaurant services">
    <meta name="author" content="Mina Dankwah">

    <title>Corner Inn Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="lib/font-awesome-pro/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Datatable StyleSheet -->
    <link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet", type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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

                    <!-- Modal Form for Users -->
                    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="add_user_label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_user_label">Add A User</h5>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="first_name" class="col-form-label">First Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" name="first_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="last_name" class="col-form-label">Last Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" name="last_name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-form-label">Username:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">Password:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="text" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="recipient-name" class="col-form-label">Profile Image:</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input name="profile" type="file" class="custom-file-input" id="inputGroupFile03">
                                                        <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="recipient-name" class="col-form-label">Position:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-shield"></i></span>
                                                    </div>
                                                    <select class="form-control">
                                                        <option value="">Select An option</option>
                                                        <option value="Waiter">Waiter</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_user"><i
                        class="fas fa-user-plus fa-sm text-white-50"></i> Add User</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">40</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Adminitrators</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Waiters</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Highest Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Mina Dankwah</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-crown fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                        
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>CI-1</td>
                                                    <td>Josh Pong</td>
                                                    <td>Waiter</td>
                                                    <td>Mina Dankwah</td>
                                                    <td>12-AUG-2021</td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            <span class="text">Modiy</span>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Suspend</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CI-2</td>
                                                    <td>Isaac Reeves</td>
                                                    <td>Waiter</td>
                                                    <td>Mina Dankwah</td>
                                                    <td>12-AUG-2021</td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            <span class="text">Modiy</span>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Suspend</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'components/footer.php'?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables javaScript -->
    <script src="lib/datatables/dataTables.bootstrap4.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/jquery-easing/jquery.easing.min.js"></script>

    <!-- FontAwesome JavaScript -->
    <script defer src="lib/font-awesome-pro/js/pro.js"></script> 

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="lib/chart.js/Chart.min.js"></script>
    <script src="lib/datatables/jquery.dataTables.min.js"></script>
    <script src="lib/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-pie-demo.js"></script>
    <script src="js/datatables-demo.js"></script>

</body>

</html>