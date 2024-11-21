<?php

    include_once 'session.php';
    if(isset($_POST['add_cart'])){
        $_SESSION['cart_arr'][$_POST['food_id']] = $_POST['qty'];
        // print_r($_SESSION['cart_arr']);
        // alert('เพิ่มเมนูอาหารงลงตะกร้าแล้ว');
        // back();
        print_r($_SESSION['cart_arr']);
    }

    if(isset($_GET['del'])){
        unset($_SESSION['cart_arr'][$_GET['del']]);
        back();
    }

    if(isset($_POST['add_cpn'])){
        $cpn_code = $_POST['cpn_code'];
        $select = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `cpn_code` = '$cpn_code' ");
        $row = mysqli_fetch_array($select);
        if($select -> num_rows > 0){
            // $_SESSION['cpn_dis'] = $row['cpn_discount'];
            // back();
            alert('เพิ่มโค้ดส่วนลดสำเร็จ', 'cart.php?cpn_dis='.$row['cpn_discount']);
        } else {
            alert('โค้ดส่วนลดไม่ถูกต้อง');
        }
    }

?>