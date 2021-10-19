<?php
    $open = "detail_category";
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `ct_danhmuc` WHERE  ma_ctDM= '$id' ";
        $result= mysqli_query($connect,$query);

        if($result)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/thuctap2020/admin/module/detail_category/index.php');
        }
?>