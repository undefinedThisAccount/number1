<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/style.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background: #40513B;">
    <div class="container-fluid">
        <?php
            include_once 'session.php';

            $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$_SESSION['res_id']."' ");
            $row = mysqli_fetch_array($select);

            // $page = $_GET['page'];
        ?>
        <a href="index.php?page=../template/profile" class="pro-brand">
            <img src="../upload/<?php echo $row['img'] ?>" class="img">
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
                    <a href="payment.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'payment.php' ? 'active' : '') ?>">ตัวเลือกชำระเงิน</a>
                </li>
                <li class="nav-item">
                    <a href="order.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'order.php' ? 'active' : '') ?>">รับรายการอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="report.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'report.php' ? 'active' : '') ?>">รายงานสรุปยอดขาย</a>
                </li>
            </ul>
        </div>

    </div>
</nav>