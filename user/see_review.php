<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวร้าน</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        if(isset($_GET['see_res'])){
            $_SESSION['see_res'] = $_GET['see_res'];
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['see_res']."' ");
        $row_res = mysqli_fetch_array($select_res);
        if($select_res -> num_rows == 0){
            header('location: index.php');
        }
    ?>
    <div class="banner position-relative">
        <div class="dark-overlay"></div>
        <img src="../upload/<?php echo $row_res['img'] ?>" alt="" class="img">
    </div>

    <div class="container my-4">
        <div class="mx-4">
            <h3>ร้านอาหาร : <?php echo $row_res['res_name'] ?></h3>
            <h5>ที่อยู่ : <?php echo $row_res['address'].' | '.$row_res['phone'] ?></h5>
            <p>
                <?php
                    if($row_res['star'] != 0){
                        for($i=1; $i<=$row_res['star']; $i++){
                            echo '⭐';
                        }
                        echo $row_res['star'].'( '.$row_res['qty_sale'].' รีวิว)';
                    } else {
                        echo '⭐ ยังไม่มีคะแนน';
                    }
                ?>
            </p>
        </div>
    </div>

    <ul class="nav nav-tabs ps-5 mb-5" id="review">
        <li class="nav-tabs ms-5">
            <a href="see_res.php#food" class="nav-link">เมนูอาหาร</a>
        </li>
        <li class="nav-tabs">
            <a href="see_review.php#review" class="nav-link active">รีวิว</a>
        </li>
    </ul>

    <div class="container mb-5">
        <?php
            $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['see_res']."' ");
            if($select_order -> num_rows > 0){
                while($row_order = mysqli_fetch_array($select_order)){
                    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '".$row_order['user_id']."' ");
                    $row_user = mysqli_fetch_array($select_user);
        ?>
            <div class="card mb-5 shadow">
                <div class="card-header p-3">
                    <div class="d-flex">
                        <div class="pro-brand">
                            <img src="../upload/<?php echo $row_user['img'] ?>" alt="" class="img">
                        </div>
                        <h5 class="mt-2"><?php echo $row_order['full_name'] ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-seconday"><?php echo $row_order['date'].' | '.$row_order['time'] ?></p>
                    <h5><?php echo $row_order['review'] ?></h5>
                    <span class="text-secconday">รายการที่สั่ง :
                        <?php
                            $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '".$row_order['order_code']."' ");
                            while($row_food = mysqli_fetch_array($select_food)){
                                echo $row_food['food_name'].', ';
                            }
                        ?>
                    </span>
                </div>
            </div>
        <?php }} else { ?>
            <p class="text-center blockquote-footer">ร้านนี้ยังไม่มีรีวิว</p>
        <?php } ?>
    </div>
</body>
</html>