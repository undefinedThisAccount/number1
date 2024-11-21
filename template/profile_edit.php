<link rel="stylesheet" href="../style/form.css">
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <form action="../system/profile_edit_db.php" class="bg-light p-3 card shadow" method="post" enctype="multipart/form-data">
                <h3>
                    <a href="index.php?page=../template/profile" class="btn p-0 m-0" onclick="return confirm('ยังไม่ได้บันทึกข้อมูล ต้องการย้อนกลับหรือไม่?')">
                        <h3 class="d-inline">&#11148;</h3>    
                    </a>
                    แก้ไขข้อมูลส่วนตัว
                    <input type="submit" class="btn p-0 text-primary float-end" value="บันทึก" name="submit">
                </h3>
                <input type="hidden" name="member" value="<?php echo $member ?>">
                <br>

                <center>
                    <div class="rounded-circle hover-img mb-2" style="width: 7rem; height: 7rem;">
                        <img src="../upload/<?php echo $row['img'] ?>" alt="" id="preview" class="img">
                    </div>
                    <input type="file" name="img" id="img_upload" hidden>
                    <label for="img_upload" class="btn btn-outline-primary mb-3">เปลี่ยนโปรไฟล์</label>
                </center>

                <?php if($member == 'restaurant'){ ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="res_name" value="<?php echo $row['res_name'] ?>">
                        <label for="" class="form-label">ชื่อร้านอาหาร</label>
                    </div>
                <?php } ?>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="full_name" value="<?php echo $row['full_name'] ?>">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="username" value="<?php echo $row['username'] ?>">
                    <label for="" class="form-label">ชื่อผู้ใช้</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="address" value="<?php echo $row['address'] ?>">
                    <label for="" class="form-label">ที่อยู่</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="phone" value="<?php echo $row['phone'] ?>">
                    <label for="" class="form-label">เบอร์โทรศัพท์</label>
                </div>

                <?php if($member == 'restaurant'){ ?>
                    <label for="">ประเภทร้านอาหาร</label>
                    <select name="res_type" id="" class="form-select mb-4">
                        <option value="<?php echo $row['res_type'] ?>"><?php echo $row['res_type'] ?></option>
                        <?php
                            $select_type = mysqli_query($conn, "SELECT * FROM `restaurant_type` WHERE `res_type` != '".$row['res_type']."' ");
                            while($row_type = mysqli_fetch_array($select_type)){
                            ?>
                                <option value="<?php echo $row_type['res_type'] ?>"><?php echo $row_type['res_type'] ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>

            </form>
        </div>
    </div>
</div>

