<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มส่วนลด</title>
</head>
<body>
    <?php
        include 'nav.php';
        $food_id = $_GET['food_id'];
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="food_manage.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-5">เพิ่มส่วนลด</h1>
                    <?php
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' ");
                        $row_food = mysqli_fetch_array($select_food);
                        if(!$row_food){
                            alert('ไม่พบเมนูอาหารที่คุณต้องการแก้ไข', 'index.php');
                        }
                    ?>

                    <input type="hidden" name="food_id" value="<?php echo $food_id ?>">

                    <label for="">ชื่อเมนูอาหาร</label>
                    <input type="text" class="form-control mb-3" id="" placeholder="" name="food_name" value="<?php echo $row_food['food_name'] ?>" readonly>

                    <label for="" >รูปภาพ</label>
                    <center>
                        <img src="../upload/<?php echo $row_food['img'] ?>" class="rounded mb-2 border" style="height: 5rem;" id="preview">
                    </center>

                    <label for="">ราคา</label>
                    <input type="number" class="form-control mb-3" id="" placeholder="" name="price" value="<?php echo $row_food['price'] ?>" readonly>

                    <label for="">เพิ่มส่วนลด (%)</label>
                    <input type="number" min="0" max="99" class="form-control mb-4" id="" placeholder="" name="discount" value="<?php echo $row_food['discount'] ?>" >

                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-outline-danger w-100">ยกเลิก</a>
                        <input type="submit" class="btn btn-success w-100" name="food_dis" value="ยืนยัน">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>