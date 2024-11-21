<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve</title>
</head>
<body>
    <?php
        include_once 'nav.php';

        if(!in_array($_GET['permis'], ['restaurant', 'user', 'rider'])){
            echo "<h1 class='text-center pt-5 mt-5 blockquote-footer'>ขออภัยไม่พบหน้านี้</h1>";
        } else {
            $permis = $_GET['permis'];
            $permis_id = ($permis == 'restaurant' ? 'res_id' : $permis.'_id');
    ?>

        <div class="container-fluid">
            <div class="row mt-5">
                
                <!-- เช็คถ้าเป็นร้านอาหารจะแสดงส่วนนี้ (ไม่ต้องจำ Php ก้ได้) -->
                <?php if($permis == 'restaurant'){ ?>
                    <h1 class="text-center">ประเภทร้านอาหาร</h1>
                    <?php
                        $select_type = mysqli_query($conn, "SELECT * FROM `restaurant_type` ");
                        while($row_type = mysqli_fetch_array($select_type)){
                    ?>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                            <div class="card  hover-img mb-3">
                                <div class="card-img-top" style="height: 200px;">
                                    <img src="../upload/<?php echo $row_type['img'] ?>" alt="" class="img">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?php echo $row_type['res_type'] ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-12 my-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_res_type">เพิ่มประเภทร้านอาหาร</button>
                    </div>

                    <div class="modal fade" id="add_res_type" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">เพิ่มประเภทร้านอาหาร</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="approve_db.php" method="post" enctype="multipart/form-data">
                                        <label for="">ประเภทร้านอาหาร</label>
                                        <input type="text" class="form-control mb-3" name="res_type" required>

                                        <label for="">รูปภาพ</label>
                                        <input type="file" class="form-control mb-3" name="img" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <input type="submit" class="btn btn-success" value="บันทึก" name="add_res_type">
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <!-- ------------ restaurant ------------ -->

            </div>

            <!-- ตารางสมาชิก -->
             <!-- ucfirst = ตัวแรกเป็นพิมพ์ใหญ่ -->
            <h2><?php echo ucfirst($permis) ?> Approve</h2>
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover table-bordered text-center shadow">
                    <tr>
                        <th>ชื่อจริง</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <?php if($permis == 'restaurant'){ ?>
                            <th>ชื่อร้านอาหาร</th>
                            <th>ประเภทร้านอาหาร</th>
                        <?php } ?>
                        <th>จัดการ</th>
                    </tr>
                    
                    <?php 
                        $select = mysqli_query($conn, "SELECT * FROM `$permis` ");
                        while($row = mysqli_fetch_array($select)){
                    ?>
                        <tr valign="middle" id="<?php echo $row[$permis_id] ?>">
                            <td><?php echo $row['full_name'] ?></td>
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                        <img src="../upload/<?php echo $row['img'] ?>" alt="" class="img">
                                    </div>
                                </center>
                            </td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <?php if($permis == 'restaurant'){ ?>
                                <td><?php echo $row['res_name'] ?></td>
                                <td><?php echo $row['res_type'] ?></td>
                            <?php } ?>
                            <td>
                                <?php if($row['status'] == 0){ ?>
                                    <a href="approve_db.php?permis=<?php echo $permis.'&permis_id='.$permis_id.'&id='.$row[$permis_id] ?>&status=1" class="btn btn-success">ยืนยัน</a>
                                    <?php } else { ?>
                                        <a href="approve_db.php?permis=<?php echo $permis.'&permis_id='.$permis_id.'&id='.$row[$permis_id] ?>&status=0" class="btn btn-danger">ยกเลิก</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>

    <?php } ?>
</body>
</html>