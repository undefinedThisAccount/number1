<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปยอดขาย</title>
</head>
<body>
    <?php 
        include_once 'nav.php' ;
        $member = 'res';
    ?>

    <div class="container">
        <div class="row mt-5">
            <h1 class="text-center mb-3">รายงานสรุปยอดขาย วัน/เดือน/ปี</h1>
            <form action="report.php" class="d-flex gap-3" method="get">
                <input type="date" name="date1" id="" class="form-control">
                <input type="date" name="date2" id="" class="form-control">
                <input type="submit" value="ค้นหา" class="btn btn-primary">
            </form>
            <?php
                // if(isset($_GET['date1'] and isset($_GET['date2']))){
                    if(!empty($date1) and !empty($date1)){
                        $date1 = $_GET['date1'];
                        $date2 = $_GET['date2'];
                        echo "<p>ค้นหาจากวันที่ $date1 ถึง $date2</p>";
                        $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`date` BETWEEN '$date1' AND '$date2') AND `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                        $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`date` BETWEEN '$date1' AND '$date2') AND `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                    } else {
                        $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                        $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                    }
                // } else {
                    // $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                    // $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['res_id']."' ");
                // }
                $income = 0;
                while($row_order = mysqli_fetch_array($select)){
                    $income += $row_order['sum_price'];
                }
            ?>
            <p class="text-success my-3">รายได้รวมทั้งสิ้น <?php echo $income ?> บาท</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center mt-2 mb-5">
            <?php
                    include '../template/status.php';
            ?>
        </div>
    </div>

</body>
</html>