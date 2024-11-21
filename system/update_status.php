<?php

    include_once '../db.php';

    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $del_order = 1;
        $del_food = 1;
        
        if($status == 3){
            $sql = mysqli_query($conn, "UPDATE `order_detail` SET `rider_id` = '".$_SESSION['rider_id']."', `status` = '".$_GET['status']."' WHERE `order_code` = '".$_GET['order_code']."' ");
            echo ($sql) ? alert('รับออร์เดอร์แล้ว รอรับออร์เดอร์ที่ร้านได้เลย', '../rider/status.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง');

        } else {
            $sql = mysqli_query($conn, "UPDATE `order_detail` SET `status` = '$status' WHERE `order_code` = '".$_GET['order_code']."' ");
            alert('อัพเดทสถานะสำเร็จ');
        }
    }

?>