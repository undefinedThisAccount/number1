<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รับรายการอาหาร</title>
</head>
<body>
    <?php 
        include_once 'nav.php';
        $member = 'res';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">ออร์เดอร์วันนี้</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` BETWEEN 0 AND 6) AND `res_id` = '".$_SESSION['res_id']."' ");
                if($select_order -> num_rows > 0){
                    include_once '../template/status.php';
                } else { 
            ?>
                <p class="text-center blockquote-footer">ยังไม่มีออร์เดอร์ขณะนี้</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>