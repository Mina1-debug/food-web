<?php 
    require 'config/includes/core.inc.php';

    if(isset($_SESSION['login']) && $_SESSION['role'] == "Waiter") {
        echo "<script>window.location = '../../wonder copy.php';</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/general.css">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <?php if (isset($login) && $login === 'no'): ?>
    <link rel="stylesheet" href="style.css">
    <?php endif?>
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    

    <!-- CSS only -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->

    <!--Load the AJAX API-->
    <script type="text/javascript" src="js/loader.js"></script>

</head>

<body>

    <?php if (isset($login) && $login === 'yes'): ?>

    <!--USER LOGGED IN-->
    <!--MAIN  CONTAINER-->
    <div class="w-100 h-100 container-fluid p-0 bg-light">

        <!--MAIN ROW-->
        <div class="row h-100 no-gutters">

            <!--NAV COLUMN-->
            <aside class="col-sm-2 h-100 bg-dark">

                <!--COMPANY NAME-->
                <header class="d-flex flex-wrap align-content-center justify-content-center border-light">
                    <div class="h_fit">
                        <strong class="company_name text-light text_lg">Corner Inn Eatery</strong>
                    </div>
                </header>

                <!-NAVS-->
                    <article>
                        <ul class="nav h-90 nav-pills nav-justified flex-column">

                            <!--DASHBOARD-->
                            <button onclick="location.href='config/process/nav.proc.php?nav=display&display=dashboard'"
                                class="btn <?php if ($display === 'dashboard'){echo 'btn-nav-active';} else {echo 'btn-nav';} ?> text-left pointer rounded-0 d-flex flex-wrap align-content-center justify-content-between">

                                <!--ICON-->
                                <span class="w-20"><img src="assets/icons/dashboard.png" class="img-fluid"></span>
                                <!--DESCRIPTION-->
                                <span class="w-80">Dashboard</span>

                            </button>

                            <!--MENU-->
                            <button
                                onclick="location.href='config/process/nav.proc.php?nav=display&display=menu_master'"
                                class="btn <?php if ($display === 'menu_master'){echo 'btn-nav-active';} else {echo 'btn-nav';} ?> text-left pointer rounded-0 d-flex flex-wrap align-content-center justify-content-between">

                                <!--ICON-->
                                <span class="w-20"><img src="assets/icons/menu_master.png" class="img-fluid"></span>
                                <!--DESCRIPTION-->
                                <span class="w-80">Menu Master</span>

                            </button>

                            <!--USER MANAGEMENT-->
                            <button onclick="location.href='config/process/nav.proc.php?nav=display&display=user_mgmt'"
                                class="btn <?php if ($display === 'user_mgmt'){echo 'btn-nav-active';} else {echo 'btn-nav';} ?> text-left pointer rounded-0 d-flex flex-wrap align-content-center justify-content-between">

                                <!--ICON-->
                                <span class="w-20"><img src="assets/icons/user_mgmt.png" class="img-fluid"></span>
                                <!--DESCRIPTION-->
                                <span class="w-80">User Management</span>

                            </button>

                            <!--REPORTS-->
                            <button onclick="location.href='config/process/nav.proc.php?nav=display&display=report'"
                                class="btn <?php if ($display === 'report'){echo 'btn-nav-active';} else {echo 'btn-nav';} ?> text-left pointer rounded-0 d-flex flex-wrap align-content-center justify-content-between">

                                <!--ICON-->
                                <span class="w-20"><img src="assets/icons/reports.png" class="img-fluid"></span>
                                <!--DESCRIPTION-->
                                <span class="w-80">Reports</span>

                            </button>

                        </ul>
                    </article>

            </aside>


            <!--WORKSPACE-->
            <section class="col-sm-10 h-100 bg-light">
                <!--HEADER-->
                <header class="bg-dark d-flex flex-wrap align-content-center">
                    <!--DISPLAY-->
                    <div class="w-50 h-100 pl-2 d-flex flex-wrap align-content-center">
                        <div class="h_fit text-light">
                            <strong>
                                <?php if ($display === 'menu_master'){ echo 'Menu';} elseif ($display==='user_mgmt'){ echo 'User Management'; } else { echo $display;} ?>
                            </strong>
                        </div>

                    </div>

                    <!--USERNAME AND LOGOUT-->
                    <div class="w-50 h-100 pr-2 d-flex flex-wrap align-content-center justify-content-end">

                        <kbd class="mr-2">@
                            <?php echo $_SESSION['username'] ?>
                        </kbd>

                        <!--LOGOUT BTN-->
                        <button onclick="location.href='config/process/user_process.php?logout'"
                            class="btn btn-danger btn-sm">Logout</button>
                    </div>

                </header>

                <!--WORK-->
                <article class="p-2 overflow-hidden">

                    <?php if ($display === 'dashboard'): ?>
                    <!--DASHBOARD-->

                    <!--TOP CARDS-->
                    <div class="w-100 h-25 container p-0">

                        <div class="row no-gutters h-100 w-100">

                            <!--CARD 1 Daly Earning-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover pointer h-100">
                                    <div class="card-header bg-dark text-light"><strong class="card-title">Daily
                                            Sales</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">
                                                <?php echo $totalPayment ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--CARD 2-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover h-100">

                                    <div class="card-header text-light bg-dark"><strong class="card-title">Weekly
                                            Sales</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">
                                                <?php echo $totalOrder ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!--CARD 3-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover h-100">

                                    <div class="card-header bg-dark text-light"><strong class="card-title">Fast moving
                                            food</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">Banku</p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!--TOP CARDS-->
                    <div class="w-100 h-100 container p-0 overflow-hidden">

                        <div class="row no-gutters h_fit mt-3 w-100">



                            <!--CARD 1 Daly Earning-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover pointer h-100">
                                    <div class="card-header bg-dark text-light"><strong class="card-title">Daily
                                            Orders</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">
                                                <?php echo $totalPayment ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--CARD 2-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover h-100">

                                    <div class="card-header text-light bg-dark"><strong class="card-title">Weekly
                                            Orders</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">
                                                <?php echo $totalOrder ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!--CARD 3-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover h-100">

                                    <div class="card-header bg-dark text-light"><strong class="card-title">Least moving
                                            food</strong></div>

                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">Yam</p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <?php endif; ?>

                    <?php if ($display === 'menu_master'): ?>
                    <!--MENU-->

                    <!--TOP CARDS-->
                    <div class="w-100 h-25 container p-0">

                        <div class="row no-gutters h-100 w-100">

                            <!--CARD 1-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover border-0 shadow pointer h-100">
                                    <div class="card-header bg-info"><strong class="card-title">Categories</strong>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">6</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--CARD 2-->
                            <div class="col-sm-4 p-2">

                                <div class="card border-0 h-100">

                                    <div class="card card_hover border-0 shadow pointer h-100">
                                        <div class="card-header bg-success"><strong class="card-title">Menu
                                                Items</strong></div>
                                        <div class="card-body">
                                            <div
                                                class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                <p class="text_xxl p-0 m-0">
                                                    <?php echo 20 ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!--CARD 3-->
                            <div class="col-sm-4 p-2">

                                <div class="card border-0 h-100">

                                    <div class="card card_hover border-0 shadow pointer h-100">
                                        <div class="card-header bg-primary"><strong class="card-title">Most
                                                Sold</strong></div>
                                        <div class="card-body">
                                            <div
                                                class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                <p class="text_xxl p-0 m-0">Banku</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!--BOTTOM-->
                    <div class="h-75 p-2 w-100">

                        <div class="card shadow border-0 h-100">
                            <!--HOME-->


                            <div
                                class="w-100 h-100 overflow-hidden d-flex flex-wrap justify-content-center align-content-center">
                                <div class="w-75 h-90 container">

                                    <div class="row no-gutters h-100" style="background: #2D2D2A">

                                        <div class="col-sm-3 p-2 h-100" style="background: #3F5E5A">
                                            <button onclick="location.href='config/process/nav.proc.php?sub=category'"
                                                class="<?php if ($sub === 'category') {echo 'btn-nav-active'; } else {echo 'btn-nav';} ?> btn text-left mb-1 w-100">
                                                <strong>Category</strong>
                                            </button>
                                            <button onclick="location.href='config/process/nav.proc.php?sub=menu_item'"
                                                class="<?php if ($sub === 'menu_item') {echo 'btn-nav-active'; } else {echo 'btn-nav';}?> mb-1 text-left btn w-100">
                                                <strong>Menu Item</strong>
                                            </button>
                                        </div>

                                        <!--DETAILS-->
                                        <div class="col-sm-9 p-2 h-100">


                                            <!--HEADER-->
                                            <header
                                                class="<?php if ($view == 'new' || $view == 'edit' || $view == 'view'){echo 'bg-header';} ?>">
                                                <div class="w-100 h-100 d-flex flex-wrap align-content-center pl-2">

                                                    <?php if ($view === 'new'): ?>

                                                    <!--NEW ITEM-->

                                                    <!--SAVE BUTTON-->
                                                    <button name="save" form="new" data-toggle="tooltip" title="Save"
                                                        class="btn p-0">
                                                        <?php

                                                                                        $save = 'assets/icons/save.png';
                                                                                        $saveDate = base64_encode(file_get_contents($save));
                                                                                        $savSsrc = 'data: '.mime_content_type($save).';base64,'.$saveDate;

                                                                                    ?>
                                                        <img class="img-fluid p-0" src="<?php echo $savSsrc ?>">
                                                    </button>

                                                    <!--CANCEL-->
                                                    <button
                                                        onclick="location.href='config/process/nav.proc.php?view=view'"
                                                        data-toggle="tooltip" title="Cancel" class="ml-1 btn p-0">
                                                        <?php

                                                                                        $cancel = 'assets/icons/cancel.png';
                                                                                        $cancelDate = base64_encode(file_get_contents($cancel));
                                                                                        $cancelsrc = 'data: '.mime_content_type($cancel).';base64,'.$cancelDate;

                                                                                    ?>
                                                        <img class="img-fluid p-0" src="<?php echo $cancelsrc ?>">
                                                    </button>

                                                    <?php endif; ?>

                                                    <?php if ($view === 'view' && $vq === '*'): ?>

                                                    <!--VIEW-->

                                                    <!--ADD BUTTON-->
                                                    <button
                                                        onclick="location.href='config/process/nav.proc.php?view=new'"
                                                        data-toggle="tooltip" title="Add Category" class="btn p-0">
                                                        <?php

                                                            $add = 'assets/icons/add_new.png';
                                                            $addData = base64_encode(file_get_contents($add));
                                                            $addSsrc = 'data: '.mime_content_type($add).';base64,'.$addData;

                                                        ?>
                                                        <img class="img-fluid p-0" src="<?php echo $addSsrc ?>">
                                                    </button>


                                                    <?php endif; ?>

                                                    <?php if ($view === 'view' && $vq === '~'): ?>

                                                    <button
                                                        onclick="location.href='config/process/menu-master.php?vq=`'"
                                                        data-toggle="tooltip" title="Edit" class="btn p-0">
                                                        <?php

                                                                        $edit = 'assets/icons/edit.png';
                                                                        $editData = base64_encode(file_get_contents($edit));
                                                                        $editSsrc = 'data: '.mime_content_type($edit).';base64,'.$editData;

                                                                        ?>
                                                        <img class="img-fluid p-0" src="<?php echo $editSsrc ?>">
                                                    </button>

                                                    <button
                                                        onclick="location.href='config/process/menu-master.php?vq=*'"
                                                        data-toggle="tooltip" title="View All" class="btn ml-2 p-0">
                                                        <?php

                                                                        $edit = 'assets/icons/view_all.png';
                                                                        $editData = base64_encode(file_get_contents($edit));
                                                                        $editSsrc = 'data: '.mime_content_type($edit).';base64,'.$editData;

                                                                        ?>
                                                        <img class="img-fluid p-0" src="<?php echo $editSsrc ?>">
                                                    </button>

                                                    <?php  endif; ?>

                                                    <?php if ($view === 'view' && $vq === '`'): ?>

                                                    <button form="saveEdit" name="edit" data-toggle="tooltip"
                                                        title="Save Edit" class="btn p-0">
                                                        <?php

                                                                        $edit = 'assets/icons/save.png';
                                                                        $editData = base64_encode(file_get_contents($edit));
                                                                        $editSsrc = 'data: '.mime_content_type($edit).';base64,'.$editData;

                                                                        ?>
                                                        <img class="img-fluid p-0" src="<?php echo $editSsrc ?>">
                                                    </button>

                                                    <button
                                                        onclick="location.href='config/process/menu-master.php?vq=~'"
                                                        data-toggle="tooltip" title="View All" class="btn ml-2 p-0">
                                                        <?php

                                                                        $edit = 'assets/icons/cancel_edit.png';
                                                                        $editData = base64_encode(file_get_contents($edit));
                                                                        $editSsrc = 'data: '.mime_content_type($edit).';base64,'.$editData;

                                                                        ?>
                                                        <img class="img-fluid p-0" src="<?php echo $editSsrc ?>">
                                                    </button>



                                                    <?php  endif; ?>

                                                </div>

                                            </header>

                                            <!--ARTICLE-->
                                            <article>

                                                <?php if ($view === 'view'): ?>

                                                <!--VIEW-->
                                                <?php if ($sub === 'category'): ?>

                                                <!--CATEGORY-->
                                                <div class="w-100 pt-2 h-100">

                                                    <!--CATEGORY-->


                                                    <?php if ($view === 'view'): ?>

                                                    <?php if ($count < 1): ?>
                                                    <!--ADD NEW CATEGORY-->
                                                    <div
                                                        class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                        <p onclick="location.href='config/process/nav.proc.php?view=new'"
                                                            class="ecn">Create Category</p>
                                                    </div>

                                                    <?php endif; ?>

                                                    <?php if ($count > 0): ?>
                                                    <!--CATEGORIES-->
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-striped table-hover">

                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th class="p-2 text_sm">Description</th>
                                                                    <th class="p-2 text_sm">Date Created</th>
                                                                    <th class="p-2 text_sm">Owner</th>
                                                                    <th class="p-2 text_sm">Items</th>
                                                                    <th class="p-2 text_sm">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php while ($food_cat = $food_cat_stmt->fetch(PDO::FETCH_ASSOC)): ?>

                                                                <?php
                                                                                                //get food count of category
                                                                                                $category = $food_cat['id'];

                                                                                                if (qRowCount("menu_items" , "`category` = $category" , $route) > 0)
                                                                                                {
                                                                                                    $items = qRowCount("menu_items" , "`category` = $category" , $route);
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    $items = 0;
                                                                                                }

                                                                                            ?>

                                                                <tr class="text-light pointer">
                                                                    <td class="p-2 text_xs">
                                                                        <?php echo $food_cat['description'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_xs">
                                                                        <?php echo $food_cat['date_created'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_xs">
                                                                        <?php echo $food_cat['owner'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_xs">
                                                                        <?php echo $items ?>
                                                                    </td>
                                                                    <td class="p-2 text_xs">
                                                                        <div class="dropdown dropleft">
                                                                            <img class="img-fluid"
                                                                                data-toggle="dropdown"
                                                                                src="assets/icons/more.png">
                                                                            <div class="dropdown-menu">
                                                                                <a data-toggle="modal"
                                                                                    data-target="#modCat<?php echo $category ?>"
                                                                                    class="dropdown-item text-info">Modify</a>
                                                                                <a data-toggle="modal"
                                                                                    data-target="#editCat<?php echo $category ?>"
                                                                                    class="dropdown-item text-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <!--EDIT MODAL-->
                                                                <div class="modal fade"
                                                                    id="editCat<?php echo $category ?>">
                                                                    <div class="modal-dialog modal-dialog-centered">

                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <strong class="modal-title">Deleting
                                                                                    <?php echo $food_cat['description'] ?>
                                                                                </strong>
                                                                                <button class="close"
                                                                                    data-dismiss="modal">&times;</button>
                                                                            </div>

                                                                            <div class="modal-body p-2">
                                                                                <div class="w-75 mx-auto text-center">
                                                                                    <?php if ($items > 0): ?>
                                                                                    <div class="alert alert-danger">
                                                                                        <strong>Sorry!!</strong> You
                                                                                        cant delete
                                                                                        <?php echo $food_cat['description'] ?>
                                                                                        because it has items
                                                                                    </div>
                                                                                    <?php endif; ?>

                                                                                    <?php if ($items < 1): ?>

                                                                                    <div class="alert alert-success">
                                                                                        Are you sure you want to delete
                                                                                        <?php echo $food_cat['description'] ?>?
                                                                                        <div
                                                                                            class="w-50 mx-auto mt-2 clearfix">
                                                                                            <button
                                                                                                class="btn btn-sm btn-info w-30 float-left"
                                                                                                data-dismiss="modal">NO</button>
                                                                                            <button
                                                                                                class="btn btn-sm btn-danger w-30 float-right"
                                                                                                onclick="location.href='config/process/menu-master.php?del&id=<?php echo $category ?>'">YES</button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <!--MODIFY MODAL-->
                                                                <div class="modal fade"
                                                                    id="modCat<?php echo $category ?>">
                                                                    <div class="modal-dialog modal-dialog-centered">

                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <strong class="modal-title">Rename
                                                                                    <?php echo $food_cat['description'] ?>
                                                                                </strong>
                                                                                <button class="close"
                                                                                    data-dismiss="modal">&times;</button>
                                                                            </div>

                                                                            <div class="modal-body p-2">
                                                                                <div class="w-50 mx-auto">
                                                                                    <form method="post"
                                                                                        action="config/process/menu-master.php"
                                                                                        class="w-50 mx-auto text-center">
                                                                                        <input name="new_name"
                                                                                            type="text"
                                                                                            value="<?php echo $food_cat['description'] ?>"
                                                                                            autocomplete="off" required
                                                                                            class="form-control text-center mb-2">
                                                                                        <input type="hidden" name="id"
                                                                                            value="<?php echo $food_cat['id'] ?>">
                                                                                        <input type="hidden"
                                                                                            name="curr_name"
                                                                                            value="<?php echo $food_cat['description'] ?>">

                                                                                        <div class="mt-2 text-center">
                                                                                            <button
                                                                                                class="btn btn-sm btn-success"
                                                                                                name="edit">COMMIT</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <?php endwhile; ?>

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php endif; ?>



                                                </div>

                                                <?php endif; ?>

                                                <?php if ($sub === 'menu_item'): ?>

                                                <!--MENU ITEM-->
                                                <div class="w-100 h-100">

                                                    <?php if ($view === 'view'): ?>

                                                    <?php if ($count < 1): ?>

                                                    <div
                                                        class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                        <p onclick="location.href='config/process/nav.proc.php?view=new'"
                                                            class="ecn">Create Menu Item</p>
                                                    </div>

                                                    <?php endif; ?>

                                                    <?php if ($count > 0): ?>

                                                    <?php if ($vq === '*'): ?>

                                                    <div class="table-responsive-sm pt-1">
                                                        <table class="table table-borderless table-striped">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th class="p-2 text_sm">Description</th>
                                                                    <th class="p-2 text_sm">Category</th>
                                                                    <th class="p-2 text_sm">Retail Price</th>
                                                                    <th class="p-2 text_sm">Cost Price</th>
                                                                    <th class="p-2 text_sm">Owner</th>
                                                                    <th class="p-2 text_sm">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody class="text-light">
                                                                <?php while ($item = $menu_items_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                                <?php $itemId = $item['id']; ?>

                                                                <tr>
                                                                    <td class="p-2 text_smla">
                                                                        <?php echo $item['description'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_smla">
                                                                        <?php echo $item['category'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_smla">
                                                                        <?php echo $item['retail_price'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_smla">
                                                                        <?php echo $item['cost_price'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_smla">
                                                                        <?php echo $item['owner'] ?>
                                                                    </td>
                                                                    <td class="p-2 text_smla">
                                                                        <div class="dropdown dropleft">
                                                                            <img data-toggle="dropdown"
                                                                                class="img-fluid pointer"
                                                                                src="assets/icons/more.png">
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item text-info pointer"
                                                                                    onclick="location.href='config/process/menu-master.php?vq=~&id=<?php echo $itemId ?>'">View</a>

                                                                                <a data-toggle="modal"
                                                                                    data-target="#delItem<?php echo $item['id'] ?>"
                                                                                    class="dropdown-item text-danger pointer">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <!--DELETE MODAL-->
                                                                <div class="modal fade"
                                                                    id="delItem<?php echo $item['id'] ?>">

                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <strong class="modal-title">Deleting
                                                                                    <?php echo $item['description'] ?>
                                                                                </strong>
                                                                                <button class="close"
                                                                                    data-dismiss="modal">&times;</button>
                                                                            </div>

                                                                            <div class="modal-header">
                                                                                <div
                                                                                    class="w-75 text-center alert alert-danger p-2 mx-auto">
                                                                                    Are you sure you want to delete
                                                                                    <?php echo $item['description'] ?>
                                                                                    <div class="w-75 mx-auto clearfix">
                                                                                        <button
                                                                                            class="btn btn-info btn-sm float-left w-30">
                                                                                            NO
                                                                                        </button>

                                                                                        <button
                                                                                            onclick="location.href='config/process/menu-master.php?del&id=<?php echo $item['id'] ?>'"
                                                                                            class="btn btn-danger btn-sm float-right w-30">
                                                                                            YES
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <?php endwhile; ?>
                                                            </tbody>

                                                        </table>
                                                    </div>

                                                    <?php endif; ?>

                                                    <!--VIEW SINGLE-->
                                                    <?php if ($vq === '~'): ?>

                                                    <div class="w-100 d-flex flex-wrap h-100 overflow-hidden">

                                                        <div class="w-50 p-2 text-light">

                                                            <!--DESCRIPTION-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Description
                                                                </p>
                                                                <div class="w-70 detail pl-1 text_smla float-right">
                                                                    <?php echo $itemDet['description'] ?>
                                                                </div>
                                                            </div>

                                                            <!--Category-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Category
                                                                </p>
                                                                <div class="w-70 detail pl-1 text_smla float-right">
                                                                    <?php echo $itemDet['category'] ?>
                                                                </div>
                                                            </div>

                                                            <!--Tax-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Tax
                                                                </p>
                                                                <div class="w-70 detail pl-1 text_smla float-right">
                                                                    <?php echo $itemDet['tax'] ?>%
                                                                </div>
                                                            </div>

                                                            <!--Cost Price-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Cost Price
                                                                </p>
                                                                <div class="w-70 detail pl-1 text_smla float-right">
                                                                    ghc
                                                                    <?php echo $itemDet['cost_price'] ?>
                                                                </div>
                                                            </div>

                                                            <!--Retail Price-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Retail Price
                                                                </p>
                                                                <div class="w-70 detail pl-1 text_smla float-right">
                                                                    ghc
                                                                    <?php echo $itemDet['retail_price'] ?>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="w-50 p-2 text-light">

                                                            <!--INFO-->
                                                            <div class="w-100 overflow-hidden">
                                                                <!--Owner-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Owner
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['owner'] ?>
                                                                    </div>
                                                                </div>

                                                                <!--Date-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Date Created
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['date_created'] ?>
                                                                    </div>
                                                                </div>

                                                                <!--Time Created-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Time Created
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['time_created'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--RECIPE-->
                                                            <div
                                                                class="w-100 card bg-info shadow h-50 mt-2 overflow-hidden">

                                                                <div class="card-header">
                                                                    <strong class="card-title">Recipe</strong>
                                                                </div>

                                                                <div class="card-body p-1">
                                                                    <div class="w-100 d-flex flex-wrap">

                                                                        <?php
                                                                                                        $recipe = $itemDet['recipe'];
                                                                                                        $exp_rec = explode(',' , $recipe);

                                                                                                    ?>

                                                                        <?php foreach ($exp_rec as $key => $value) {
                                                                                                        echo "<kbd class='m-1'>".$value."</kbd>";
                                                                                                    } ?>



                                                                    </div>
                                                                </div>

                                                            </div>


                                                        </div>

                                                    </div>

                                                    <?php endif; ?>

                                                    <!--EDIT-->
                                                    <?php if ($vq === '`'): ?>

                                                    <form id="saveEdit" method="post"
                                                        action="config/process/menu-master.php"
                                                        class="w-100 d-flex flex-wrap h-100 overflow-hidden"
                                                        enctype="multipart/form-data">

                                                        <div class="w-50 p-2 text-light">

                                                            <!--DESCRIPTION-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Description
                                                                </p>
                                                                <input class="w-70 detail pl-1 text_smla float-right"
                                                                    value="<?php echo $itemDet['description'] ?>"
                                                                    name="desc" autocomplete="off">
                                                            </div>

                                                            <!--Category-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Category
                                                                </p>
                                                                <select name="category" class="detail pl-1 w-70">
                                                                    <?php while ($cat = $food_cat_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                                    <?php if ($itemDet['category'] === $cat['id']): ?>
                                                                    <option selected value="<?php echo $cat['id'] ?>">
                                                                        <?php echo $cat['description'] ?>
                                                                    </option>
                                                                    <?php endif; ?>

                                                                    <?php if ($itemDet['category'] !== $cat['id']): ?>
                                                                    <option selected value="<?php echo $cat['id'] ?>">
                                                                        <?php echo $cat['description'] ?>
                                                                    </option>
                                                                    <?php endif; ?>
                                                                    <?php endwhile; ?>
                                                                </select>
                                                            </div>



                                                            <!--Tax-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Tax
                                                                </p>
                                                                <input class="w-70 detail pl-1 text_smla float-right"
                                                                    value="<?php echo $itemDet['tax'] ?>" name="tax"
                                                                    autocomplete="off">
                                                            </div>

                                                            <!--Cost Price-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Cost Price
                                                                </p>
                                                                <input class="w-70 detail pl-1 text_smla float-right"
                                                                    value="<?php echo $itemDet['cost_price'] ?>"
                                                                    name="cost" autocomplete="off">
                                                            </div>

                                                            <!--Retail Price-->
                                                            <div class="w-100 m-2 clearfix">
                                                                <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                    Retail Price
                                                                </p>
                                                                <input class="w-70 detail pl-1 text_smla float-right"
                                                                    value="<?php echo $itemDet['retail_price'] ?>"
                                                                    name="retail" autocomplete="off">
                                                            </div>

                                                            <!--UPLOAD FOOD IMAGE-->
                                                            <input type='file' name='item_image'>

                                                        </div>

                                                        <div class="w-50 p-2 text-light">

                                                            <!--INFO-->
                                                            <div class="w-100 overflow-hidden">
                                                                <!--Owner-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Owner
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['owner'] ?>
                                                                    </div>
                                                                </div>

                                                                <!--Date-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Date Created
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['date_created'] ?>
                                                                    </div>
                                                                </div>

                                                                <!--Time Created-->
                                                                <div class="w-100 m-2 clearfix">
                                                                    <p class="m-0 bold text_sm p-0 w-30 float-left">
                                                                        Time Created
                                                                    </p>
                                                                    <div class="w-70 detail pl-1 text_smla float-right">
                                                                        <?php echo $itemDet['time_created'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--RECIPE-->
                                                            <div
                                                                class="w-100 card bg-info shadow h-50 mt-2 overflow-hidden">

                                                                <div class="card-header">
                                                                    <strong class="card-title">Recipe</strong>
                                                                </div>

                                                                <div class="card-body p-1">
                                                                    <div class="w-100 d-flex flex-wrap">

                                                                        <?php
                                                                                                    $recipe = $itemDet['recipe'];
                                                                                                    $exp_rec = explode(',' , $recipe);

                                                                                                    ?>

                                                                        <textarea name="recipe" class="detail w-100"
                                                                            rows="5"><?php echo $recipe ?></textarea>



                                                                    </div>
                                                                </div>

                                                            </div>


                                                        </div>

                                                    </form>

                                                    <?php endif; ?>


                                                    <?php endif; ?>

                                                    <?php endif; ?>

                                                </div>

                                                <?php endif; ?>

                                                <?php endif; ?>


                                                <?php if ($view === 'new'): ?>

                                                <form id="new" method="post" action="config/process/menu-master.php"
                                                    class="w-50 pt-2">
                                                    <!--NEW-->
                                                    <?php if ($sub === 'category'): ?>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Description</span>
                                                        </div>
                                                        <input type="text" name="cat_description" autocomplete="off"
                                                            required class="form-control form-control-sm">
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if ($sub === 'menu_item'): ?>

                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Description</span>
                                                        </div>
                                                        <input
                                                            value="<?php if (isset($_SESSION['food'])){echo $_SESSION['food'];} ?>"
                                                            type="text" name="description" autocomplete="off" required
                                                            class="form-control form-control-sm">
                                                    </div>

                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Category</span>
                                                        </div>
                                                        <select name="cat" required
                                                            class="form-control form-control-sm">
                                                            <option value="0">Select Category</option>
                                                            <?php while ($cat = $food_cat_stmt->fetch(PDO::FETCH_ASSOC)): ?>

                                                            <option value="<?php echo $cat['id'] ?>">
                                                                <?php echo $cat['description'] ?>
                                                            </option>

                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>

                                                    <!--COST-->
                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Cost ghc</span>
                                                        </div>
                                                        <input type="text" name="cost" autocomplete="off"
                                                            placeholder="without currency" required
                                                            class="form-control form-control-sm">
                                                    </div>

                                                    <!--RETAIL PRICE-->
                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Retail ghc</span>
                                                        </div>
                                                        <input type="text" name="retail" placeholder="without currency"
                                                            autocomplete="off" required
                                                            class="form-control form-control-sm">
                                                    </div>

                                                    <!--TAX-->
                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Tax Rate</span>
                                                        </div>
                                                        <input type="text" name="tax" autocomplete="off"
                                                            placeholder="Without Percentage" required
                                                            class="form-control form-control-sm">
                                                    </div>

                                                    <!--RECIPE-->
                                                    <div class="input-group input-group-sm mb-2">
                                                        <div class="input-group-prepend w-30">
                                                            <span class="input-group-text w-100">Recipe</span>
                                                        </div>
                                                        <input type="text" name="recipe"
                                                            placeholder="Separated by comma (,)" autocomplete="off"
                                                            required class="form-control form-control-sm">
                                                    </div>

                                                    <?php endif; ?>
                                                </form>

                                                <?php endif; ?>

                                            </article>

                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>

                    </div>

                    <?php endif; ?>

                    <?php if ($display === 'user_mgmt'): ?>
                    <!--USER MGMT-->







                    

                    <!--TOP CARDS-->
                    <div class="w-100 h-25 container p-0">

                        <div class="row no-gutters h-100 w-100">

                            <!--CARD 1-->
                            <div class="col-sm-4 p-2">

                                <div class="card card_hover border-0 shadow pointer h-100">
                                    <div class="card-header bg-info"><strong class="card-title">User Groups</strong>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                            <p class="text_xxl p-0 m-0">
                                                <?php echo $group_count ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--CARD 2-->
                            <div class="col-sm-4 p-2">

                                <div class="card border-0 h-100">

                                    <div class="card card_hover border-0 shadow pointer h-100">
                                        <div class="card-header bg-success"><strong class="card-title">Users</strong>
                                        </div>
                                        <div class="card-body">
                                            <div
                                                class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                <p class="text_xxl p-0 m-0">
                                                    <?php echo $users_count ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!--CARD 3-->
                            <div class="col-sm-4 p-2">

                                <div class="card border-0 h-100">

                                    <div class="card card_hover border-0 shadow pointer h-100">
                                        <div class="card-header bg-primary"><strong class="card-title">Total number of
                                                waiters</strong></div>
                                        <div class="card-body">
                                            <div
                                                class="w-100 h-100 d-flex flex-wrap align-content-center justify-content-center">
                                                <p class="text_xxl p-0 m-0">0</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!--BOTTOM-->
                    <div class="h-75 p-2 w-100">

                        <div class="card h-100">
                            <header class="border d-flex flex-wrap">
                                <button onclick="location.href='config/process/nav.proc.php?view=new'"
                                    data-toggle="tooltip" title="New User Group" class="btn p-0">
                                    <?php

                                        $add = 'assets/icons/add_new.png';
                                        $addData = base64_encode(file_get_contents($add));
                                        $addSsrc = 'data: '.mime_content_type($add).';base64,'.$addData;

                                    ?>
                                    <img class="img-fluid p-0" src="<?php echo $addSsrc ?>">
                                </button>
                                <button onclick="location.href='config/process/nav.proc.php?view=edit'"
                                    data-toggle="tooltip" title="Edit" class="btn p-0">
                                    <?php

                                        $add = 'assets/icons/edit.png';
                                        $addData = base64_encode(file_get_contents($add));
                                        $addSsrc = 'data: '.mime_content_type($add).';base64,'.$addData;

                                    ?>
                                    <img class="img-fluid p-0" src="<?php echo $addSsrc ?>">
                                </button>
                                <button onclick="location.href='config/process/nav.proc.php?view=view'"
                                    data-toggle="tooltip" title="Delete" class="btn p-0">
                                    <?php

                                        $add = 'assets/icons/cancel.png';
                                        $addData = base64_encode(file_get_contents($add));
                                        $addSsrc = 'data: '.mime_content_type($add).';base64,'.$addData;

                                    ?>
                                    <img class="img-fluid p-0" src="<?php echo $addSsrc ?>">
                                </button>
                            </header>

                            <article>
                                <?php if($sub === 'group'): ?>

                                 <!-- Page Wrapper -->
    <div id="wrapper">


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
              <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Facilities</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th> View/Edit/Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>View/Edit/Delete</th>
                    
                            </tfoot>
                            <tbody>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td>Mina</td>
                                    <td>Admin</td>
                                    <td><i class="fa fa-eye mr-2" style="color:  #228b22;"></i><i class="fa fa-edit ml-2" style="color:  #4e73df;"></i><i class="fa fa-trash ml-4"  style="color: rgba(211, 44, 44, 0.741);"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td>Ocar</td>
                                    <td>Waiter</td>
                                    <td><i class="fa fa-eye mr-2" style="color:  #228b22;"></i><i class="fa fa-edit ml-2" style="color:  #4e73df;"></i><i class="fa fa-trash ml-4"  style="color: rgba(211, 44, 44, 0.741);"></i></td>
                                </tr>
                                
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td>Gerald</td>
                                    <td>waiter</td>
                                    <td><i class="fa fa-eye mr-2" style="color:  #228b22;"></i><i class="fa fa-edit ml-2" style="color:  #4e73df;"></i><i class="fa fa-trash ml-4"  style="color: rgba(211, 44, 44, 0.741);"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->



                                <?php endif; ?>
                            </article>
                        </div>

                    </div>

                    <?php endif; ?>



                </article>
            </section>

        </div>

    </div>

    <?php endif; ?>


    <?php if (isset($login) && $login === 'no'): ?>

    <!--USER NOT LOGGED-->
    <!--LOGIN FORM-->

    <div style="background-image: url('assets/bg/rest_kit1.jpg');" class="w-100 bg_img h-100">

        <div class="w-100 h-100 d-flex bg_t80 flex-wrap align-content-center justify-content-center">

            <div class="card shadow w-25">
                <div class="card-body">

                    <form action="config/process/user_process.php" method="post" class='w-100'>

                    <img src="./inn.png" alt="logo" width="120px" height="70px" class ="logo">
                    
                        <h3 class="text_lg bold text-center mb-3">Admin Login</h3>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <i class="text_sm text-info">
                                <?php
                                        if (isset($_SESSION['username_err']))
                                        {
                                            echo $_SESSION['username_err'];
                                            unset ($_SESSION['username_err']);
                                        }
                                    ?>
                            </i>
                        </div>

                        
                                
                             <!--PASSWORD-->
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>
                                
                                                      
                                                        <div class="mb-3">
                                                            <i class="text_sm text-warning">
                                                                <?php
                                                                        if (isset($_SESSION['password_err']))
                                                                        {
                                                                            echo $_SESSION['password_err'];
                                                                            unset ($_SESSION['password_err']);
                                                                        }
                                                                    ?>
                                                            </i>
                                                        </div>
                                                       
                                                        <button class="btn btn-info w-100" name="login"><i class="fas fa-sign-in-alt"></i> LOGIN</button>
                                                    

                                                     
                                                    </form>
                                
                                                </div>
                                            </div>
                                
                                        </div>
                                
                                    </div>
                                
                                
                                
                                    <?php endif; ?>
                                
                                
                                </body>
                                
                                </html>
        
                                
            


<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<!-- Popper JS -->
<script src="js/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>