<?php
    include 'core/conn.php';
    if(!isset($_SESSION['user_details'])) {
        header("Location: index.php");
    } else {
        if($_SESSION['user_details']['role'] != "Waiter") header("Location: index.php");
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corner Inn Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/2.5.1/css/bootstrap.min.css">

</head>

<body>
    <div class="header">
        <img src="images/Gro.png" alt="logo" width="50px" height="30px" />
        <h6>Food Factory</h6>
        <h2>Food Sales App</h2> 
        <!--LOGOUT BTN-->
        <div class="button">
        <button class="btn btn-danger btn-sm btn-action" action-type="logout">Logout</button>
    </div>
</div>
<br>
<h4 class="mina">Menu</h4>



</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 mx-auto bg-light rounded p-0">
            <form id="search_form" action="details.php" method="post" class="p-0">
                <div class="input-group">
                    <input type="text" name="search" id="search"
                        class="form-control form-control-md rounded-0 border-info" placeholder="Search..."
                        autocomplete="off" required>
                        <div class="input-group-append">
                            <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5" style="position: relative;margin-top: -38px;margin-left: 215px;">
                <div class="list-group" id="show-list">
                    <!-- Here autocomplete list will be display -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="wonder">
        <div class="txt">
            <h6><?php echo ucwords($_SESSION['user_details']['first_name']);?>'s Total Daily Sales :
                <?php
                $count = mysqli_query($conn, 'SELECT * FROM food_payment WHERE user_id = "' . $_SESSION['user_details']['id'] . '" AND date_created LIKE "'. date("Y-m-d") .'%"');
                echo "(" . mysqli_num_rows($count). ")";
                $price = 0;
                while($result = mysqli_fetch_array($count)) {
                    $price = $price + $result['amount'];
                }
                echo " GHS " . number_format($price, 2);
            ?>
            </h6>
        </div>
    </div>
    

    <div class="container">
        <div class="row">

            <?php
                $sql = mysqli_query($conn, 'SELECT * FROM foods');
                
                while($result = mysqli_fetch_array($sql)) {
                    $selected_accompaniment;
                    $option_string = '';

                    $accomplaniment = mysqli_query($conn, "SELECT * FROM accompaniment WHERE food_item = {$result['id']}");
                    $acc_count = mysqli_num_rows($accomplaniment);
                    $accom = mysqli_fetch_all($accomplaniment, MYSQLI_ASSOC);

                    foreach ($accom as $value) {
                        $option_string .= '<option value="'. $value['id'] .'">'. $value['name'] .'</option>';
                    }

                    // while($acc = mysqli_fetch_array($accomplaniment)) {
                    
                     echo '

                            <div class="col-md-4">


                                <!-- Button trigger modal -->
                                <div class="card shadow" data-bs-t+oggle="modal" data-bs-toggle="modal" data-bs-target="#food_'. $result['id'] .'">
                                    <!-- <div class=""> --> 
                                        <img src="images/uploads/'. $result['image'] .'" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">'. $result['name'] . '</h5>
                                            <p class="card-text">'. $result['name'] . ($acc_count > 0 ? ' with ' . $accom[0]['name'] : '' ) .'.</p>
                                        </div>
                                    <!-- </div> -->
                                </div>
                
                                <!-- Modal -->
                                <div id="food_'. $result['id'] .'" class="modal fade" data="food_'. $result['id'] .'" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-center">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title text-center" id="exampleModalLabel">'.$result['name'].'</h5>
                                                <button type="button" class="btn-close bg-light btn-outline-light" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h2>Order Form</h3>
                                                <div class="p-3 m-3" style="border: solid 2px rgb(180, 179, 179);">
                                                    <h4>Food Item</h4>
                                                    <form action-type="food_payment" autocomplete="off">
                                                        <div class="mb-4">  
                                                            <input name="name" type="text" class="form-control rounded-pill mb-4" placeholder="Name" autocomplete="off" required>
                                                            <input name="contact" type="text"  class="form-control rounded-pill mb-4" placeholder="Contact" required>
                                                            <input name="amount" type="number" min="5" class="form-control rounded-pill mb-4" placeholder="Amount (Ghs)" required>
                                                            <select name="food" class="form-control rounded-pill mb-4" required>
                                                                <option value="'.$result['id'].'" selected>'.$result['name'].'</option>
                                                            </select>
                                                                
                                                            <select name="accompaniment" class="form-select rounded-pill mb-4" required>
                                                                '. $option_string .'
                                                            </select>   
                                                        </div>
                                                        <button type="submit" class="btn btn-outline-dark" style="padding: 10px 30px;">Pay</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        
                        ';
                    // }

                }
            ?>




        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $(".modal-body form").on("submit", function(e) {
                e.preventDefault();

                var _formData = new FormData(this);
                _formData.append("action", $(this).attr("action-type"))

                $.ajax({
                    url: "core/mina.php",
                    method: "post",
                    data: _formData,
                    dataType: "json",
                    cache: false,
                    processData: false,
                    contentType: false,
                    error: (e, i) => {
                        Swal.fire({
                            title: "error",
                            text: "An unknown error occured in the request, Please Try Again",
                            icon: "error"
                        });
                    },
                    beforeSend: () => {},
                    success: (response) => {
                        Swal.fire({
                            title: `${response['status'].substr(0, 1)[0].toUpperCase()}${response['status'].substr(1)}`,
                            text: response['message'],
                            icon: response['status'],
                        }).then(() => {
                            if (response['status'] == "success") window.location.reload();
                        })
                    }
                })
            })

            $("#search_form").on("submit", function(e) {
                e.preventDefault();
                var value = $("#search").val();

                $(".modal-title").each((index, element) => {
                    if ($(element).text().toLowerCase() == value.toLowerCase()) {
                        $($(element).parents(".modal").get(0)).modal('show');
                    }
                })
            })

            $(document).on("click", ".btn-action", function (e) {
        e.preventDefault();
        var _this = $(this);

        $.ajax({
            url: "core/mina.php",
            method: "post",
            dataType: "json",
            data: {
                action: _this.attr("action-type"),
                id: _this.attr("data")
            },
            error: (e) => {
                console.log(e);
            },
            beforeSend: () => {
            },
            success: (response) => {
                // console.log(response);
                if(response['status'] == "OK") {

                    if(_this.attr("action-type") == "logout") {
                        swal.fire({
                            title: "Logout successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location.reload();
                        });
                    }
                } else {
                    swal.fire({
                        title: "Error Occured",
                        text: response['message'],
                        icon: "error"
                    });
                }
            }
        });
    })
        })
    </script>
    <h6>Powered by Perigee Insights</h6>
</body>

</html>