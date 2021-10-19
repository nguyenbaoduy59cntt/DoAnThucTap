<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Mega Market Nha Trang 2021</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/frontend/css/animate.css">
    <link rel="stylesheet" href="public/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="public/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="public/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="public/frontend/css/flaticon.css">
    <link rel="stylesheet" href="public/frontend/css/style.css">
  </head>
  <?php
    session_start();
    error_reporting(0);
    //session_destroy(); 
    if(isset($_POST['login']))
    {
        header('Location: '.'login.php');
        //redirectUrl('login.php');
    }
    if(isset($_POST['logout']))
    {
        unset($_SESSION['login']);
          // session_unset($_SESSION["login"]);
          if(isset($_SESSION['login']))
          {
              $_SESSION['login'] = false;
              //session_unset($_SESSION["login"]);
          }
          if(isset($_SESSION['email']))
          unset($_SESSION['email']);
          if(isset($_SESSION['password']))
          unset($_SESSION['password']);
          
    }
?>
  <body>
  	<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +0906250613</a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> m.m.nhatrang@gmail.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end align-items-center">
						<div class="social-media mr-4">
							<p class="mb-0 d-flex">
								<a href="#"  class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
							</p>
						</div>
						<div class="align-items-center">
							<form action="" method="post">
								<div class="reg">
									<?php
										if(isset($_SESSION['login']) && $_SESSION['login'] == true)
										{
											?>
											<a>
											<?php
													echo "MM chào ". $_SESSION["name"];
													?>
											</a>
											<a>
												<input type="submit" class="mr-2" name="logout"  value="ĐĂNG XUẤT"  style="background: transparent; border: none; cursor: pointer;" >
											</a>
										<?php
										}
										else
											{?>
											<a>
												<input  type="submit" class="mr-2"  name="login"  value="ĐĂNG NHẬP" style="background: transparent; border: none; cursor: pointer;">
											</a>
											<?php
											}
									?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">MM <span>MEGA MARKET</span></a>
	      <div class="order-lg-last btn-group">
			<a href="cart.php" class="btn-cart">
				<span class="flaticon-shopping-bag"></span>
				<div class="d-flex justify-content-center align-items-center"><small><?=count(array_keys($_SESSION["cart"]))?></small></div>
			</a>
        </div>

	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul   class="navbar-nav ml-auto">
	          <li   class="nav-item <?php echo isset($open) && $open == 'home' ? 'active' :'' ?>"><a  href="index.php" class="nav-link">Trang Chủ</a></li>
	          <li class="nav-item <?php echo isset($open) && $open == 'choose' ? 'active':'' ?>"><a href="choose_central.php" class="nav-link">Chọn Trung Tâm</a></li>
	          <li  class="nav-item <?php echo isset($open) && $open == 'about' ? 'active':'' ?>"><a  href="about.php" class="nav-link">Giới Thiệu</a></li>
	          <li  class="nav-item <?php echo isset($open) && $open == 'contact' ? 'active':'' ?>"><a  href="contact.php" class="nav-link">Liên Hệ</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->