<?php
    include_once '../db.php';
    if(!$_SESSION['user_id']){
        header('location: ../login.php?member=user');
    }
?>