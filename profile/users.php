<?php
include 'core/conn.php';
include 'core/functions.php';
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

    <!-- Datatable StyleSheet -->
    <link href="lib/sweetalert2/sweetalert2.css" rel="stylesheet", type="text/css">

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
                            <form action-type="add_user">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add_user_label">Add A User</h5>
                                        <input type="hidden" name="id">
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="first_name" class="col-form-label">First Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" name="first_name" class="form-control">
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="first_name"></i>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="last_name" class="col-form-label">Last Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" name="last_name" class="form-control">
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="last_name"></i>
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
                                            <i class="text_sm text-info error_info" input-name="username"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">Password:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="text" name="password" class="form-control">
                                            </div>
                                            <i class="text_sm text-info error_info" input-name="password"></i>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="recipient-name" class="col-form-label">Profile Image:</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input name="profile_image" type="file" class="custom-file-input" id="inputGroupFile03">
                                                        <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                                    </div>
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="profile-image"></i>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="recipient-name" class="col-form-label">Position:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-shield"></i></span>
                                                    </div>
                                                    <select name="role" class="form-control">
                                                        <option value="">Select An option</option>
                                                        <option value="Waiter">Waiter</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>                                            
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="role"></i>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add User</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm modal-popup" data-toggle="modal" data-target="#add_user"><i
                        class="fas fa-user-plus fa-sm text-white-50"></i> Add User</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
                            $results = [
                                "Admin" => mysqli_num_rows(mysqli_query($conn, "SELECT role FROM users WHERE role = 'Admin'")),
                                "Waiter" => mysqli_num_rows(mysqli_query($conn, "SELECT role FROM users WHERE role = 'Waiter'"))
                            ];
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $results['Admin'] + $results['Waiter']?></div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $results['Admin']?></div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $results['Waiter']?></div>
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
                                                <?php
                                                    $sql = "SELECT * FROM users";
                                                    $query = mysqli_query($conn, $sql);

                                                    while($row = mysqli_fetch_array($query)) {
                                                        $row = (object)$row;

                                                        $_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$row->added_by'");
                                                        $added_by = (object)mysqli_fetch_array($_query);
                                                        

                                                        echo '
                                                            <tr>
                                                                <td>'. $row->id .'</td>
                                                                <td>'. $row->first_name .' '. $row->last_name .'</td>
                                                                <td>'. $row->role .'</td>
                                                                <td>'. ((mysqli_num_rows($_query) < 1) ? 'None' : ($added_by->first_name .' '. $added_by->last_name)) .'</td>
                                                                <td>'. date_parser($row->date_created) .'</td>
                                                                <td>
                                                                    <a action-type="get_user" data="'. $row->id .'" href="#" class="btn btn-warning btn-icon-split btn-action">
                                                                        <span class="px-2 py-1">
                                                                            <i class="fas fa-edit"></i>
                                                                        </span>
                                                                    </a>
                                                                    ' . ($row->id != $_SESSION['user_details']['id'] ? '<a action-type="delete_user" data="'. $row->id .'" href="#" class="btn btn-danger btn-icon-split btn-action">
                                                                        <span class="px-2 py-1">
                                                                            <i class="fas fa-trash"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>' : '')
                                                        ;
                                                    }
                                                
                                                ?>
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

    <!-- Bootstrap core JavaScript-->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables javaScript -->
    <script src="lib/datatables/dataTables.bootstrap4.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/jquery-easing/jquery.easing.min.js"></script>

    <!-- FontAwesome JavaScript -->
    <script src="lib/font-awesome-pro/js/pro.js"></script> 
    
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