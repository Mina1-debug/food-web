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
    <link href="lib/datatables/datatables/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">

    <!-- SweetAlert StyleSheet -->
    <link href="lib/sweetalert2/sweetalert2.css" rel="stylesheet", type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">


</head>

<body id="page-top">

    <?php include 'loader.php';?>
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
                        <h1 class="h3 mb-0 text-gray-800">Menu Master</h1>
                        <!-- Button trigger modal -->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-2" data-toggle="modal" data-target="#add_accompaniment">
                                <i class="fas fa-plus fa-sm text-white-50"></i> 
                                Add Accompaniment
                            </button>
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-2" data-toggle="modal" data-target="#add_food">
                                <i class="fas fa-plus fa-sm text-white-50"></i> 
                                Add Food item
                            </button>
                        </div>
                    </div>

                    <!-- <div class="row"> -->
                        <!-- Modal -->
                        <div class="modal fade" id="add_food" tabindex="-1" role="dialog" aria-labelledby="add_food" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action-type="add_food">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Food Item</h5>
                                            <input type="hidden" name="id">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action-type="add_food">
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Food name:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-soup"></i></span>
                                                        </div>
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="name"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image" class="col-form-label">Food Image:</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="image" type="file" class="custom-file-input" id="image">
                                                            <label class="custom-file-label" for="image">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <i class="text_sm text-info error_info" input-name="image"></i>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <!-- </div> -->

                    <!-- Modal -->
                    <div class="modal fade" id="add_accompaniment" tabindex="-1" role="dialog" aria-labelledby="add_accompaniment" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action-type="add_accompaniment">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="em">Accompaniment</h5>
                                        <input type="hidden" name="id">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action-type="add_accompaniment">
                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Name of accompaniment:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-soup"></i></span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                                <i class="text_sm text-info error_info" input-name="name"></i>
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
                                         
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
 

                    <!-- Content Row -->
                    <div class="row">

                          <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Food Items</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $sql = "SELECT * FROM foods";
                                                    $query = mysqli_query($conn, $sql);
                                                    echo mysqli_num_rows($query);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Least Sold Item</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $sql = "
                                                    SELECT food_id, COUNT(food_id) AS `occur` 
                                                    FROM food_payment
                                                    GROUP BY food_id
                                                    ORDER BY `occur` ASC
                                                ";
                                                $check = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
                                                $query = mysqli_query($conn, "SELECT * FROM foods WHERE id = '{$check["food_id"]}'");
                                                $least_food = mysqli_fetch_array($query, MYSQLI_ASSOC);
                                                echo $least_food["name"];
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-burger-soda fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Most Sold Item</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $sql = "
                                                    SELECT food_id, COUNT(food_id) AS `occur` 
                                                    FROM food_payment
                                                    GROUP BY food_id
                                                    ORDER BY `occur` DESC
                                                ";
                                                $check = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
                                                $query = mysqli_query($conn, "SELECT * FROM foods WHERE id = '{$check["food_id"]}'");
                                                $most_food = mysqli_fetch_array($query, MYSQLI_ASSOC);
                                                echo $most_food['name'];
                                            ?>
                                            </div>
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
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Accompaniment</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Accompaniment</th>
                                                    <th>Added By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                    
                                                    $sql = "SELECT * FROM foods";
                                                    $query = mysqli_query($conn, $sql);

                                                    $count = 0;
                                                    while($row = mysqli_fetch_array($query)) {
                                                        $row = (object)$row;

                                                        $_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$row->added_by'");
                                                        $added_by = (object)mysqli_fetch_array($_query);

                                                        $accom = mysqli_query($conn, "SELECT * FROM accompaniment WHERE food_item = '$row->id'");
                                                        if(mysqli_num_rows($accom) <= 0) {
                                                            $count++;
                                                            echo '
                                                                <tr>
                                                                    <td>'. $count .'</td>
                                                                    <td>'. $row->name .'</td>
                                                                    <td>No Accompaniment</td>
                                                                    <td>'. $added_by->first_name .' '. $added_by->last_name .'</td>
                                                                    <td>'. date_parser($row->date_created) .'</td>
                                                                    <td>
                                                                        <a action-type="get_food" data="'. $row->id .'" href="#" class="btn btn-warning btn-icon-split btn-action">
                                                                            <span class="px-2 py-1">
                                                                                <i class="fas fa-edit"></i>
                                                                            </span>
                                                                        </a>
                                                                        <a action-type="delete_food" data="'. $row->id .'" href="#" class="btn btn-danger btn-icon-split btn-action">
                                                                            <span class="px-2 py-1">
                                                                                <i class="fas fa-trash"></i>
                                                                            </span>
                                                                        </a>
                                                                    </td> 
                                                                </tr>'
                                                            ;
                                                        }

                                                        while ($accompaniment = mysqli_fetch_array($accom)) {
                                                            $count++;
                                                            echo '
                                                                <tr>
                                                                    <td>'. $count .'</td>
                                                                    <td>'. $row->name .'</td>
                                                                    <td>'. $accompaniment['name'] .'</td>
                                                                    <td>'. $added_by->first_name .' '. $added_by->last_name .'</td>
                                                                    <td>'. date_parser($row->date_created) .'</td>
                                                                    <td>
                                                                        <a action-type="get_accompaniment" data="'. $accompaniment['id'] .'" href="#" class="btn btn-warning btn-icon-split btn-action">
                                                                            <span class="px-2 py-1">
                                                                                <i class="fas fa-edit"></i>
                                                                            </span>
                                                                        </a>
                                                                        <a action-type="delete_accompaniment" data="'. $accompaniment['id'] .'" href="#" class="btn btn-danger btn-icon-split btn-action">
                                                                            <span class="px-2 py-1">
                                                                                <i class="fas fa-trash"></i>
                                                                            </span>
                                                                        </a>
                                                                    </td> 
                                                                </tr>'
                                                            ;
                                                        }
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
                <!-- End of Main Content -->

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
    <script src="lib/datatables/datatables/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="lib/datatables/buttons/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/buttons/js/buttons.print.min.js"></script>
    <script src="lib/datatables/buttons/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="lib/datatables/jszip/jszip.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/jquery-easing/jquery.easing.min.js"></script>

    <!-- FontAwesome JavaScript -->
    <script defer src="lib/font-awesome-pro/js/pro.js"></script>

    <!-- SweetAlert JavaScript -->
    <script src="lib/sweetalert2/sweetalert2.js"></script>  

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/chart-area-demo.js"></script> -->
    <!-- <script src="js/chart-pie-demo.js"></script> -->
    <script src="js/datatables-demo.js"></script>
    <script src="js/main.js"></script>

</body>

</html>