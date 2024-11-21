<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเมนูอาหาร</title>
</head>
<body>
    <?php 
        include_once 'nav.php';
        $food_id = $_GET['food_id'];
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="food_manage.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-5">แก้ไขรายการอาหาร</h1>
                    <?php
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' ");
                        $row_food = mysqli_fetch_array($select_food);
                        if(!$row_food){
                            alert('ไม่พบเมนูอาหารที่คุณต้องการแก้ไข', 'index.php');
                        }
                    ?>

                    <input type="hidden" name="food_id" value="<?php echo $food_id ?>">
                    <input type="hidden" name="discount" value="<?php echo $row_food['discount'] ?>">

                    <label for="">ชื่อเมนูอาหาร</label>
                    <input type="text" class="form-control mb-3" id="" placeholder="" name="food_name" value="<?php echo $row_food['food_name'] ?>" required>

                    <label for="" >รูปภาพ</label>
                    <center>
                        <img src="../upload/<?php echo $row_food['img'] ?>" class="rounded mb-2 border" style="height: 5rem;" id="preview">
                    </center>
                    <input type="file" class="form-control mb-4" name="img" id="img_upload">

                    <label for="">ราคา</label>
                    <input type="number" class="form-control mb-3" id="" placeholder="" name="price" value="<?php echo $row_food['price'] ?>" required>

                    <label for="">หมวดหมู่อาหาร</label>
                    <select name="food_type" class="form-select mb-4" id="">
                        <option value="<?php echo $row_food['food_type'] ?>"><?php echo $row_food['food_type'] ?></option>
                        <?php  
                            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `food_type` != '".$row_food['food_type']."' AND `res_id` = '".$_SESSION['res_id']."' ");
                            while($row_type = mysqli_fetch_array($select_type)){
                        ?>
                            <option value="<?php echo $row_type['food_type'] ?>"><?php echo $row_type['food_type'] ?></option>
                        <?php } ?>
                    </select>

                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-outline-danger w-100">ยกเลิก</a>
                        <input type="submit" class="btn btn-success w-100" name="food_edit" value="ยืนยัน">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="../function.js"></script>
</body>
</html>