<?php
    require ("autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `dondathang` WHERE  maDDH=$id";
        $resultd= mysqli_query($connect,$query);

        if($resultd)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/thuctap2020/admin/index.php');
        }
?>