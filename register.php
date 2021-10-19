<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Account - HNTTcomputer</title>

    <!-- Custom fonts for this template-->
    <link href="public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<?php
    require ("admin/autoload/autoload.php");
    if (isset($_POST["btn_submit"])) {
        $timezone = date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d h:i:s a', time());
		//lấy thông tin từ các form bằng phương thức POST
        
		//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["address"]) || empty($_POST["password"]) || empty($_POST["repeatpassword"])) 
        {
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
        }else
        {
            if($_POST["password"] == $_POST["repeatpassword"])
            {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $address = $_POST["address"];
                $password = $_POST["password"];
                $repeatpassword = $_POST["repeatpassword"];

                $sql = "INSERT INTO `khachhang`(`maKH`, `tenKH`, `sdtKH`, `emailKH`, `passwordKH`, `diaChi`) VALUES ( '$name','$name', '$phone','$email', '$password','$address')";
                // thực thi câu $sql với biến conn lấy từ file connection.php
                $result = mysqli_query($connect,$sql);
                if($result == true)
                    echo "<script type='text/javascript'>alert('Chúc mừng bạn đã đăng kí thành công!');</script>";
                else
                    echo "lỗi";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Mật khẩu chưa trùng khớp!');</script>";
            }
		}   
	}
?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Name" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo ""; ?>">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Phone" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; else echo ""; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Address" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; else echo ""; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo ""; ?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="repeatpassword">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="btn_submit" value="Register">
                                
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/admin/vendor/jquery/jquery.min.js"></script>
    <script src="public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/admin/js/sb-admin-2.min.js"></script>

</body>

</html>