<?php

    include_once '../'.$_POST['member'].'/nav.php';
    if(isset($_POST['submit'])){
        $member = $_POST['member'];
        $member_id = ($member == 'restaurant' ? 'res_id' : $member.'_id');
        $old_pass = $_POST['old_pass'];
        $new_pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);

        if(password_verify($old_pass, $row['password'])){
            $sql = mysqli_query($conn, "UPDATE `$member` SET `password` = '$new_pass' WHERE `$member_id` = '".$_SESSION[$member_id]."' ");
            if($sql){
                alert('เปลี่ยนรหัสผ่านสำเร็จ', '../'.$member.'/index.php?page=../template/profile');
            } else {
                alert('เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้งภายหลัง');
            }
        } else {
            alert('รหัสผ่านเก่าไม่ถูกต้อง');
        }

    }

?>