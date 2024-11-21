<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสั่งซื้อ</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member = 'user';
    ?>
    <div class="container-fluid border">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">ประวัติการสั่งซื้อ</h1>

            <!-- ไม่จำเป็น เอาไว้ถ้าไหวค่อยทำ -->
            <?php
                if(isset($_GET['order'])){
                    $status = ($_GET['order'] == 'success' ? 7 : -1);
                    $success = ($_GET['order'] == 'success' ? '' : 'outline-');
                    $cancel = ($_GET['order'] == 'cancel' ? '' : 'outline-');
                } else {
                    $status = "-1, 7";
                    $success = 'outline-';
                    $cancel = 'outline-';
                }
            ?>
            <div class="col-md-10 px-0 pb-3 d-flex gap-2">
                <a href="history.php" class="btn btn-<?php echo !isset($_GET['order']) ? '' : 'outline-' ?>primary">ทั้งหมด</a>
                <a href="history.php?order=success" class="btn btn-<?php echo $success ?>success">สำเร็จ</a>
                <a href="history.php?order=cancel" class="btn btn-<?php echo $cancel ?>warning">ยกเลิกแล้ว</a>
            </div>

            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` IN ($status) AND `user_id` = '".$_SESSION['user_id']."' ORDER BY `date`,`time` DESC ");
                include_once '../template/status.php';
            ?>
        </div>
    </div>
</body>
</html>