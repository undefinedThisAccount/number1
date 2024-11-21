<?php

    include_once 'session.php';

    if(isset($_GET['st'])){
        $_SESSION['star'][$_GET['order_code']] = $_GET['st'];
        back();
    }

    if(isset($_POST['submit_review'])){
        $res_id  = $_POST['res_id'];
        $order_code  = $_POST['order_code'];
        $star  = $_SESSION['star'][$_POST['order_code']];
        $review  = $_POST['review'];

        $ud_order = mysqli_query($conn, "UPDATE `order_detail` SET `star` = '$star', `review` = '$review', `status` = 7 WHERE `order_code` = '$order_code' ");

        // res update
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ");
        $row_res = mysqli_fetch_array($select_res);

        $res_all_rating = $row_res['rating'] + $star;
        $res_all_sale = $row_res['qty_sale'] + 1;
        $res_sum_star = $res_all_rating / $res_all_sale;
        $ud_res = mysqli_query($conn, "UPDATE `restaurant` SET `star` = '$res_sum_star', `rating` = '$res_all_rating', `qty_sale` = '$res_all_sale' WHERE `res_id` = '$res_id' ");

        // food
        if($ud_res){
            $select_food_order = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '$order_code' ");
            while($row_food_order = mysqli_fetch_array($select_food_order)){
                $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$row_food_order['food_id']."' ");
                $row_food = mysqli_fetch_array($select_food);

                $food_all_rating = $row_food['rating'] + $star;
                $food_all_sale = $row_food['qty_sale'] + 1;
                $food_sum_star = $food_all_rating / $food_all_sale;
                $ud_food = mysqli_query($conn, "UPDATE `food` SET `star` = '$food_sum_star', `rating` = '$food_all_rating', `qty_sale` = '$food_all_sale' WHERE `food_id` = '".$row_food['food_id']."'  ");
            }
            if($ud_food){
                alert('รีวิวออร์เดอร์สำเร็จ ขอบคุณที่ใช้บริการ', 'history.php');
            } else {
                echo alert('เกิดข้อผิดพลาดในการรีวิวเมนูอาหาร');
            }
        } else {
            echo alert('เกิดข้อผิดพลาดในการรีวิวร้านอาหาร');
        }
    }

?>