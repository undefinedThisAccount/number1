<?php

    include_once '../db.php';

    if(isset($_POST['submit'])){
        $member = $_POST['member'];
        if($member == 'restaurant'){
            $member_id = 'res_id';
            $res_name = $_POST['res_name'];
            $res_type = $_POST['res_type'];
        } else {
            $member_id = $member.'_id';
        }
        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        // echo $member.'</br>';
        // echo $member_id.'</br>';
        // echo $username.'</br>';
        // echo $full_name.'</br>';
        // echo $address.'</br>';
        // echo $phone.'</br>';
        // echo $_SESSION[$member_id].'</br>';

        include '../upload.php';

        $select_username = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' AND `$member_id` != '".$_SESSION[$member_id]."' ");

        if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = "UPDATE `$member` SET
                `full_name` = '$full_name',
                `img` = '$filename',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone' ";
            } else {
                $sql = "UPDATE `$member` SET
                `full_name` = '$full_name',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone' ";
            }
            if($member == 'restaurant'){
                $sql .= ", `res_name` = '$res_name', `res_type` = '$res_type' ";
            }
            $sql = mysqli_query($conn, $sql .= "WHERE `$member_id` = '".$_SESSION[$member_id]."' ");

            if($sql){
                alert('แก้ไขข้อมูลสำเร็จ', '../'.$member.'/index.php?page=../template/profile');
            } else {
                alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง');
            }
        }
    }

?>