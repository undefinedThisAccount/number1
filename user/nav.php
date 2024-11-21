<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/style.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<!-- หน้านี้ของ user จะไม่เหมือนอันอื่น -->
<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background: #252525;">
    <div class="container-fluid">
        <?php
            // include_once 'session.php';
            include_once '../db.php';

            // ถ้ามีการล้อคอิน
            if(!empty($_SESSION['user_id'])){
                $select = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['user_id']."' ");
                $row = mysqli_fetch_array($select);
            }
        ?>
        <a href="index.php?page=../template/profile" class="pro-brand">
            <img src="../upload/<?php echo empty($row['img']) ? '../img/logo.png' : $row['img'] ; ?>" class="img">
        </a>
        <a href="" class="navbar-brand"><?php echo $row_web['web_name'] ?></a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#burger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="burger">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <hr class="text-light">
                <li class="nav-item">
                    <a href="index.php?page=home" class="nav-link <?php echo ($_GET['page'] == 'home' ? 'active' : '') ?>">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a href="status.php" class="nav-link <?php echo basename($_SERVER['SCRIPT_NAME']) == 'status.php' ? 'active' : '' ?>">สถานะคำสั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a href="history.php" class="nav-link <?php echo basename($_SERVER['SCRIPT_NAME']) == 'history.php' ? 'active' : '' ?>">ประวัติการสั่งซื้อ</a>
                </li>
            </ul>
            <?php
                // ถ้า user_id ว่าง (คือยังไม่ได้ล็อคอิน)
                if(empty($_SESSION['user_id'])){
            ?>
                <hr class="text-light">
                <a href="../login.php?member=user" class="btn btn-success">ลงชื่อเข้าใช้</a>
            <?php } ?>
        </div>
    </div>
</nav>