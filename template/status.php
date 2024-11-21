<?php
    while($row_order = mysqli_fetch_array($select_order)){
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$row_order['res_id']."' ");
        $row_res = mysqli_fetch_array($select_res);
        
        if(empty($_SESSION['star'][$row_order['order_code']])){
            $_SESSION['star'][$row_order['order_code']] = 1;
        }
?>
    <span class="mb-5 pb-4 position-absolute" id="<?php echo $row_order['order_code'] ?>"></span>
    <div class="col-md-10 rounded border shadow p-3 mb-5 bg-light" >
        <!-- ส่วนด้านบนของสถานะ -->
        <div class="row">
            <div class="col-md-6">
                <h3>คำสั่งซื้อร้าน : <?php echo $row_res['res_name'] ?></h3>
                <p><?php echo $row_res['address'] ?> | <?php echo $row_res['phone'] ?></p>
            </div>

            <!-- ฝั่งขวาของด้านบน จะเช็คสถานะและแสดงปุ่มของแต่ละประเภทสมาชิก (เขียนแค่โครงแหละ เดี่๋ยวกูมาเขียน php ต่อ หน้านี้น่าจะยาก เวลาจะเช็คหน้าเว็บต้องลองคอมเม้นท์ดูทีละอัน) -->
            <div class="col-md-6">
                <?php if($member == 'user' && ($row_order['status'] == 0 || $row_order['status'] == -1)){ ?>
                    <div class="form-control p-3">
                        <h4 class="text-danger">ออร์เดอร์ของคุณถูกยกเลิก</h4>
                        <?php if($row_order['status'] == 0){ ?>
                            <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=-1" class="btn btn-outline-primary w-100">
                                รับทราบ
                            </a>
                        <?php } ?>
                    </div>
                <?php } else if($member == 'res' && $row_order['status'] == 1){ ?>
                    <div class="border rounded shadow p-2 d-flex gap-2" data-bs-toggle="modal" data-bs-target="#open_slip" style="cursor: pointer;">
                        <div class="hover-img rounded" style="width: 7rem; aspect-ratio: 1 / 1;">
                            <img src="../upload/<?php echo $row_order['slip'] ?>" alt="" class="img">
                        </div>
                        <h5 class="text-danger align-items-center d-flex">ตรวจสอบสลิป และยืนยันออร์เดอร์👆</h5>
                    </div>

                    <div class="modal fade" id="open_slip">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">เช็คสลิป</div>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <img src="../upload/<?php echo $row_order['slip'] ?>" alt="">
                                <div class="modal-footer">
                                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=0" class="btn btn-outline-danger">ยกเลิกออร์เดอร์</a>
                                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=2" class="btn btn-success">ยืนยันสลิปถูกต้อง</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ถ้าจำพวกนี้ไม่ได้ไม่เป็นไรๆ จำเท่าที่ไหว php กุเขียนเอง -->
                <?php } else if($member == 'rider' && $row_order['status'] == 2){ ?>
                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=3" class="btn btn-outline-primary float-end">รับออร์เดอร์เลย!</a>
                <?php } else if($member == 'res' && $row_order['status'] == 3){ ?>
                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=4" class="btn btn-outline-primary float-end">ยืนยันการทำอาหารเสร็จสิ้น</a>
                <?php } else if($member == 'rider' && $row_order['status'] == 4){ ?>
                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=5" class="btn btn-outline-success float-end">อาหารเสร็จแล้ว จัดส่งเลย!</a>
                <?php } else if($member == 'rider' && $row_order['status'] == 5){ ?>
                    <a href="../system/update_status.php?order_code=<?php echo $row_order['order_code'] ?>&status=6" class="btn btn-outline-success float-end">ยืนยันการจัดส่งและชำระเงินเสร็จสิ้น</a>
                <?php } else if($member == 'user' && $row_order['status'] == 6){ ?>
                    <form action="order_review.php" class="form-control p-2" method="post">
                        <h6>อร่อยมั้ยสุดหล่อ</h6>
                        <div class="d-block">
                            <a href="order_review.php?st=1&order_code=<?php echo $row_order['order_code'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row_order['order_code']] > 0 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?st=2&order_code=<?php echo $row_order['order_code'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row_order['order_code']] > 1 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?st=3&order_code=<?php echo $row_order['order_code'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row_order['order_code']] > 2 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?st=4&order_code=<?php echo $row_order['order_code'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row_order['order_code']] > 3 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?st=5&order_code=<?php echo $row_order['order_code'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row_order['order_code']] > 4 ? 3 : 4) ?></h2></a>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="hidden" name="res_id" value="<?php echo $row_order['res_id'] ?>">
                            <input type="hidden" name="order_code" value="<?php echo $row_order['order_code'] ?>">
                            <input type="text" name="review" class="form-control me-2" placeholder="อาหารมื้อนี้เป็นอย่างไรบ้าง">
                            <input type="submit" name="submit_review" value="ยืนยัน" class="btn btn-primary me-2">
                        </div>
                    </form>
                <?php } else if($row_order['status'] == 7){ ?>
                    <form action="" class="form-control p-2">
                        <h6>คะแนนรีวิว
                            <span class="float-end"><?php echo $row_order['date'].' '.$row_order['time'] ?></span>
                        </h6>
                        <h3 class="text-warning">
                            <?php
                                $x = 5 - $row_order['star'];
                                $x = ceil($x);
                                for($i=1; $i<=$row_order['star']; $i++){
                                    echo '&#9733';
                                }
                                for($i=1; $i<=$x; $i++){
                                    echo '&#9734';
                                }
                            ?>
                        </h3>
                        <input type="text" class="form-control me-2" placeholder="รีวิวรายการอาหาร" name="review" value="<?php echo $row_order['review'] ?>" readonly>
                    </form>
                <?php } ?>
            </div>
        </div>
        <hr>

        <!-- เริ่มส่วนกลาง -->
        <div class="row">
            <!-- ส่วนกลางฝั่งซ้าย -->
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>รูปภาพ</th>
                                <th>เมนูอาหาร</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '".$row_order['order_code']."' ");
                                while($row_food = mysqli_fetch_array($select_food)){
                            ?>
                                <tr valign="middle">
                                    <td>
                                        <div class="rounded hover-img shadow-sm" style="width: 5rem; height: 5rem;">
                                            <img src="../upload/<?php echo $row_food['food_img'] ?>" alt="" class="img">
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row_food['food_name'] ?>
                                        <br>
                                        <?php if($row_food['new_price'] != 0){ ?>
                                            <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                            <b class="text-success">฿<?php echo $row_food['new_price'] ?></b>
                                        <?php } else {
                                            echo '฿'.$row_food['price'];
                                        } ?>
                                    </td>
                                    <td><?php echo $row_food['qty'] ?></td>
                                    <td>฿<?php echo $row_food['total_price'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ส่วนกลาง ฝั่งขวา -->
             <div class="col-md-6">
                <div class="card shadow-sm p-3 mb-3">
                    <h4 class="text-center mb-2">ข้อมูลผู้สั่ง</h4>
                    <h5>ชื่อผู้สั่ง : <?php echo $row_order['full_name'] ?></h5>
                    <h5>ที่อยู่ : <?php echo $row_order['address'] ?></h5>
                    <h5>เบอร์โทร : <?php echo $row_order['phone'] ?></h5>
                </div>
                
                <?php if($row_order['status'] != 7 && $row_order['status'] != -1){ ?>
                    <h4>สถานะคำสั่งซื้อ</h4>
                    <progress class="progress w-100" value="<?php echo $row_order['status'] ?>" max="6"></progress>
                    <p>
                        <?php
                            if($row_order['status'] == 0){
                                echo 'คำสั่งซื้อถูกยกเลิก'; // รอ user ยืนยันการลบ
                            } else if($row_order['status'] == 1){
                                echo 'รอร้านค้ายืนยันสลิป'; // ถ้าร้านยกเลิกเป็น 0 ยืนยันเป็น 2
                            } else if($row_order['status'] == 2){
                                echo 'กำลังค้นหาไรเดอร์'; // รอไรเดอร์รับออร์เดอร์
                            } else if($row_order['status'] == 3){
                                echo 'เจอไรเดอร์แล้ว ร้านค้ากำลังทำอาหาร'; // รอร้านกดยืนยันอาหารเสร็จสิ้น
                            } else if($row_order['status'] == 4){
                                echo 'ร้านค้าทำอาหารเสร็จสิ้น'; // รอไรเดอร์กดส่งออร์เดอร์
                            } else if($row_order['status'] == 5){
                                echo 'รอสักครู่ ไรเดอร์กำลังนำอาหารไปส่ง'; // รอ rider กดยืนยันสำเร็จ
                            } else if($row_order['status'] == 6){
                                echo 'จัดส่งสำเร็จและชำระเงินเสร็จสิ้น'; // รอ user review
                            }
                        ?>
                    </p>
                <?php } if($row_order['cpn_discount'] != 0){ ?>
                    <h5>ค่าอาหาร<span class="float-end">฿<?php echo $row_order['total_food_price'] ?></span></h5>
                    <h5 class="text-danger">ส่วนลด<span class="flolat-end"> -<?php echo $row_order['cpn_discount'] ?>%</span></h5>
                <?php } ?>
                <h5 class="text-success">ทั้งหมด<span class="float-end">฿<?php echo $row_order['sum_price'] ?></span></h5>
                <h5>การชำระเงิน <span class="float-end"><?php echo $row_order['slip'] != 0 ? 'ชำระทันที' : 'เงินสด' ?></span></h5>
             </div>
        </div>
        <?php if($row_order['status'] >= 2 && $member == 'res'){ ?>
            <a href="report_pdf.php?order_code=<?php echo $row_order['order_code'] ?>" class="btn btn-outline-primary w-100">ดูใบเสร็จ</a>
        <?php } ?>
    </div>
<?php } ?>