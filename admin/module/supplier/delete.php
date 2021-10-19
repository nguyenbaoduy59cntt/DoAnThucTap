<?php
    $open = "supplier";
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `nhacungcap` WHERE  maNCC= '$id' ";
        $result= mysqli_query($connect,$query);

        if($result)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/thuctap2020/admin/module/supplier/index.php');
        }
?>