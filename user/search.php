<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหารายการอาหาร</title>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <div class="row my-5">
                <h3>
                    <a href="see_res.php" class="btn p-0"><h3>&#11148;</h3></a>
                    ค้นหารายการอาหาร
                </h3>
                <form action="search.php" class="form-control d-flex p-3 mb-3 shadow" method="get">
                    <input type="search" class="form-control me-2" name="find" placeholder="กินไรดีจ๊ะสุดหล่อ" value="<?php echo (isset($_GET['find']) ? $_GET['find'] : '') ?>">
                    <?php if(isset($_GET['find'])){ ?>
                        <a href="search.php" class="btn btn-warning text-nowrap mx-2">รีเซ็ท</a>
                    <?php } ?>
                    <input type="submit" class="btn btn-primary" value="ค้นหา" >
                </form>

            <div class="row">
                <?php
                    if(isset($_GET['find'])){
                        $find = $_GET['find'];
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_name` LIKE '%$find%' AND `res_id` = '".$_SESSION['see_res']."' ");
                    } else {
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '".$_SESSION['see_res']."'");
                    }   
                    if($select_food -> num_rows > 0){
                        while($row_food = mysqli_fetch_array($select_food)){
                            include 'food_item.php';
                            include 'food_modal.php';
                        }
                    } else { 
                ?>
                    <p class="text-center blockquote-footer mt-4">ไม่พบเมนูนี้</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="position-fixed bottom-0 end-0 p-3">
            <a href="cart.php" class="position-relative btn btn-outline-primary mx-2">
                <h3>🛒</h3>
                <?php if(count($_SESSION['cart_arr']) > 0){ ?>
                    <span class="position-absolute top-0 start-100 bg-danger rounded-pill translate-middle badge"><?php echo count($_SESSION['cart_arr']) ?></span>
                <?php } ?>
            </a>
        </div>
    </div>
</body>
</html>