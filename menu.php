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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Menu Master</h1>
                        <!-- Button trigger modal -->
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_accompaniment">
                            <i class="fas fa-plus fa-sm text-white-50"></i> 
                            Add Accompaniment
                        </button>
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_food">
                            <i class="fas fa-plus fa-sm text-white-50"></i> 
                            Add Food item
                        </button>
                    </div>

                    <div class="row">
                        <!-- Modal -->
                        <div class="modal fade" id="add_food" tabindex="-1" role="dialog" aria-labelledby="add_food" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action-type="add_food">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Food Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action-type="add_food">
                                                <div class="form-group">
                                                    <label for="food_name" class="col-form-label">Food name:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-soup"></i></span>
                                                        </div>
                                                        <input type="text" name="food_name" class="form-control">
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="food_name"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label for="food_image" class="col-form-label">Food Image:</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="food_image" type="file" class="custom-file-input" id="food_image">
                                                            <label class="custom-file-label" for="food_image">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="food_image"></i>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Food item</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="add_accompaniment" tabindex="-1" role="dialog" aria-labelledby="add_accompaniment" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action-type="add_accompaniment">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="em">Accompaniment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action-type="add_accompaniment">
                                            <div class="form-group">
                                                <label for="accompaniment_name" class="col-form-label">Name of accompaniment:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-soup"></i></span>
                                                    </div>
                                                    <input type="text" name="accompaniment_name" class="form-control">
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="accompaniment_name"></i>
                                            </div>
                                            <div class="form-group">
                                                <label for="food_item" class="col-form-label">Food Item:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-soup"></i></span>
                                                    </div>
                                                    <select name="food_item" class="form-control">
                                                        <?php
                                                            $sql = "SELECT * FROM foods";
                                                            $query = mysqli_query($conn, $sql);
                                                            
                                                            echo '<option value="">Select an Option</option>';
                                                            while($row = mysqli_fetch_array($query)) {
                                                                echo '<option value="' . $row['id'] . '">'. $row['name'] .'</option>';
                                                            }
                                                        ?>
                                                    </select>                                            
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="food_item"></i>
                                            </div>
                                            <div class="form-group">
                                                <label for="accompaniment_image" class="col-form-label">Accompaniment Image:</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input name="accompaniment_image" type="file" class="custom-file-input" id="accompaniment_image">
                                                        <label class="custom-file-label" for="accompaniment_image">Choose file</label>
                                                    </div>
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="accompaniment_image"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Accompaniment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                                Total Earnings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Ghs 4000.00</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
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
                                                Food Items</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Least Sold Item</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rice</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-burger-soda fa-2x text-gray-300"></i>
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
                                                Most Sold Item</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Banku</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-burger-soda fa-2x text-gray-300"></i>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Food Item</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Banku</td>
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
                                                            <span class="text">Delete</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rice</td>
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
                                                            <span class="text">Delete</span>
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


                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Accompaniments</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Food Item</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Food Item</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Okro Stew and Tilapia</td>
                                                    <td>Banku</td>
                                                    <td>Josh Pong</td>
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
                                                            <span class="text">Delete</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tomato Stew and Chicken</td>
                                                    <td>Rice</td>
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
                                                            <span class="text">Delete</span>
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
    <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-pie-demo.js"></script>
    <script src="js/datatables-demo.js"></script>
    <script src="js/main.js"></script>

</body>

</html>