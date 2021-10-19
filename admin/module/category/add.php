<?php
    $open = "category";
    error_reporting(0);
     require ("../../autoload/autoload.php");
     
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['id']) && ($_POST['id'] != NULL) && isset($_POST['name']) && ($_POST['name'] != NULL))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
        
                $query = "INSERT INTO `danhmuc`(`maDM`, `tenDM`) VALUES ('$id','$name')";
                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                    $_SESSION['success'] = 'Thêm mới thành công';
                    redirectUrl('/thuctap2020/admin/module/category/index.php');
                }
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
     }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Mới Danh Mục Sản Phẩm</h1>
                    <div class="col-md-12">
                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Mã danh mục:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>