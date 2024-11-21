<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once 'nav.php';
        $member = 'restaurant';

        /*
            จริงๆอันนี้จะทำเหมือนเมื่อก่อนก้ได้ แบบสมมติสร้างไฟล์ profile.php ในโฟลเดอร์นี้ใช่ป่ะ ก้ค่อยดึงในไฟล์นั้น
            สมมติว่าอยู่ใน res/profile.php ก้จะเป็น
            <?php
                include_once 'nav.php';
                $member = 'restaurant';
                include_once '../template/profile.php';
            ?>
            แล้วไฟล์ index.php ก็เป็นเหมือนเมื่อก่อนเลย เขียนหน้าหลักปกติอ่ะ
            เอาที่มึงถนัด จะแบบเก่าหรือใหม่ก็ได้เหมือนกัน (กูแค่ลองเขียนแบบใหม่ตามสุพรรณดูเฉยๆ)
        */
        if(isset($_GET['page'])){
            if(file_exists($_GET['page'].'.php')){
                include_once $_GET['page'].'.php';
            } else {
                echo "<h1 class='text-center pt-5 mt-5 blockquote-footer'>ขออภัยไม่พบหน้านี้</h1>";
            }
        } else {
            include_once 'home.php';
        }
    ?>
    <script src="../function.js"></script>
</body>
</html>