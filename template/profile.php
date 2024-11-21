<!-- หน้านี้พวก name ไม่ต้องใส่ก็ได้เพราะมันไม่ได้ใช้ หรือจะใส่ก็ได้แล้วก็อปไปไว้หน้า profile_edit -->
<?php
    include_once 'session.php';
?>
<link rel="stylesheet" href="../style/form.css">
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <form action="" class="bg-light p-3 card shadow" method="post">
                <h3>ข้อมูลส่วนตัว
                    <a href="index.php?page=../template/profile_edit" class="btn text-primary float-end">แก้ไข</a>
                </h3>
                <br>

                <center>
                    <div class="rounded-circle hover-img mb-2 border" style="width: 7rem; height: 7rem;">
                        <img src="../upload/<?php echo $row['img'] ?>" alt="" class="img">
                    </div>
                    <a href="index.php?page=../template/password_edit" class="btn btn-warning mb-3">เปลี่ยนรหัสผ่าน</a>
                </center>

                <?php if($member == 'restaurant'){ ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="res_name" value="<?php echo $row['res_name'] ?>" readonly>
                        <label for="" class="form-label">ชื่อร้านอาหาร</label>
                    </div>
                <?php } ?>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" palceholder="" name="full_name" value="<?php echo $row['full_name'] ?>" readonly>
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="edit" placeholder="" name="username" value="<?php echo $row['username'] ?>" readonly>
                    <label for="" class="form-label">ชื่อผู้ใช้</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="" placeholder="" name="address" value="<?php echo $row['address'] ?>" readonly>
                    <label for="" class="form-label">ที่อยู่</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="tel" class="form-control mb-4" id="" placeholder="" name="phone" value="<?php echo $row['phone'] ?>" readonly>
                    <label for="" class="form-label">เบอร์โทรศัพท์</label>
                </div>
                
                <?php if($member == 'restaurant'){ ?>
                    <!-- profile กับ profile_edit จะต่างแค่ตรงนี้ หน้า edit ก็ก้อปจาก register มาก้ได้  -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="res_type" value="<?php echo $row['res_type'] ?>" readonly>
                        <label for="" class="form-label">ประเภทร้านอาหาร</label>
                    </div>
                <?php } ?>

                <a href="logout.php" class="btn btn-outline-danger w-100 mt-1" onclick="return confirm('ต้องการออกจากระบบใช้หรือไม่?')">ออกจากระบบ</a>
                
            </form>
        </div>
    </div>
</div>