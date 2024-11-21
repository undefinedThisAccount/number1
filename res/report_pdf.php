<?php
    include 'nav.php';
	require_once __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf([
		'default_font_size' => '18',
		'default_font' => 'sarabun'
	]);

	// $mpdf->WriteHTML('<h1 style="text-align: center";>'.$row['res_name'].'</h1>');
	$mpdf->SetFont('sarabun','',16);

    ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปยอดขาย</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    
    <?php   
        $order_code = $_GET['order_code'];
        $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `order_code` = '$order_code' ");
        $row_order = mysqli_fetch_array($select_order)
    ?>
        <div class="container-fluid ">
            <div class="row justify-content-center py-5">
                <div class="col-md-4 border rounded p-2">
                    <div class="text-center ">
                        <h2 style="font-size: 1.5rem; font-weight: bold;"><?php echo $row['res_name'] ?></h2>
                        <p class="mb-0">
                            <?php echo $row['address'] ?>
                            <br>
                            โทร <?php echo $row['phone'] ?>
                            <br>
                            <?php echo $row_order['date'].'  '.$row_order['time'] ?>
                        </p>
                    </div>
                    <hr>

                    <table class="tablee w-100">
                        <tbody>
                            <?php
                                $all_price = 0;
                                $all_qty = 0;
                                $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '$order_code' ");
                                while($row_food = mysqli_fetch_array($select_food)){
                            ?>
                                <tr>
                                    <td><?php echo $row_food['food_name'].' x'.$row_food['qty'] ?></td>
                                    <td align="right">
                                        <?php if($row_food['new_price'] != 0){ ?>
                                            <s>฿<?php echo $row_food['price'] ?></s>
                                            <span>฿<?php echo $row_food['new_price'] ?></span>
                                        <?php } else { 
                                            echo '฿'.$row_food['price'];
                                        } ?>
                                        บาท
                                    </td>
                                </tr>
                            <?php } ?>
                            
                            <div>
                                <?php
                                    if($row_order['cpn_discount'] > 0){
                                ?>
                                    <tr>
                                        <td style="font-weight: bold;">ค่าอาหาร</td>
                                        <td style="font-weight: bold;" align="right"><?php echo $row_order['all_food_price']; ?></td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;">ส่วนลด</td>
                                        <td style="font-weight: bold;" align="right"><?php echo $row_order['cpn_discount']; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="font-weight: bold;">ทั้้งหมด</td>
                                        <td style="font-weight: bold;" align="right"><?php echo $row_order['sum_price']; ?></td>
                                    </tr>
                                    
                                <?php } else { ?>
                                    <tr>
                                        <td style="font-weight: bold;">ทั้้งหมด</td>
                                        <td style="font-weight: bold;" align="right"><?php echo $row_order['sum_price']; ?></td>
                                    </tr>
                                <?php } ?>
                                
                                <tr>
                                    <td style="font-weight: bold;">การชำระเงิน</td>
                                    <td style="font-weight: bold;" align="right">
                                        <?php echo $row_order['slip'] != 0 ? 'ชำระทันที' : 'เงินสด' ?>
                                    </td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                    <hr>

                    <div style="font-weight: bold;">ข้อมูลผู้สั่ง</div> 
                    ชื่อผู้สั่ง <?php echo $row_order['full_name'] ?><br>
                    ที่อยู่ <?php echo $row_order['address'] ?><br>
                    เบอร์โทร <?php echo $row_order['phone'] ?><br>
                </div>
            </div>
        </div>

    <?php
	
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Receipt.pdf');

        ob_end_flush();
    ?>

    <div class="d-flex justify-content-center m-3">
        <a href="report.php" class="btn btn-outline-secondary w-25 me-2">ย้อนกลับ</a>
        <a href="Receipt.pdf" class="btn btn-success w-25 me-2">พิมพ์</a>
    </div>
</body>
</html>
