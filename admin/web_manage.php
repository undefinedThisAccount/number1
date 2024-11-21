<!-- กูจำไม่ได้ว่าที่มึงคิดสดตอนแข่งสั้นกว่านี้มั้ย -->
<div class="container-fluid">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-4 rounded shadow p-3 bg-light pb-4">
            <h1>ข้อมูลเว็บไซต์</h1>
            <hr>
                <form action="web_manage_db.php" class="mb-4" method="post">
                    <h5>ชื่อเว็บไซต์</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" name="web_name" value="<?php echo $row['web_name'] ?>" required>
                        <input type="submit" class="btn btn-secondary" name="web_edit" value="🖊">
                    </div>
                </form>
                <hr>

                <form action="web_manage_db.php" class="mb-4" method="post">
                    <h5>เพิ่มคูปองส่วนลด</h5>
                    <div class="d-flex gap-2">
                        <input type="text" name="cpn_code" class="form-control" placeholder="โค้ดส่วนลด" required>
                        <input type="number" min="1" max="99" name="cpn_discount" class="form-control" placeholder="เพิ่มส่วนลดเป็นเปอร์เซ็นต์" required>
                        <input type="submit" class="btn btn-primary" name="add_cpn" value="ตกลง">
                    </div>
                </form>

                <div class="table-responsive mb-2">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>โค้ดส่วนลด</th>
                                <th>เปอร์เซ็นที่ลด</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $select_cpn = mysqli_query($conn, "SELECT * FROM `coupon` ");
                                while($row_cpn = mysqli_fetch_array($select_cpn)){
                            ?>
                                <tr class="fw-light">
                                    <td><?php echo $row_cpn['cpn_code'] ?></td>
                                    <td><?php echo $row_cpn['cpn_discount'] ?>%</td>
                                    <td>
                                        <a href="web_manage_db.php?del_cpn=<?php echo $row_cpn['cpn_id'] ?>" class="text-danger" onclick="return confirm('ต้องการลบคูปองส่วนลดหรือไม่')">ลบ</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>                                