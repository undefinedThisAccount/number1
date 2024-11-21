<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    
    <?php
        $member = $_GET['member'];
        $member_type = ($member == 'admin' ? 'ผู้ดูแลระบบ' :
                    ($member == 'user' ? 'ผู้ใช้งาน' : 
                    ($member == 'restaurant' ? 'ร้านอาหาร' :
                    ($member == 'rider' ? 'ผู้ส่งอาหาร' : header('location: index.php')))));
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6 card shadow p-0">

                <ul class="nav nav-tabs bg-light">
                    <li class="nav-item">
                        <a href="?member=admin" class="nav-link <?php echo ($member == 'admin' ? 'active' : '') ?>">admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="?member=user" class="nav-link <?php echo ($member == 'user' ? 'active' : '') ?>">user</a>
                    </li>
                    <li class="nav-item">
                        <a href="?member=restaurant" class="nav-link <?php echo ($member == 'restaurant' ? 'active' : '') ?>">restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a href="?member=rider" class="nav-link <?php echo ($member == 'rider' ? 'active' : '') ?>">rider</a>
                    </li>
                </ul>

                <form action="system/login_db.php" class="p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center">เข้าสู่ระบบ<?php echo $member_type ?></h1>
                    <input type="hidden" name="member" value="<?php echo $member ?>">
                    
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="" placeholder="" name="username" required>
                        <label for="">ชื่อผู้ใช้</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="pass" placeholder="" name="password" required>
                        <label for="">รหัสผ่าน</label>
                    </div>

                    <div class="mb-4">
                        <input type="checkbox" name="" class="form-check-input" id="show" onclick="showpass();">
                        <label for="show">แสดงรหัสผ่าน</label>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-outline-danger w-100">ย้อนกลับ</a>
                        <input type="submit" name="submit" class="btn btn-success w-100" value="ยืนยัน">
                    </div>

                    <?php if($member != 'admin'){ ?>
                        <p class="text-center mt-4">ยังไม่มีบัญชีใช่หรือไม่? <a href="register.php?member=<?php echo $member ?>">สมัครเลย</a></p>
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>

    <script src="function.js"></script>
</body>
</html>