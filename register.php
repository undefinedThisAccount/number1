<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <?php
        $member = $_GET['member'];
        // ถ้าจะเพิ่ม admin ให้เปลี่ยน header('location: index.php') เป็น 'admin'
        $member_type = $member == 'admin' ? header('location: index.php') :
                  ($member == 'user' ? 'ผู้ใช้งาน' :   
                  ($member == 'restaurant' ? 'ร้านอาหาร' :
                  ($member == 'rider' ? 'ผู้ส่งอาหาร' : header('location: index.php'))));
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6 card shadow p-0">
                
                <ul class="nav nav-tabs bg-light">
                    <li class="nav-item">
                        <a href="?member=user" class="nav-link <?php echo ($member == 'user' ? 'active' : '') ?> ">User</a>
                    </li>
                    <li class="nav-items">
                        <a href="?member=restaurant" class="nav-link <?php echo ($member == 'restaurant' ? 'active' : '') ?> ">Restaurant</a>
                    </li>
                    <li class="nav-items">
                        <a href="?member=rider" class="nav-link <?php echo ($member == 'rider' ? 'active' : '' ) ?> ">Rider</a>
                    </li>
                </ul>

                <form action="system/register_db.php" class="p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-4">สมัครเป็น<?php echo $member_type ?></h1>
                    <input type="hidden" name="member" value="<?php echo $member ?>">

                    <center>
                        <div class="rounded-circle hover-img mb-2" style="width: 7rem; height: 7rem;">
                            <img src="img/df.png" class="img" id="preview">
                        </div>
                        <input type="file" name="img" id="img_upload" hidden>
                        <label for="img_upload" class="btn btn-outline-primary mb-3">เพิ่มรูปโปรไฟล์</label>
                    </center>

                    <?php if($member == 'restaurant'){ ?>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="" placeholder="" name="res_name" required>
                            <label for="">ชื่อร้านอาหาร</label>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="full_name" required>
                        <label for="">ชื่อ-นามสกุล</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="username" placeholder="" name="username" required>
                        <label for="">ชื่อผู้ใช้</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="" placeholder="" name="password" required>
                        <label for="">รหัสผ่าน</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="address" required>
                        <label for="">ที่อยู่</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="phone" class="form-control" id="" placeholder="" name="phone" required>
                        <label for="">เบอร์โทรศัพท์</label>
                    </div>

                    <!-- ตรงนี้จะเขียนแค่ html ก้ได้ -->
                    <?php if($member == 'restaurant') { ?>
                        <label for="">ประเภทร้านอาหาร</label>
                        <select name="res_type" id="" class="form-select mb-4">
                            <?php
                                include_once 'db.php';
                                $select = mysqli_query($conn, 'SELECT * FROM `restaurant_type` ');
                                while($row = mysqli_fetch_array($select)){
                            ?>
                                <option value="<?php echo $row['res_type'] ?>"><?php echo $row['res_type'] ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-outline-danger w-100" >ย้อนกลับ</a>
                        <input type="submit" class="btn btn-success w-100" name="submit" value="ยืนยัน">
                    </div>
                    
                    <p class="text-center mt-4">มีบัญชีแล้ว? <a href="login.php?member=<?php echo $member ?>">เข้าสู่ระบบ</a></p>

                </form>
            </div>
        </div>
    </div>

    <script src="function.js"></script>
</body>
</html>