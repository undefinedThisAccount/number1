<?php
    include_once '../db.php';
    // session_start(); เปิดที่ db.php ไปแล้ว
    if(!$_SESSION['admin_id']){
        header('location: ../login.php?member=admin');
    }
?>