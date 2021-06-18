<?php
    require '../includes/core.inc.php';
    if ($_SERVER['REQUEST_METHOD'] === "POST")
    {
        if (isset($_POST['save'])) //adding new
        {
            if ($sub === 'category')
            {
                $category = htmlentities($_POST['cat_description']);

                //check if row exist
                if (qRowCount("food_category" , "`description` = '$category'" , $route) < 1)
                {
                    //insert
                    $owner = $_SESSION['username'];
                    $date = date("Y-m-d");
                    $time = date('H:m:s');

                    if (insert("food_category" , "`description` , `owner`,`date_created`,`time_created`" , "'$category' , '$owner','$date','$time'" , $route) === true)
                    {
                        notification("$category added successfully");
                        $_SESSION['view'] = 'view';
                        gb();
                    }
                    else
                    {
                        notification("Could not add category");
                        gb();
                    }
                }
                else
                {
                    notification("Category already exist");
                    gb();
                }
            }

            elseif($sub === 'menu_item')
            {
                $food = htmlentities($_POST['description']);
                $category = htmlentities($_POST['cat']);
                $cost = htmlentities($_POST['cost']);
                $retail = htmlentities($_POST['retail']);
                $tax = htmlentities($_POST['tax']);
                $recipe = htmlentities($_POST['recipe']);

                $owner = htmlentities($_SESSION['username']);
                $date = date('Y:m:d');
                $time = date("H:m:s");


                if($category == 0)
                {
                    $_SESSION['food'] = $food;
                    notification("Please select category");
                }
                else
                {
                    //if item exist
                    if (qRowCount("menu_items" , "`description` = '$food'" , $route) < 1)
                    {
                        $cols = "`category` , `description` , `cost_price` , `retail_price` , `tax` , `recipe` , `date_created` , `time_created` , `owner`";
                        $vals = "'$category' , '$food' , '$cost' , '$retail' , '$tax' , '$recipe' , '$date' , '$time' , '$owner'";
                        //insert
                        insert('menu_items' , $cols , $vals , $route);
                        $_SESSION['sub'] = 'view';
                        unset($_SESSION['food']);
                        notification($food ." Added Successfully");


                    }
                    else
                    {
                        notification("Menu item exist");
                    }
                }
                gb();
            }
        }
        elseif (isset($_POST['edit']))
        {
            if ($sub === 'category')
            {
                $id = htmlentities($_POST['id']);
                $current_name = htmlentities($_POST['curr_name']);
                $new_name = htmlentities($_POST['new_name']);

                if ($new_name === $current_name)
                {
                    notification("There is no need to make a change since");
                    gb();
                }
                //check if name taken
                if(qRowCount("food_category" , "`description` = '$new_name'" ,$route) > 0)
                {
                    notification($new_name. " Exist, choose a different description");
                    gb();
                }

                //update
                if (update("food_category" , "`description` = '$new_name'" , "`id` = '$id'" , $route) === true)
                {
                    notification("Edit Successful");
                }
                else
                {
                    notification("Edit was not successful");
                }
                gb();

            } //edit category

            elseif ($sub === 'menu_item')
            {
                //get values
                $desc = htmlentities($_POST['desc']);
                $category = htmlentities($_POST['category']);
                $tax = htmlentities($_POST['tax']);
                $cost = htmlentities($_POST['cost']);
                $retail = htmlentities($_POST['retail']);
                $recipe = htmlentities($_POST['recipe']);

                $image = 'default.png';

                if (isset($_FILES['item_image']))
                {
                    $file_tempname = $_FILES['item_image']['tmp_name'];
                    $file_name = $_FILES['item_image']['name'];
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                    $image = md5($file_name.$category.$tax.$retail).'.'.$file_extension;
                    
                    $destionation = '../../../../images/meni_items_images/';
                    $file = $destionation.$image;

                    //upload
                    if (move_uploaded_file($file_tempname,$file))
                    {
                        echo 'image uploaded';
                        //change image
                        $id = $_SESSION['item'];
                        $set = "`img` = '$image'";
                        $condition = "`id` = $id";
                        update("menu_items" , $set , $condition , $route);
                    }
                    else
                    {
                        echo 'faild uploading image';
                    }
                    
                }
                else
                {
                    echo 'no image';
                }

                //update
                $id = $_SESSION['item'];
                $set = "`description` = '$desc',  `category` = '$category' , `tax` = '$tax'  , `cost_price` = '$cost'  , `retail_price` = '$retail' , `recipe` = '$recipe'";
                $condition = "`id` = $id";

                if (update("menu_items" , $set , $condition , $route) === true)
                {
                    //unset and set sessions
                    unset($_SESSION['item']);
                    $_SESSION['vq'] = '*';
                    notification("Food Item Updated");
                }
                else
                {
                    notification("Could not update item");
                }
                gb();

            }//edit menu master

        } //edit
    } //add new

    elseif (isset($_GET['del']))
    {
        $id = $_GET['id'];
        if ($sub === 'category')
        {
            $del_sql = "DELETE FROM `food_category` where `id` = ?";
        }
        elseif ($sub === "menu_item")
        {
            $del_sql = "DELETE FROM `menu_items` where `id` = ?";
        }
        $del_stmt = $route->prepare($del_sql);
        $del_stmt->execute([$id]);
        notification("Deleted");
        gb();
    } //delete

    elseif (isset($_GET['vq']))
    {
        if (isset($_GET['id']))
        {
            $_SESSION['item'] = $_GET['id'];
        }
        $_SESSION['vq'] = $_GET['vq'];
        gb();
    }//view
