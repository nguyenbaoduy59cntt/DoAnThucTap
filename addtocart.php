<?php
    require ("admin/autoload/autoload.php");
        $id= $_GET['id'];
        $_SESSION['cart'][$id] += 1;
        redirectUrl('/thuctap2020/index.php');
?>