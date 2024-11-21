<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การชำระเงิน</title>
    <link rel="stylesheet" href="../style/form.css">
</head>
<body>
    <?php 
        include_once 'nav.php';
        $select_pay = mysqli_query($conn, "SELECT * FROM `payment` WHERE `res_id` = '".$_SESSION['res_id']."' ");
        $row_pay = mysqli_fetch_array($select_pay);
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 pt-5">
                <h1 class="text-center">บัญชีธนาคาร</h1>
                <form action="payment_db.php" method="post" enctype="multipart/form-data" class="card shadow p-3" onchange="form_change();">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="hover-img border h-auto w-100" style="aspect-ratio: 1/1">
                                <label for="img_upload" class="h-100 w-100" style="cursor: pointer;">
                                    <img src="../upload/<?php echo $row_pay['qr_code'] ?>" alt="" id="preview" class="img bg-secondary">
                                </label>
                                <input type="file" name="img" id="img_upload" hidden>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="" placeholder="" name="bank" value="<?php echo $row_pay['bank'] ?>" required>
                                <label for="">บัญชีธนาคาร</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="tel" class="form-control" id="" placeholder="" name="ac_num" value="<?php echo $row_pay['ac_num'] ?>" required>
                                <label for="">เลขบัญชี</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="tel" class="form-control" id="" placeholder="" name="ac_name" value="<?php echo $row_pay['ac_name'] ?>" required>
                                <label for="">ชื่อบัญชี</label>
                            </div>
                            <input type="submit" value="ยืนยันการเปลี่ยนแปลง" name="submit" class="btn btn-primary w-100" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../function.js"></script>
</body>
</html>