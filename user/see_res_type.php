<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['see_res_type'] ?></title>
</head>
<body>
    <?php
        include_once 'nav.php';
        if(isset($_GET['see_res_type'])){
            $res_type = $_GET['see_res_type'];
        } else {
            header('location: index.php');
        }
    ?>
    <div class="container">
        <div class="row my-5">
            <h3>
                <a href="index.php" class="btn p-0"><h3>&#11148;</h3></a>
                <?php echo $_GET['see_res_type'] ?>
            </h3>
            <?php
                $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_type` = '".$_GET['see_res_type']."' ");
                if($select_res -> num_rows > 0){
                    while($row_res = mysqli_fetch_array($select_res)){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                    <a href="see_res.php?see_res=<?php echo $row_res['res_id'] ?>" class="text-dark ">
                        <div class="card shadow mb-3 hover-img">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row_res['img'] ?>" class="img">
                            </div>
                            <div class="card-body ">
                                <h5 class="card-title"><?php echo $row_res['res_name'] ?></h5>
                                <h6><?php echo $row_res['res_type'] ?> | ⭐<?php echo ($row_res['star'] > 0)? ($row_res['star'].' ('.$row_res['qty_sale'].')') : 'ยังไม่มีคะแนน' ?></h6>
                                <p class="text-truncate"><?php echo $row_res['address'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }} else { ?>
                <p class="text-center blockquote-footer mt-5">ยังไม่มีร้านอาหารในหมวดหมู่นี้</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>