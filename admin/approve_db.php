<?php

    include_once 'session.php';

    if(isset($_POST['add_res_type'])){
        $res_type = $_POST['res_type'];
        include '../upload.php';
        $select = mysqli_query($conn, "SELECT * FROM `restaurant_type` WHERE `res_type` = '$res_type' ");
        if($select -> num_rows > 0){
            alert('มีประเภทร้านอาหารนี้แล้ว');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = mysqli_query($conn, "INSERT INTO `restaurant_type`(`res_type`, `img`) VALUES('$res_type', '$filename') ");
                // echo ($sql ? header('location: approve.php?permis=restaurant') : alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'approve.php?permis=restaurant'));
                echo ($sql ? back() : alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'approve.php?permis=restaurant'));
            }
        }
    }

    if(isset($_GET['permis'])){
        $permis = $_GET['permis'];
        $permis_id = $_GET['permis_id'];
        $id = $_GET['id'];
        $status = $_GET['status'];
        $sql = mysqli_query($conn, "UPDATE `$permis` SET `status` = '$status' WHERE `$permis_id` = '$id' ");
        // echo ($sql ? header('location: approve.php?permis='.$permis.'#'.$id) : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง', 'approve.php?permis='.$permis));
        echo ($sql ? back() : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง', 'approve.php?permis='.$permis));
    }

?>