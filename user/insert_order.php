<?php

    include_once 'session.php';
    if(isset($_POST['buy_order'])){
        $res_id = $_SESSION['see_res'];
        $user_id = $_SESSION['user_id'];

        $all_food_price = $_POST['all_food_price'];
        $cpn_discount = $_POST['cpn_discount'];
        $sum_price = $_POST['sum_price'];

        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $status = ($_POST['payment'] == 'qr_code' ? 1 : 0);

        include '../upload.php';

        date_default_timezone_set("Asia/Bangkok");
        $date = date("d-m-y");
        $time = date("H:i:s");

        if($sum_price != 0){
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`res_id`, `all_food_price`, `cpn_discount`, `sum_price`, `user_id`, `full_name`, `address`, `phone`, `slip`, `date`, `time`)
                VALUES('$res_id', '$all_food_price', '$cpn_discount', '$sum_price', '$user_id', '$full_name', '$address', '$phone', '$filename', '$date', '$time') ");
            } else {
                $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`res_id`, `all_food_price`, `cpn_discount`, `sum_price`, `user_id`, `full_name`, `address`, `phone`, `date`, `time`, `status`)
                VALUES('$res_id', '$all_food_price', '$cpn_discount', '$sum_price', '$user_id', '$full_name', '$address', '$phone', '$date', '$time', 2) ");
            }

            $order_id = mysqli_insert_id($conn);

            if($sql_order){
                foreach($_SESSION['cart_arr'] as $food_id => $food_qty){
                    $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' AND `res_id` = '$res_id' ");
                    $row_food = mysqli_fetch_array($select_food);
                    if($row_food['discount'] != 0){
                        $price = $row_food['new_price'];
                    } else {
                        $price = $row_food['price'];
                    }
                    $sql_food_order = mysqli_query($conn, "INSERT INTO `food_order`(`order_code`, `food_id`, `food_name`, `food_img`, `price`, `new_price`, `qty`, `total_price`)
                    VALUES('$order_id', '".$row_food['food_id']."', '".$row_food['food_name']."', '".$row_food['img']."', '".$row_food['price']."', '".$row_food['new_price']."', '$food_qty', '".$food_qty * $price."') ");
                    echo $sql_food_order;
                }

                if($sql_food_order){
                    unset($_SESSION['cart_arr']);
                    alert('สั่งซื้อสำเร็จ', 'status.php');
                } else {
                    alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง');
                }
            } else {
                alert('เกิดข้อผิดพลาดในการสั่งซื้อ กรุณาลองใหม่อีกครั้งในภายหลัง');
            }            
        } else {
            alert('ยังไม่มีสินค้าในตะกร้า เลือกเมนูที่ต้องการเลย', 'see_res.php');
        }
    }

?>