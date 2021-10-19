<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login_ADMIN_MM</title>

    <!-- Custom fonts for this template-->
    <link href="../public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<?php
    error_reporting(0);
    require ("./autoload/autoload.php");
    if(isset($_SESSION["login"]))
    {
        if($_SESSION["login"] == true) redirectUrl('/thuctap2020/admin/index.php');
    }
    if (isset($_POST["btn_submit"]))
    {
        // lấy thông tin người dùng
        $email = $_POST["email"];
        $password = $_POST["password"];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
        //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
      
        if ($email == "" || $password =="") 
        {
           
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ các trường!');</script>";
            
        }else{
            $sql = "SELECT * FROM `quantri` WHERE quantri.emailQT='$email'  and quantri.passwordQT='$password'";
            $query = mysqli_query($connect,$sql);
            $num_rows = mysqli_num_rows($query);
            echo $email;
            echo $password;
            if ($num_rows==0) {
                echo "<script type='text/javascript'>alert('Tên đăng nhập hoặc mật khẩu không đúng!');</script>.$email.$password";
            }else{
                // Lấy ra thông tin người dùng và lưu vào session
                while ( $data = mysqli_fetch_array($query) ) {
                    $_SESSION["email"] = $data["emailQT"];
                    $_SESSION['password'] = $data["passwordQT"];
                    $_SESSION['name'] = $data["tenQT"];
                    $_SESSION["login"] = true;
                    $_SESSION["maQT"] = $data["maQT"];

                }
                    // Thực thi hành động sau khi lưu thông tin vào session
                    // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                    redirectUrl('/thuctap2020/admin/index.php');
            }
        }
    }
?>

<body class="bg-gradient-primary">
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">GOLD</h1>
                                </div>
                                <form class="user" method="POST">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                            placeholder="Enter Email Address..." value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo ""; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary btn-user btn-block" type="submit" name="btn_submit" value="Đăng Nhập">
                                    <hr>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="../public/admin/vendor/jquery/jquery.min.js"></script>
<script src="../public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../public/admin/js/sb-admin-2.min.js"></script>

</body>


</html>