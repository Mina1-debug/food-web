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
                        <h1 class="h3 mb-0 text-gray-800">Reports</h1>

                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                                </div>
                                <div class="card-body">

                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <label>From:</label>
                                                <input type="date" class="form-control report-filter" name="date_from" table-column="date" placeholder="">
                                            </div>
                                            <div class="col">
                                                <label>To:</label>
                                                <input type="date" class="form-control report-filter" name="date_to" table-column="date" placeholder="">
                                            </div>
                                            <div class="col">
                                                <label>Staff:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">
                                                            <i class="fas fa-burger-soda text-gray-300"></i>
                                                        </label>
                                                    </div>
                                                    <select class="custom-select report-filter" name="user" table-column="user">
                                                        <option value="">Choose...</option>
                                                        <?php
                                                            $_users = mysqli_query($conn, "SELECT * FROM users");
                                                            while($users = mysqli_fetch_array($_users)) {
                                                                $name = $users['first_name'] . " " . $users['last_name'];
                                                        ?>
                                                            <option value="<?=$name?>"><?=$name?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label>Food Item:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01"><i
                                                                class="fas fa-burger-soda text-gray-300"></i></label>
                                                    </div>
                                                    <select class="custom-select report-filter" name="food" table-column="food">
                                                        <option value="">Choose...</option>
                                                        <?php
                                                            $_food = mysqli_query($conn, "SELECT * FROM foods");
                                                            while($food = mysqli_fetch_array($_food)) {
                                                        ?>
                                                            <option value="<?=$food['name']?>"><?=$food['name']?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row d-flex justify-content-end">
                                            <div class="col-lg-3 mb-3">
                                                <input type="reset" class="btn btn-primary form-control report-filter" value="Reset">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Accompaniment</th>
                                                    <th>Purchased By</th>
                                                    <th>Handled By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM food_payment");
                                                    while ($sale = mysqli_fetch_array($sql)) {
                                                        $food_item = mysqli_query($conn, "SELECT * FROM foods WHERE id = '{$sale['food_id']}'");
                                                        $food_item = mysqli_fetch_array($food_item);

                                                        $accompaniment_item = mysqli_query($conn, "SELECT * FROM accompaniment WHERE id = '{$sale['accompaniment_id']}'");
                                                        $accompaniment_item = mysqli_fetch_array($accompaniment_item);

                                                        $user = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$sale['user_id']}'");
                                                        $user = mysqli_fetch_array($user);
                                                        ?>
                                                        <tr>
                                                            <td><?=$sale['id']?></td>
                                                            <td><?=($food_item['name']  ?? '<i>Food item was deleted</i>')?></td>
                                                            <td><?=($accompaniment_item['name']  ?? '<i>Accompaniment was deleted</i>')?></td>
                                                            <td><?=$sale['name']?> | <?=$sale['contact']?></td>
                                                            <td><?=$user['first_name']?> <?=$user['last_name']?></td>
                                                            <td><?=date_parser($sale['date_created'])?></td>
                                                            <td>
                                                                <a action-type="view_sale" data="<?=$sale['id']?>" href="#" class="btn btn-success btn-icon-split btn-action">
                                                                    <span class="px-2 py-1">
                                                                        <i class="fas fa-eye"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Accompaniment</th>
                                                    <th>Purchased By</th>
                                                    <th>Handled By</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
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
    <!-- <script src="js/chart-area-demo.js"></script> -->
    <!-- <script src="js/chart-pie-demo.js"></script> -->
    <script src="js/datatables-demo.js"></script>
    <script src="js/main.js"></script>

</body>

</html>