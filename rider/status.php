<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการส่งอาหาร</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member = 'rider';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">สถานะการส่งอาหาร</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` BETWEEN 3 AND 6) AND `rider_id` = '".$_SESSION['rider_id']."' ");
                if($select_order -> num_rows > 0){
                    include '../template/status.php';
            ?>
                
            <?php } else { ?>
                    <p class="text-center blockquote-footer">ยังไม่มีออร์เดอร์ <a href="index.php">ค้นหาร้านค้าแล้วรับออร์เดอร์เลย</a></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>