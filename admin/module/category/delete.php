<?php
    $open = "category";
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `danhmuc` WHERE  maDM= '$id' ";
        $result= mysqli_query($connect,$query);

        if($result)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/thuctap2020/admin/module/category/index.php');
        }
?>