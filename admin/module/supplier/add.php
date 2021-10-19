
<?php
    $open = "supplier";
    error_reporting(0);
     require ("../../autoload/autoload.php");
     
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!empty($_POST['id']) 
        && !empty($_POST['name']) 
        && !empty($_POST['phone']) 
        && !empty($_POST['address']) 
        && !empty($_POST['email']) 
        && !empty($_POST['fax'])
        && !empty($_POST['zip_code']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $fax = $_POST['fax'];
            $zip_code = $_POST['zip_code'];
        
            $query ="INSERT INTO `nhacungcap`(`maNCC`, `tenNCC`, `sdtNCC`, `diaChiNCC`, `emailNCC`, `fax`, `maBuuDien`) 
                    VALUES ('$id','$name','$phone','$address','$email','$fax','$zip_code')";
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                $_SESSION['success'] = 'Thêm mới thành công';
                redirectUrl('/thuctap2020/admin/module/supplier/index.php');
            }
        }
        else
            $_SESSION['error'] = 'Thêm mới thất bại, vui lòng kiểm tra lại các trường';
     }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Nhà Cung Cấp</h1>
                    
                    <?php if(isset($_SESSION['error'])):?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                            </div>
                    <?php endif ?>

                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fax:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="fax">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã bưu điện:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="zip_code">
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>