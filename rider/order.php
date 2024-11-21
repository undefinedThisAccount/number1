<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออร์เดอร์ขณะนี้</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member = 'res;'
    ?>
    
    <div class="container my-5">
        <div class="row my-4">
            <div class="text-center">ออร์เดอร์ขณะนี้</div>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 2 ");
                while($row_order = mysqli_fetch_array($select_order)){
                    $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$row_order['res_id']."' ");
                    $row = mysqli_fetch_array($select);
            ?>
                <div class="col-lg-3 col-md-4 col-sm 6 col-6 p-lg-1 p-md1 p-sm-1 p-0">
                    <div class="card shadow p-2 h-100">
                        <div class="text-center">
                            <h4>ร้าน <?php echo $row['res_name'] ?></h4>
                            <p><?php echo $row['address'] ?></p>
                        </div>
                        <hr class="mt-0 mb-2">
                        <div class="card-body p-0">
                            <h6 class="d-inline">
                                <?php echo ($row_order['slip'] == 0) ? 'เงินสด' : 'ชำระทันที'; ?>
                                <h6 class="d-flex float-end"><?php echo $row_order['sum_price'] ?></h6>
                            </h6>
                            <p>จัดส่งที่ : <?php echo $row_order['address'] ?></p>
                        </div>
                        <a href="see_res.php?rider_see_res=<?php echo $row_order['res_id'].'#'.$row_order['order_code'] ?>" class="btn btn-primary">รายละเอียด</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

