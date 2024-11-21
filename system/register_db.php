<?php

    include_once '../db.php';

    if(isset($_POST['submit'])){
        $member = $_POST['member'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        include '../upload.php';

        $select_username = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' ");

        if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่');
        } else {
            $col = "`full_name`, `username`, `password`, `address`, `phone` ";
            $value = "'$full_name', '$username', '$password', '$address', '$phone' ";

            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $col .= ", `img`";
                $value .= ", '$filename'";
            }

            if($member == 'restaurant'){
                $res_name = $_POST['res_name'];
                $res_type = $_POST['res_type'];
                $col .= ",`res_name`, `res_type` ";
                $value .= ", '$res_name', '$res_type' ";
            }

            $sql = mysqli_query($conn, "INSERT INTO `$member`($col) VALUES($value) ");

            $last = mysqli_insert_id($conn);
            $insert_pay = mysqli_query($conn, "INSERT INTO `payment`(`res_id`) VALUES($last) ");

            if($sql){
                alert('สมัครใช้งานสำเร็จ กรุณารออนุมัติการใช้งาน', '../login.php?member='.$member);
            } else {
                alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง');
            }
        }

    }

?>