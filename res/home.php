<div class="container-fluid mb-5 ">
    <div class="row mt-5">
        <h1 class="text-center mb-3">หมวดหมู่อาหาร</h1>
        <?php
            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['res_id']."' ");
            if($select_type -> num_rows > 0){
                while($row_type = mysqli_fetch_array($select_type)){
        ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                <div class="card shadow mb-3 hover-img">
                    <div class="card-img-top hover-img" style="height: 200px">
                        <img src="../upload/<?php echo $row_type['img'] ?>" alt="" class="img">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title"><?php echo $row_type['food_type'] ?></h4>
                        <a href="food_manage.php?del_type=<?php echo $row_type['food_type_id'] ?>" onclick="return confirm('ต้องการลบ <?php echo $row_type['food_type'] ?> หรือไม่?')" class="btn btn-danger">ลบ</a>
                    </div>
                </div>
            </div>
        <?php }} else { ?>
            <p class="text-center blockquote-footer">ยังไม่มีหมวดหมู่อาหาร</p>
        <?php } ?>
    </div>

    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#add_food_type">เพิ่มหมวดหมู่อาหาร</button>

    <!-- ตรงนี้คล้ายเดิมแค่ย้าย <form> มาครอบด้านนอกจะได้ไม่งงกับ tag -->
    <form action="food_manage.php" method="post" enctype="multipart/form-data" class="modal fade" id="add_food_type" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มหมวดหมู่อาหาร</h4>
                    <!-- อย่าลืม type="button" -->
                    <button class="btn-close" type="button" data-bs-dismiss="modal" ></button>
                </div>
                <div class="modal-body">
                    <label for="">หมวดหมู่อาหาร</label>
                    <input type="text" class="form-control mb-3" name="food_type" required>

                    <label for="">รูปภาพ</label>
                    <input type="file" class="form-control mb-3" name="img" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">ยกเลิก</button>
                    <input type="submit" class="btn btn-success" name="add_food_type" value="บันทึก">
                </div>
            </div>
        </div>
    </form>
    
    <h2>รายการอาหาร
        <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_food">เพิ่มรายการอาหาร</button>
    </h2>

    <form action="food_manage.php" method="post" enctype="multipart/form-data" class="modal fade" id="add_food">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายการอาหาร</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="">ชื่อเมนูอาหาร</label>
                    <input type="text" class="form-control mb-3" name="food_name">

                    <label for="">รูปภาพ</label>
                    <input type="file" class="form-control mb-3" name="img">

                    <label for="">ราคา</label>
                    <input type="number" class="form-control mb-3" name="price">

                    <label for="">หมวดหมู่อาหาร</label>
                    <select name="food_type" class="form-select mb-3" id="">
                        <option value="อื่นๆ">อื่นๆ</option>
                        <?php
                            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['res_id']."' ");
                            while($row_type = mysqli_fetch_array($select_type)){
                        ?>
                            <option value="<?php echo $row_type['food_type'] ?>"><?php echo $row_type['food_type'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">ยกเลิก</button>
                    <input type="submit" class="btn btn-success" name="add_food" value="บันทึก">
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover table-bordered text-center shadow">
            <tr>
                <th>รูปภาพ</th>
                <th>เมนูอาหาร</th>
                <th>ราคา</th>
                <th>หมวดหมู่</th>
                <th>จัดการ</th>
            </tr>
            
            <?php
                $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '".$_SESSION['res_id']."' ");
                while($row_food = mysqli_fetch_array($select_food)){
            ?>
                <tr valign="middle" class="hover-img">
                    <td>
                        <center>
                            <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                <img src="../upload/<?php echo $row_food['img'] ?>" alt="" class="img">
                            </div>
                        </center>
                    </td>
                    <td><?php echo $row_food['food_name'] ?></td> 
                    <td>
                        <?php if($row_food['discount'] != 0){ ?>
                            <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                            <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                            <span class="text-danger">(ลด <?php echo $row_food['discount'] ?> %)</span>
                        <?php } else { 
                            echo '฿'.$row_food['price'];
                        } ?>
                    </td>
                    <td><?php echo $row_food['food_type'] ?></td>
                    <td>
                        <a href="food_edit.php?food_id=<?php echo $row_food['food_id'] ?>" class="btn btn-warning mb-2">แก้ไข</a>
                        <a href="food_discount.php?food_id=<?php echo $row_food['food_id'] ?>" class="btn btn-primary mb-2">ส่วนลด</a>
                        <a href="food_manage.php?del_food=<?php echo $row_food['food_id'] ?>" class="btn btn-danger mb-2" onclick="return confirm('ต้องการลบ <?php echo $row_food['food_name'] ?> หรือไม่?')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div>