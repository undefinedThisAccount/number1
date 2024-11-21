<!-- เหมือนเดิมแค่ย้ายมาไว้หน้านี้แล้วดึงไปใช้ หน้า see_res จะได้ดูไม่เยอะกันลายตาเวลาแก้ เพรามันต้องใช้หน้านี้ 3 ครั้ง -->
<div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
    <a href="" class="text-dark " data-bs-toggle="modal" data-bs-target="#see_food_<?php echo $row_food['food_id'] ?>">
        <div class="card shadow mb-3 hover-img">
            <div class="card-img-top hover-img" style="height: 200px;">
                <img src="../upload/<?php echo $row_food['img'] ?>" class="img">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row_food['food_name'] ?></h5>
                <h6>
                    <?php 
                        if($row_food['discount'] != 0){ 
                            $price = $row_food['new_price'];
                    ?>
                        <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                        <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                        <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                    <?php } else {
                        $price = $row_food['price'];
                        echo '฿'.$price;
                    } ?>
                </h6>
                <p>
                    <?php
                        if($row_food['star'] != 0){
                            for($i=1; $i<=$row_food['star']; $i++){
                                echo '⭐';
                            }
                            echo $row_food['star'].' ('.$row_food['qty_sale'].' เรตติ้ง)';
                        } else {
                            echo '⭐ยังไม่มีคะแนน';
                        }
                    ?>
                </p>
            </div>
        </div>
    </a>
</div>