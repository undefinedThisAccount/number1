<!-- ถ้าเหลือเวลาสัก 2 ชั่วโมงค่อยใช้หน้านี้ -->

<div class="container-fluid">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10 rounded shadow p-3 bg-light pb-4">
            <h1>ข้อมูลเว็บไซต์</h1>
            <hr>
            <div class="row mt-2">
                <div class="col-md-6 col-sm-12 pt-3">
                    <form action="web_manage.php" class="mb-4">
                        <h5>ชื่อเว็บไซต์</h5>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" name="web_name" value="<?php echo $row['web_name'] ?>">
                            <input type="submit" class="btn btn-secondary" name="web_edit" value="🖊">
                        </div>
                    </form>

                    <hr>

                    <form action="web_mange_db.php" class="mb-4" method="post">
                        <h5>เพิ่มคูปองส่วนลด</h5>
                        <div class="d-flex gap-2">
                            <input type="text" name="cpn_code" class="form-control" placeholder="โค้ดส่วนลด" required>
                            <input type="number" min="1" max="99" name="cpn_discount" class="form-control" placeholder="เพิ่มส่วนลดเป็นเปอร์เซ็นต์" required>
                            <input type="submit" class="btn btn-primary" name="add_cpn" value="ตกลง">
                        </div>
                    </form>

                    <div class="table-responsive mb-2">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>โค้ดส่วนลด</th>
                                    <th>เปอร์เซ็นที่ลด</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $select_cpn = mysqli_query($conn, "SELECT * FROM `coupon` ");
                                    while($row_cpn = mysqli_fetch_array($select_cpn)){
                                ?>
                                    <tr class="fw-light">
                                        <td><?php echo $row_cpn['cpn_code'] ?></td>
                                        <td><?php echo $row_cpn['cpn_discount'] ?>%</td>
                                        <td>
                                            <a href="web_manage.php?del_cpn=<?php echo $row_cpn['cpn_id'] ?>" class="text-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ไม่จำเป็น ไหวค่อยทำ -->
                <?php
                    $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` ");
                    $res_qty = $select_res -> num_rows;

                    $select_res = mysqli_query($conn, "SELECT * FROM `user` ");
                    $user_qty = $select_res -> num_rows;

                    $select_res = mysqli_query($conn, "SELECT * FROM `rider` ");
                    $rider_qty = $select_res -> num_rows;

                    $all_member = $res_qty + $user_qty + $rider_qty;
                    $res = ($res_qty != 0) ? ($res_qty / $all_member * 100) : $res_qty = 0;
                    $user = ($user_qty != 0) ? ($user_qty / $all_member * 100) : $user = 0;
                    $rider = ($rider_qty != 0) ? ($rider_qty / $all_member * 100) : $rider = 0;
                ?>
                <div class="col-md-6 col-sm-12 pt-3">
                    <h5>จำนวนสมาชิกทั้งหมด : <?php echo $all_member ?></h5>
                    <div class="progress h-25 mb-4">
                        <div class="progress-bar bg-primary" style="width: <?php echo number_format($user, 2) ?>%">
                            ผู้ใช้งาน <?php echo number_format($user, 2) ?>%
                        </div>
                        <div class="progress-bar bg-success" style="width: <?php echo number_format($res, 2) ?>%">
                            ร้านอาหาร <?php echo number_format($res, 2) ?>%
                        </div>
                        <div class="progress-bar bg-secondary" style="width <?php echo number_format($user, 2) ?>%">
                            ผู้ส่งอาหาร <?php echo number_format($rider, 2) ?>%
                        </div>
                    </div>

                    <a href="approve.php?page=user" class="btn btn-outline-primary w-100 mb-2">
                        <div class="row">
                            <div class="col text-start">ผู้ใช้งาน</div>
                            <div class="col text-end"><?php echo $user_qty ?></div>
                        </div>
                    </a>

                    <a href="approve.php?page=restaurant" class="btn btn-outline-success w-100 mb-2">
                        <div class="row">
                            <div class="col text-start">ร้านอาหาร</div>
                            <div class="col text-end"><?php echo $res_qty ?></div>
                        </div>
                    </a>

                    <a href="approve.php?page=rider" class="btn btn-outline-secondary w-100 mb-2">
                        <div class="row">
                            <div class="col text-start">ผู้ส่งอาหาร</div>
                            <div class="col text-end"><?php echo $rider_qty ?></div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>                                