<?php
    $open = "product";
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `sanpham` WHERE  maSP= '$id' ";
        $result= mysqli_query($connect,$query);

        if($result)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/thuctap2020/admin/module/product/index.php');
        }
?>