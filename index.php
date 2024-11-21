<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include 'db.php';
        $select = mysqli_query($conn, 'SELECT `web_name` FROM `admin` ');
        $row = mysqli_fetch_array($select);
    ?>
    <title><?php echo $row['web_name']; ?></title>

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    
    <!-- navbar เหมือนที่เคยทำเลยแค่เพิ่ม dropdown -->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background: #252525a1; backdrop-filter: blur(5px);">
        <div class="container-fluid">
            <a href="index.php" class="pro-brand">
                <img src="img/logo.png" alt="" class="img">
            </a>
            <a href="index.php" class="navbar-brand"><?php echo $row['web_name'] ?></a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="hamburger">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <hr class="text-light">

                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a href="user/index.php" class="nav-link">สั่งอาหาร</a>
                    </li>

                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" >
                            พาร์ทเนอร์
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="register.php?member=restaurant" class="dropdown-item">เปิดร้านอาหาร</a></li>
                            <li><a href="register.php?member=restaurant" class="dropdown-item">สมัครเป็นผู้ส่งอาหาร</a></li>
                        </ul>
                    </li>
                </ul>

                <hr class="text-light">
                <a href="login.php?member=user" class="btn btn-success">ลงชื่อเข้าใช้</a>
            </div>
        </div>
    </nav>

    <section>
        <div class="carousel slide" id="slider" data-bs-ride="carousel" >
            <!-- ปุ่มเลื่อนด้านล่าง -->
            <ol class="carousel-indicators">
                <button data-bs-target="#slider" data-bs-slide-to="0" class="active"></button>
                <button data-bs-target="#slider" data-bs-slide-to="1"></button>
                <button data-bs-target="#slider" data-bs-slide-to="2"></button>
            </ol>
            
            <div class="carousel-inner">
                <div class="carousel-item bg-img-1 active">
                    <div class="dark-overlay">
                        <div class="container h-100 ">
                            <div class="row align-items-center h-100">
                                <div class="col-md-8 text-light">
                                    <h3 class="display-4">Order Food</h3>
                                    <h1 class="display-1">สั่งอาหารออนไลน์</h1>
                                    <h3>
                                        พบกับหลากเมนูจากหลายร้านร้านค้าที่พร้อมส่งถึงมือคุณ
                                        พร้อมส่วนลดเพื่อมื้อสุขสุดคุ้มอีกมากมาย
                                    </h3>

                                    <a href="user/index.php" class="btn btn-outline-light px-5 py-3">สั่งซื้อเลย!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item bg-img-2">
                    <div class="dark-overlay">
                        <div class="container h-100">
                            <div class="row align-items-center h-100 ">
                                <div class="col-md-8 text-light ">
                                    <h3 class="display-4">Resterant</h3>
                                    <h1 class="display-1">เปิดร้านอาหารกับเรา</h1>
                                    <h3>เข้าถึงลูกค้าได้มากกว่า เพื่อเพิ่มยอดขายให้ธุรกิจร้านอาหารของคุณ</h3>

                                    <a href="register.php?member=restaurant" class="btn btn-outline-light px-5 py-3">เปิดร้านกับเรา</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item bg-img-3">
                    <div class="dark-overlay">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-8 text-light">
                                    <h3 class="display-4">Delivery Man</h3>
                                    <h1 class="display-1">สมัครเป็นผู้ส่งอาหาร</h1>
                                    <h3>งานส่งอาหาร ที่เลือกวันและเวลาทำงานได้อย่างอิสระ เลือกทำเป็นงานเสริมหรืองานประจำก็ได้ สมัครง่ายไม่มีค่าใช้จ่าย</h3>

                                    <a href="register.php?member=rider" class="btn btn-outline-light px-5 py-3">สมัครเลย</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" data-bs-target="#slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                
                <button class="carousel-control-next" data-bs-target="#slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
        </div>
    </section>
</body>
</html>