<?php
    $temp = explode('.' , $_FILES['img']['name']);
    $filename = rand() . '.' . end($temp);
    $filepath = "../upload/" . $filename;
?>