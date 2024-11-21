<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    
    <?php
        include_once 'nav.php';
        $member = 'admin';
        
        if(isset($_GET['page'])){
            // เช็คว่าไฟล์ที่กำลังจะดึงมามีอยู่จริงไหม
            if(file_exists($_GET['page'].'.php')){
                include_once $_GET['page'].'.php';
            } else {
                echo "<h1 class='text-center pt-5 mt-5 blockquote-footer'>ขออภัย ไม่พบหน้านี้</h1>";
            }
        } else {
            include_once 'web_manage.php';
        }

    ?>

    <script src="../function.js"></script>
</body>
</html>