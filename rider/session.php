<?php

    include_once '../db.php';
    if(!$_SESSION['rider_id']){
        header('location: ../index.php');
    }

?>