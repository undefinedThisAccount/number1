<?php

    session_start();
    ini_set('display_errors', 1);
    $conn = mysqli_connect('localhost', 'root', '', 'delivery_p1');
    // $conn = mysqli_connect('localhost', 'ietdevco_krujune', 'qwerty', 'ietdevco_krujune');
    echo($conn ? '' : 'EROR : ' . mysqli_connect_error());

    $select_web = mysqli_query($conn, "SELECT `web_name` FROM `admin` ORDER BY `admin_id` ASC LIMIT 1  ");
    $row_web = mysqli_fetch_array($select_web);

    function alert($msg, $lo = null){
        if($lo == null){
            echo "<script>alert('$msg'); window.history.back();</script>";
        } else {
            echo "<script>alert('$msg'); window.location = '$lo';</script>";
        }
    }

    function discount($price, $dis){
        $new_dis = ($price * $dis) / 100;
        $new_price = $price - $new_dis;
        return $new_price;
    }
    
    function back(){
        echo "<script>window.history.back();</script>";
    }
?>