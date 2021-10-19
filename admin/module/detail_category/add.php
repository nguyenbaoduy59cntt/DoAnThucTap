<?php
    $open = "detail_category";
    error_reporting(0);
     require ("../../autoload/autoload.php");
     
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['id']) && ($_POST['id'] != NULL) && isset($_POST['name']) && ($_POST['name'] != NULL))
        {
            $supplier = $_POST['supplier'];
            $category = $_POST['category'];
            $id = $_POST['id'];
            $name = $_POST['name'];
        
                $query = "INSERT INTO `ct_danhmuc`(`ma_ctDM`, `ten_ctDM`,`maDM`,`maNCC`) VALUES ('$id','$name','$category','$supplier')";
                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                    $_SESSION['success'] = 'Thêm mới thành công';
                    redirectUrl('/thuctap2020/admin/module/detail_category/index.php');
                }
        }
        else
            $_SESSION['error'] = 'Thêm mới thất bại, vui lòng kiểm tra lại các trường';
     }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Mới Loại Sản Phẩm</h1>
                    <?php if(isset($_SESSION['error'])):?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                            </div>
                    <?php endif ?>
                    <div class="col-md-12">
                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Nhà cung cấp</label>
                                
                                <select class="form-control" name="supplier">
                                    <?php
                                        echo "<option disabled selected='selected'>Vui lòng chọn nhà cung cấp</option>";
                                        $query1="SELECT * FROM nhacungcap";
                                        $result = mysqli_query($connect,$query1);
                                        while($rows = mysqli_fetch_array($result))
                                        {
                                            echo "<option value=$rows[maNCC]>$rows[tenNCC]</option>";
                                        }
                                    ?>
                                </select>                            
                            </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                
                                <select class="form-control" name="category">
                                
                                    <?php
                                        echo "<option disabled selected='selected'>Vui lòng chọn danh mục</option>";
                                        $query1="SELECT * FROM danhmuc";
                                        $result = mysqli_query($connect,$query1);
                                        while($rows = mysqli_fetch_array($result))
                                        {
                                            echo "<option value=$rows[maDM]>$rows[tenDM]</option>";
                                        }
                                    ?>
                                </select>                            
                            </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Mã loại:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên loại:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>