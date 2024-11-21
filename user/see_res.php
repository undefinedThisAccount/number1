<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member;
        if(empty($_SESSION['cart_arr'])){
            $_SESSION['cart_arr'] = array();
        }

        if(isset($_GET['see_res'])){
            $_SESSION['see_res'] = $_GET['see_res'];
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['see_res']."' ");
        $row_res = mysqli_fetch_array($select_res);
        // ถ้าไม่มีไอดีของตารางที่จะดึง
        if($select_res -> num_rows == 0){
            header('location: index.php');
        }
    ?>
    <div class="banner position-relative" >
        <div class="dark-overlay"></div>
        <img src="../upload/<?php echo $row_res['img'] ?>" alt="" class="img">
    </div>

    <div class="container my-4">
        <div class="mx-4">
            <h3>ร้านอาหาร : <?php echo $row_res['res_name'] ?></h3>
            <h5>ที่อยู่ : <?php echo $row_res['address'] ?>| ติดต่อ : <?php echo $row_res['phone'] ?></h5>
            <p>
                <?php
                    if($row_res['star'] != 0){
                        for($i=1; $i<=$row_res['star']; $i++){
                            echo '⭐';
                        }
                        echo number_format($row_res['star'], 1).' ('.$row_res['qty_sale'].' รีวิว)';
                    } else {
                        echo '⭐ยังไม่มีคะแนน';    
                    }
                ?>
            </p>
        </div>
    </div>

    <ul class="nav nav-tabs ps-5 mb-5" id="food">
        <li class="nav-item ms-5">
            <a href="see_res.php#food" class="nav-link active">เมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a href="see_review.php#review" class="nav-link">รีวิวร้าน</a>
        </li>
    </ul>

    <div class="container-fluid">
        <h1 class="text-center mb-3">หมวดหมู่ร้านอาหาร</h1>
        <div class="row mt-4">
            <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['see_res']."' ");
                while($row_type = mysqli_fetch_array($select_type)){
            ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                    <a href="#<?php echo $row_type['food_type'] ?>" class="text-dark">
                        <div class="card mb-3 hover-img">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row_type['img'] ?>" class="img">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><?php echo $row_type['food_type'] ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <hr>
    </div>

    <div class="navbar navbar-expand navbar-light bg-light sticky-top shadow">
        <a href="search.php" class="btn btn-outline-primary mx-2">🔎</a>
        <div class="container-fluid scroll">
            <div class="text-nowrap">
                <ul class="navbar-nav">
                    <?php
                        $check_pro = mysqli_query($conn, "SELECT * FROM `food` WHERE `discount` != 0 AND `res_id` = '".$_SESSION['see_res']."' ");
                        if($check_pro -> num_rows > 0){
                    ?>
                        <li class="nav-item">
                            <a href="#promotion" class="nav-link">โปรโมชั่น</a>
                        </li>
                    <?php 
                        } 
                        $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['see_res']."' ");
                        while($row_type = mysqli_fetch_array($select_type)){
                    ?>  
                        <li class="nav-item">
                            <a href="#<?php echo $row_type['food_type'] ?>" class="nav-link"><?php echo $row_type['food_type'] ?></a>
                        </li>
                    <?php 
                        }
                        // อันนี้ดูก่อน ถ้าไม่ไหวไม่ทำ
                        $check_more = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = 'อื่นๆ' AND `res_id` = '".$_SESSION['see_res']."' ");
                        if($check_more -> num_rows > 0){
                    ?>
                        <li class="nav-item">
                            <a href="#อื่นๆ" class="nav-link">อื่นๆ</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if($check_pro -> num_rows > 0){ ?>
            <div class="pt-5" id="promotion">
                <h1 class="mt-4">โปรโมชั่น</h1>
                <div class="row">
                    <?php
                        while($row_food = mysqli_fetch_array($check_pro)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>

        <?php
            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` =  '".$_SESSION['see_res']."' ");
            while($row_type = mysqli_fetch_array($select_type)){
        ?>
            <div class="pt-5" id="<?php echo $row_type['food_type'] ?>">
                <h1 class="mt-4"><?php echo $row_type['food_type'] ?></h1>
                <div class="row">
                    <?php  
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = '".$row_type['food_type']."' AND `res_id` = '".$_SESSION['see_res']."' ");
                        while($row_food = mysqli_fetch_array($select_food)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php }?>

        <?php if($check_more -> num_rows > 0){ ?>
            <div class="pt-5" id="อื่นๆ">
                <h1 class="mt-4">อื่นๆ</h1>
                <div class="row">
                    <?php
                        while($row_food = mysqli_fetch_array($check_more)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>
     
    <?php
        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '".$_SESSION['see_res']."' ");
        while($row_food = mysqli_fetch_array($select_food)){
            include 'food_modal.php';
        }
    ?>

    <div class="container">
        <div class="position-fixed bottom-0 end-0 p-3">
            <a href="cart.php" class="position-relative btn btn-outline-primary x-2">
                <h3>🛒</h3>
                <?php if(count($_SESSION['cart_arr']) > 0){ ?>
                    <span class="position-absolute top-0 start-100 bg-danger rounded-pill translate-middle badge"><?php echo count($_SESSION['cart_arr']); ?></span>
                <?php } ?>
            </a>
        </div>
    </div>
</body>
</html>