<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
</head>
<body>
    <?php 
        include 'nav.php';
        $member = 'rider';
        if(isset($_GET['page'])){
            if(file_exists($_GET['page'].'.php')){
                include_once $_GET['page'].'.php';
            } else {
                echo "<h1 class='text-center pt-5 mt-5 blockquote-footer'>ขออภัยไม่พบหน้านี้หรืออาจถูกลบไปแล้ว</h1>";
            }
        } else {
            include_once 'home.php';
        }    
    ?>
    <script src="../function.js"></script>
</body>
</html>