<?php

    include_once 'session.php';
    if(isset($_POST['web_edit'])){
        $sql = mysqli_query($conn, "UPDATE `admin` SET `web_name` = '".$_POST['web_name']."' WHERE `admin_id` = '".$_SESSION['admin_id']."' ");
        if($sql){
            alert('แก้ไขข้อมูลสำเร็จ');
        } else {
            alert('เกิดข้อผิดพลาด');
        }
    }

    if(isset($_POST['add_cpn'])){
        $cpn_code = $_POST['cpn_code'];
        $cpn_discount = $_POST['cpn_discount'];
        
        $select = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `cpn_code` = '$cpn_code' ");
        if($select -> num_rows > 0){
            alert('ชื่อคูปองส่วนลดซ้ำ');
        } else {
            $sql = mysqli_query($conn, "INSERT INTO `coupon`(`cpn_code`, `cpn_discount`) VALUES('$cpn_code', '$cpn_discount') ");
            if($sql){
                header('location: index.php');
            } else {
                alert('เกิดข้อผิดพลาด');
            }
        }
    }

    if(isset($_GET['del_cpn'])){
        $sql = mysqli_query($conn, "DELETE FROM `coupon` WHERE `cpn_id` = '".$_GET['del_cpn']."' ");
        if($sql){
            back();
        } else {
            alert('เกิดข้อผิดพลาด');
        }
    }

?>