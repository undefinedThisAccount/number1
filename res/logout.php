<?php
    session_start();
    unset($_SESSION['res_id']);
    header('location: ../login.php');
?>