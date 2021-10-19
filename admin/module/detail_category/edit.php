<?php
    $open = "detail_category";
    error_reporting(0);
     require ("../../autoload/autoload.php");

     $id= $_GET['id'];
     $query = "SELECT * FROM `ct_danhmuc` WHERE ma_ctDM = '$id' ";
     $result = mysqli_query($connect, $query);

     while($row = mysqli_fetch_array($result))
     {
        $idold=$row['ma_ctDM'];
        $nameold=$row['ten_ctDM'];
        $categoryold = $row['maDM'];
        $supplierold = $row['maNCC'];
     }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['id']) && isset($_POST['name']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category = $_POST['maDM'];
            $supplier = $_POST['supplier'];

            $query = "UPDATE `ct_danhmuc` SET `ma_ctDM`='$id',`ten_ctDM`='$name',`maDM`='$category',`maNCC`='$supplier' WHERE ma_ctDM='$id' ";
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                if($name == $nameold && $id == $idold && $categoryold == $category)
                {
                    $_SESSION['success'] = 'Không có gì thay đổi';
                    redirectUrl('/thuctap2020/admin/module/detail_category/index.php');
                }
                else
                {
                    $_SESSION['success'] = 'Cập nhật thành công';
                    redirectUrl('/thuctap2020/admin/module/detail_category/index.php');
                }
            }
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Sửa Loại Sản Phẩm</h1>
                    
                    <div class="col-md-12">

                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Nhà cung cấp:</label>
                                <select class="form-control" name="supplier">
                                    <?php
                                        $selected = $supplierold;
                                        $query1="SELECT * FROM nhacungcap";
                                        $result = mysqli_query($connect,$query1);
                                        while($rows = mysqli_fetch_array($result))
                                        {
                                            echo $selected == $rows['maNCC'] ? "<option value='$rows[maNCC]' selected='selected'>".$rows['tenNCC']."</option>":"<option value='$rows[maNCC]'>".$rows['tenNCC']."</option>";                                        }
                                    ?>
                                </select>                              
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select class="form-control" name="maDM">
                                    <?php
                                        $selected = $categoryold;
                                        $query1="SELECT * FROM danhmuc";
                                        $result = mysqli_query($connect,$query1);
                                        while($rows = mysqli_fetch_array($result))
                                        {
                                            echo $selected == $rows['maDM'] ? "<option value='$rows[maDM]' selected='selected'>".$rows['tenDM']."</option>":"<option value='$rows[maDM]'>".$rows['tenDM']."</option>";                                        }
                                    ?>
                                </select>                             
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Mã loại</label>
                                <input type="text" readonly class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $idold?>" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên loại</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $nameold?>" >
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>