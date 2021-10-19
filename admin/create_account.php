<?php
    $open = "manager";
    error_reporting(0);
     require ("./autoload/autoload.php");
     
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['email']) && ($_POST['pass']) && !empty($_POST['passs']) && !empty($_POST['phone']) && !empty($_POST['address']) && (($_POST['pass']) == ($_POST['passs'])))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

                $query = "INSERT INTO `quantri`(`maQT`, `tenQT`, `emailQT`, `passwordQT`, `sdtQT`, `diaChiQT`) 
                            VALUES ('$id','$name','$email','$pass','$phone','$address')";
                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                    $_SESSION['success'] = 'Thêm mới tài khoản quản trị thành công';
                }
        }
        else
            $_SESSION['error'] = 'Thêm mới thất bại, vui lòng kiểm tra dữ liệu.';
     }
?>

<?php require ("./layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Mới Tài Khoản Quản Trị</h1>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']) ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']) ?>
                        </div>
                    <?php endif ?>
                    <div class="col-md-12">
                        <form action="" method="POST">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Mã quản trị:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên quản trị:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu::</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" name="pass">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nhập lại mật khẩu:</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" name="passs">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="address">
                            </div>
                           
                            <button type="submit" name="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("./layout/footer.php"); ?>