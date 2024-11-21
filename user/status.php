<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะคำสั่งซื้อ</title>
</head>
<body>
    <?php   
        include_once 'nav.php';
        $member = 'user';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">สถานะคำสั่งซื้อ</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` BETWEEN 0 AND 6)  
                AND `user_id` = '".$_SESSION['user_id']."' ORDER BY `date` DESC ");
                if($select_order -> num_rows > 0){
                    include '../template/status.php';
                }
            ?>
        </div>
    </div>
</body>
</html>