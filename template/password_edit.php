<link rel="stylesheet" href="../style/form.css">
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-6">
            <form action="../system/password_edit_db.php" class="card shadow p-4" method="post">
                <h1 class="text-center mb-5">เปลี่ยนรหัสผ่าน</h1>
                <input type="hidden" name="member" value="<?php echo $member ?>">

                <div class="form-floating mb-4">
                    <input type="password" class="password form-control" id="pass" placeholder="" name="old_pass" required>
                    <label for="" class="form-label">รหัสผ่านเก่า</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="password form-control" id="pass1" placeholder="" name="new_pass" required>
                    <label for="" class="form-label">รหัสผ่านใหม่</label>
                </div>

                <div class="mb-4">
                    <input type="checkbox" class="form-check-input" id="show" onclick="showpass();"> 
                    <label for="show">แสดงรหัสผ่าน</label>
                </div>

                <div class="d-flex gap-3">
                    <a href="index.php?page=../template/profile" class="btn btn-danger w-100">ย้อนกลับ</a>
                    <input type="submit" class="btn btn-success w-100" name="submit" value="ยืนยัน">
                </div>

            </form>
        </div>
    </div>
</div>

<script src="../function.js"></script>