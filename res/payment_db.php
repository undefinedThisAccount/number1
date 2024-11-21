<?php

    include_once '../db.php';

    if(isset($_POST['submit'])){
        $bank = $_POST['bank'];
        $ac_num = $_POST['ac_num'];
        $ac_name = $_POST['ac_name'];
        $res_id = $_SESSION['res_id'];
        include_once '../upload.php';

        if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
            $sql = mysqli_query($conn, "UPDATE `payment` SET
            `qr_code` = '$filename',
            `bank` = '$bank',
            `ac_num` = '$ac_num',
            `ac_name` = '$ac_name' WHERE `res_id` = '$res_id' ");
        } else {
            $sql = mysqli_query($conn, "UPDATE `payment` SET
            `bank` = '$bank',
            `ac_num` = '$ac_num',
            `ac_name` = '$ac_name' WHERE `res_id` = '$res_id' ");
        }
        print_r($sql);

        echo ($sql ? alert('แก้ไขบัญชีธนาคารสำเร็จ') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง'));
    }

?>