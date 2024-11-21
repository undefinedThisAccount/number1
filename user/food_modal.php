<!-- ย้าย form มาครอบนอกสุด -->
<form action="add_cart_db.php" method="post" class="modal fade" id="see_food_<?php echo $row_food['food_id'] ?>" onmousemove="up_<?php echo $row_food['food_id'] ?>()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $row_food['food_name'] ?></h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img src="../upload/<?php echo $row_food['img'] ?>" alt="" class="img" style="width: 100%; height: 250px;">
                <p class="my-3">
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
                </p>
                <div class="d-flex gap-2">
                    <p class="btn btn-warning" onclick="minus_<?php echo $row_food['food_id'] ?>()">➖</p>
                    <input type="number" class="form-control h-25" name="qty" min="1" max="100" id="qty_<?php echo $row_food['food_id'] ?>" value="1">
                    <p class="btn btn-primary" onclick="plus_<?php echo $row_food['food_id'] ?>()">➕</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="food_id" value="<?php echo $row_food['food_id'] ?>">
                <input type="submit" class="btn btn-outline-success" id="sum_<?php echo $row_food['food_id'] ?>" name="add_cart" value="เพิ่มลงตะกร้า ฿<?php echo $price ?>">
            </div>
        </div>
    </div>
</form>

<script>
    function plus_<?php echo $row_food['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
        var input_value = parseInt(input.value);
        input.value = input_value + 1;

        var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
        sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>)
    }

    function minus_<?php echo $row_food['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
        var input_value = parseInt(input.value);
        if(input_value > 1){
            input.value = input_value - 1;
            var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
            sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
        }
    }

    function up_<?php echo $row_food['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
        var input_value = parseInt(input.value);
        var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
        sum.value = 'เพิ่มลงตะกร้า ฿' + (input.value * <?php echo $price ?>);
    }

</script>