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


    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
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

                    <div class="container">
                        <div class="row d-flex justify-content-center">

                            <div class="col-md-4 ">
                                <div class="card user-card  ">
                                    <div class="card-header">
                                        <h5>Mina Dankwah</h5>
                                    </div>

                                    <div class="card-block">
                                        <div class="user-image">
                                            <img src="images/g.jpg" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600 m-t-25 m-b-10">Mina</h6>
                                        <p class="text-muted">Active | Female | Born 23.05.1992</p>
                                        <hr>
                                        <!-- <p class="text-muted m-t-15">Activity Level: 87%</p>
                                        <ul class="list-unstyled activity-leval">
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <div class="bg-c-yellow counter-block m-t-10 p-20">
                                            <div class="row">
                                                <div class="col-4">
                                                    <i class="fa fa-comment"></i>
                                                    <p>1256</p>
                                                </div>
                                                <div class="col-4">
                                                    <i class="fa fa-user"></i>
                                                    <p>8562</p>
                                                </div>
                                                <div class="col-4">
                                                    <i class="fa fa-suitcase"></i>
                                                    <p>189</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the
                                            printing and typesetting industry.</p>
                                        <hr>
                                        <div class="row justify-content-center user-social-link">
                                            <div class="col-auto"><a href="#!"><i
                                                        class="fa fa-facebook text-facebook"></i></a></div>
                                            <div class="col-auto"><a href="#!"><i
                                                        class="fa fa-twitter text-twitter"></i></a></div>
                                            <div class="col-auto"><a href="#!"><i
                                                        class="fa fa-dribbble text-dribbble"></i></a></div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
    </div>
    <div class="card-body">

        <form>
            <div class="row">
                <div class="col">
                    <label>Firstname:</label>
                    <input type="text" class="form-control report-filter" name="date_from" table-column="date" placeholder="">
                </div>
                <div class="col">
                    <label>Lastname:</label>
                    <input type="text" class="form-control report-filter" name="date_to" table-column="date" placeholder="">
                </div>
                
            

            </div>
        </form>
    </div>

</div>

</div>

</div>


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