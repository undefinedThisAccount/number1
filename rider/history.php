<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการจัดส่ง</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member = 'rider';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">ประวัติการจัดส่ง</h1>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `rider_id` = '".$_SESSION['rider_id']."' ");
                include '../template/status.php';
            ?>
        </div>
    </div>
</body>
</html>