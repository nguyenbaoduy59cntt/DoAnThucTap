<?php
    $open = "category";
    error_reporting(0);
     require ("../../autoload/autoload.php");

     $id= $_GET['id'];
     $query = "SELECT * FROM `danhmuc` WHERE maDM = '$id' ";
     $result = mysqli_query($connect, $query);

     while($row = mysqli_fetch_array($result))
     {
        $idold=$row['maDM'];
        $nameold=$row['tenDM'];
     }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['id']) && ($_POST['id'] != NULL) && isset($_POST['name']) && ($_POST['name'] != NULL))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $query = "UPDATE `danhmuc` SET `maDM`='$id',`tenDM`='$name' WHERE maDM='$id' ";
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                if($name == $nameold && $id == $idold)
                {
                    $_SESSION['success'] = 'Không có gì thay đổi';
                    redirectUrl('/thuctap2020/admin/module/category/index.php');
                }
                else
                {
                    $_SESSION['success'] = 'Cập nhật thành công';
                    redirectUrl('/thuctap2020/admin/module/category/index.php');
                }
            }
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Sửa Danh Mục</h1>
                    <div class="col-md-12">
                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Mã danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $idold?>" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $nameold?>" >
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>