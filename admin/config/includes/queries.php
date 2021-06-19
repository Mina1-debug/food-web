<?php
    //    This file containes all queries
    if (isset($_SESSION['display']))
    {
        if ($_SESSION['display'] === 'dashboard')
        {
            ## Dashboard queries

            //get sum of total paid today


            if (sum("payment" , "amount_paid" , "`date_paid` = '$today'" , $route) > 0)
            {
                $totalPayment = '₡'.sum("payment" , "amount_paid" , "`date_paid` = '$today'" , $route);
            }
            else
            {
                $totalPayment = '₡ 0.00';
            }
            //total order
            if (qRowCount('food_order' , "`date_placed` = '$today'" , $route) > 0)
            {
                $totalOrder = qRowCount('food_order' , "`date_placed` = '$today'" , $route);
            }
            else
            {
                $totalOrder = 0;
            }

            //get delivered
            if (qRowCount('food_order' , "`stat` = 'delivered'" , $route) > 0)
            {
                $delivered = qRowCount('food_order' , "`stat` = 'delivered'" , $route);
            }
            else
            {
                $delivered = 0;
            }


        }

        elseif ($_SESSION['display'] === 'menu_master')
        {
            $sub = $_SESSION['sub'];
            $vq = $_SESSION['vq'];

            if ($sub === 'category')
            {
                $count = qRowCount("food_category" , "none" , $route);
                $food_cat_sql = "SELECT * FROM `food_category`";
                $food_cat_stmt = $route->prepare($food_cat_sql);
                $food_cat_stmt->execute();

            }
            elseif ($sub === 'menu_item')
            {
                $count = qRowCount("menu_items" , "none" , $route);

                if ($vq === '*')
                {
                    //menu items
                    $menu_items_sql = "SELECT * FROM `menu_items`";
                    $menu_items_stmt = $route->prepare($menu_items_sql);
                    $menu_items_stmt->execute();
                }
                elseif ($vq === '~' || $vq = '`')
                {
                    $id = $_SESSION['item'];

                    //menu items
                    $menu_items_sql = "SELECT * FROM `menu_items` WHERE `id` = $id";
                    $menu_items_stmt = $route->prepare($menu_items_sql);
                    $menu_items_stmt->execute();
                    $itemDet = $menu_items_stmt->fetch(PDO::FETCH_ASSOC);
                }

                //get food category items in database
                $food_cat_sql = "SELECT * FROM `food_category`";
                $food_cat_stmt = $route->prepare($food_cat_sql);
                $food_cat_stmt->execute();

            }





        }
    }