<?php
include 'conn.php';

$response = [
    "status" => "OK",
    "data" => []
];

if(isset($_POST['chart']))
if($_POST['chart'] == "pie") {
    $data = [];
    $food_query = mysqli_query($conn, "SELECT * FROM foods");
    while ($food = mysqli_fetch_array($food_query)) {
        $food['accompaniments'] = [];
        
        $accompaniment_query = mysqli_query($conn, "SELECT * FROM accompaniment WHERE food_item = '{$food['id']}'");
        while($accompaniment = mysqli_fetch_array($accompaniment_query)) {
            array_push($food['accompaniments'], $accompaniment);
        }
        array_push($data, $food);
    }

    $payments = [];
    $payment_query = mysqli_query($conn, "SELECT * FROM food_payment");
    while ($payment = mysqli_fetch_array($payment_query)) {
        array_push($payments, $payment);
    }

    function group_by($key, $data) {
        $result = array();

        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }

        return $result;
    }

    $payment_group = group_by("food_id", $payments);
    $payment_group = array_map(function($elem) {
        return count($elem);
    }, $payment_group);

    $least_food_id = 0;
    $fast_food_id = 0;
    foreach ($payment_group as $key => $value) {
        global $least_count;
        global $fast_count;

        if($least_count == null || $value < $least_count) {
            $least_count = $value;
            $least_food_id = $key;
        }
        if ($fast_count == null || $value > $fast_count) {
            $fast_count = $value;
            $fast_food_id = $key;
        }
    }
    foreach ($data as $value) {
        if($value['id'] == $fast_food_id) {
            $response['data']['fast'] = [
                "name" => $value['name'],
                "count" => $fast_count
            ];
        } else if ($value['id'] == $least_food_id) {
            $response['data']['least'] = [
                "name" => $value['name'],
                "count" => $least_count
            ];
        }
    }

    echo json_encode($response);


} else if ($_POST['chart'] == "line") {
    $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $this_month = date("M");
    $months = array_slice($months, 0, array_search($this_month, $months) + 1);

    $data = [];
    $food_query = mysqli_query($conn, "SELECT * FROM foods");
    while ($food = mysqli_fetch_array($food_query)) {
        $food['accompaniments'] = [];
        
        $accompaniment_query = mysqli_query($conn, "SELECT * FROM accompaniment WHERE food_item = '{$food['id']}'");
        while($accompaniment = mysqli_fetch_array($accompaniment_query)) {
            array_push($food['accompaniments'], $accompaniment);
        }
        array_push($data, $food);
    }

    $payments = [];
    $payment_query = mysqli_query($conn, "SELECT * FROM food_payment");
    while ($payment = mysqli_fetch_array($payment_query)) {
        array_push($payments, $payment);
    }

    $dataset_sales = [];
    $dataset_orders = [];
    foreach ($months as $value) {
        $value = array_search($value, $months);
        if(!isset($dataset_orders[$value])) $dataset_orders[$value] = 0;
        if(!isset($dataset_sales[$value])) $dataset_sales[$value] = 0;
    }
    foreach ($payments as $value) {
        $_month = array_search(date("M", strtotime($value['date_created'])), $months);
        $dataset_sales[$_month] += $value['amount'];
        $dataset_orders[$_month] += 1;
    }

    $response = [
        "status" => "OK",
        "data" => [
            "labels" => $months,
            "sales" => $dataset_sales,
            "orders" => $dataset_orders
        ]
    ];


    echo json_encode($response);
}