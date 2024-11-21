<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
</head>
<body>
    <?php
        include 'nav.php';
        $member = 'rider';

        if(isset($_GET['rider_see_res'])){
            $_SESSION['rider_see_res'] = $_GET['rider_see_res'];
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['rider_see_res']."' ");
        $row_res = mysqli_fetch_array($select_res);
        // ถ้าไม่มีไอดีของตารางที่จะดึง
        if($select_res -> num_rows == 0){
            header('location: index.php');
        }
    ?>

    <!-- ก้อปจาก user/see_res.php -->
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
                        echo $row_res['star'].' ('.$row_res['qty_sale'].' รีวิว)';
                    } else {
                        echo '⭐ยังไม่มีคะแนน';    
                    }
                ?>
            </p>
        </div>
    </div>
    <hr>
    <!-- --------------------- -->

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">รับออร์เดอร์</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` = 2) AND `res_id` = '".$_SESSION['rider_see_res']."' ");
                if($select_order -> num_rows > 0){
                    include '../template/status.php';
                } else {
            ?>
                <p class="text-center blockquote-footer">ยังไม่มีออร์เดอร์ในขณะนี้</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>