<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้า</title>
</head>
<body>
    <?php include_once 'nav.php'; ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <h1>ตะกร้า
                <!-- <a href="see_res.php" class="btn btn-primary float-end">เลือกรายการอาหารเพื่ม</a> -->
                 <button class="btn btn-primary float-end" onclick="window.history.back();">เลือกรายการอาหารเพื่ม</button>
            </h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center shadow">
                    <tr>
                        <th>รายการอาหาร</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                        <th>จัดการ</th>
                    </tr>

                    <?php 
                        $sum_food = 0;
                        $all_food_price = 0;
                        $sum_price = 0;
                        foreach($_SESSION['cart_arr'] as $food_id => $food_qty){
                            $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' AND `res_id` = '".$_SESSION['see_res']."' ");
                            while($row_food = mysqli_fetch_array($select_food)){
                    ?>
                        <tr valign="middle">
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 7rem; height: 7rem;">
                                        <img src="../upload/<?php echo $row_food['img'] ?>" alt="" class="img">
                                    </div>
                                    <p><?php echo $row_food['food_name'] ?></p>
                                </center>
                            </td>
                            <td>
                                <?php
                                    if($row_food['discount'] != 0){
                                        $price = $row_food['new_price']
                                ?>
                                    <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                    <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                    <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                                <?php 
                                    } else { 
                                        $price = $row_food['price'];
                                        echo '฿'.$price;
                                    }
                                ?>
                            </td>
                            <td><?php echo $food_qty ?></td>
                            <td>฿
                                <?php
                                    $sum_food = $price * $food_qty;
                                    echo $sum_food;
                                    $all_food_price += $sum_food;
                                    $sum_price += $sum_food;
                                ?>
                            </td>
                            <td>
                                <a href="add_cart_db.php?del=<?php echo $food_id ?>" class="btn btn-warning" onclick="retrun confirm('ต้องการนำออกจากตะกร้าหรือไม่')">ลบ</a>
                            </td>
                        </tr>
                    <?php }} ?>
                </table>
            </div>
            <hr>

            <div class="col-md-6">
                <form action="add_cart_db.php" class="d-flex gap-2 mb-3" method="post">
                    <input type="text" class="form-control me-2" name="cpn_code" placeholder="กรอกโค้ดส่วนลด" required>
                    <input type="submit" class="btn btn-primary me-2" name="add_cpn" value="ยืนยัน">
                </form>

                <?php
                    if(isset($_GET['cpn_dis'])){
                        $cpn_disc = $_GET['cpn_dis'];
                        $sum_price = discount($all_food_price, $cpn_disc);
                ?>
                    <h5>ค่าอาหาร <span class="float-end">฿<?php echo $all_food_price ?></span></h5>
                    <h5 class="text-danger">ส่วนลด<span class="float-end">- <?php echo $cpn_disc ?>%</span></h5>
                <?php } else { $cpn_disc = 0; } ?>

                <h5 class="text-success mb-4">ทั้งหมด<span class="float-end">฿<?php echo $sum_price ?></span></h5>

                <?php
                    $select_payment = mysqli_query($conn, "SELECT * FROM `payment` WHERE `res_id` = '".$_SESSION['see_res']."' ");
                    $row_pay = mysqli_fetch_array($select_payment);
                ?>

                <form action="insert_order.php" method="post" enctype="multipart/form-data">
                    <p>การชำระเงิน</p>
                    <!-- เงินสด -->
                    <label for="cash" class="form-check-label p-3 rounded w-100 mb-3 border" onclick="close_qr()">
                        <div class="form-check">
                            <input type="radio" name="payment" class="form-check-input" id="cash" value="cash" checked required>
                            <strong>เงินสด</strong>
                            <br>
                            ชำระเงินปลายทาง
                        </div>
                    </label>

                    <!-- โอนจ่าย -->
                    <div class="accordion mb-3" >
                        <div class="accordion-item">
                            <label for="transfer" class="form-check-label p-3 rounded w-100 accordion-button"
                                data-bs-toggle="collapse" data-bs-target="#qr_code" onclick="open_qr();" id="test" >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="transfer" value="transfer" required>
                                    <strong>ชำระทันที</strong>
                                    <br>
                                    โอนจ่าย
                                </div>
                            </label>

                            <div id="qr_code" class="accordion-collapse collapse ">
                                <div class="accordion-body d-flex gap-2">
                                    <div class="hover-img border" style="width: 7rem;">
                                        <a data-bs-toggle="modal" data-bs-target="#qr_zoom">
                                            <img src="../upload/<?php echo $row_pay['qr_code'] ?>" alt="" class="img" >
                                        </a>
                                    </div>
                                    <div>
                                        <p>ธนาคาร : <?php echo $row_pay['bank'] ?></p>
                                        <p>เลขบัญชี : <?php echo $row_pay['ac_num'] ?></p>
                                        <p >ชื่อบัญชี : <?php echo $row_pay['ac_name'] ?></p>
                                    </div>
                                </div>
                                <input type="file" name="img" id="slip" class="mx-3 mb-3 " >
                            </div>
                        </div> 
                    </div>

                    <hr class="my-5">
                    
                    <div class="card shadow p-4 mb-5">
                        <h2 class="text-center mb-4">ยืนยันข้อมูลผู้สั่ง</h2>
                        
                        <input type="hidden" name="all_food_price" value="<?php echo $all_food_price ?>">
                        <input type="hidden" name="cpn_discount" value="<?php echo $cpn_disc ?>">
                        <input type="hidden" name="sum_price" value="<?php echo $sum_price ?>">
                        
                        <label for="">ชื่อ-สกุล</label>
                        <input type="text" class="form-control mb-3" name="full_name" value="<?php echo $row['full_name'] ?>" >
                        
                        <label for="">ที่อยู่</label>
                        <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address'] ?>" >
                        
                        <label for="">เบอร์โทร</label>
                        <input type="tel" class="form-control mb-3" name="phone" value="<?php echo $row['phone'] ?>" >
                        
                        <input type="submit" class="btn btn-success w-100" value="สั่งเลย" name="buy_order">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="qr_zoom" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">แสกน QR Code</h4>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <img src="../upload/<?php echo $row_pay['qr_code'] ?>" alt="" class="bg-lightm">
            </div>
        </div>
    </div>

    <script src="../function.js"></script>

</body>
</html>