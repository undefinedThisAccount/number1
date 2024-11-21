<?php

    include_once '../db.php';

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $member = $_POST['member'];
        $member_id = ($member == 'restaurant' ? 'res' : $member) . '_id'; // ถ้าเป็น restaurant ตัดให้เป็น res เฉยๆ แล้วเอามาต่อกับ _id

        $select = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' ");
        if($select -> num_rows > 0){
            $row_user = mysqli_fetch_assoc($select);
            if(password_verify($password, $row_user['password'])){
                if($member == 'admin'){
                    $_SESSION[$member_id] = $row_user[$member_id];
                    header('location: ../admin/index.php');
                } else {
                    if($row_user['status'] == 1){
                        $_SESSION[$member_id] = $row_user[$member_id];
                        header('location: '.'../'.$member.'');
                    } else {
                        alert('ยังไม่ได้รับอนุมัติการใช้งาน');
                    }
                }
            } else {
                alert('รหัสผ่านไม่ถูกต้อง');
            }
        } else {
            alert('ชื่อผู้ใช้ไม่ถูกต้อง กรุณาลองใหม่อีกคร้ง');
        }
    }

?>