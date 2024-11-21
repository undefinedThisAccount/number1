<?php
    include_once '../db.php';
    if(!$_SESSION['res_id']){
        header('location: ../login.php?member=restaurant');
    }
?>