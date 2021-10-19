<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ADMIN Mega Market Nha Trang 2021</title>
    <link href="/thuctap2020/public/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/thuctap2020/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/thuctap2020/public/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<?php
    session_start();
    error_reporting(0);
    //session_destroy();
    if(isset($_POST['login']))
    {
        header('Location: /thuctap2020/admin/login.php');
        //header('Location: '.'login.php');
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
<body id="page-top">
    <!-- Page Wrapper -->
    <div  id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="sidebar-brand-text mx-3 " style="font-size: 45px; font-weight: 800i;">GOLD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/thuctap2020/admin/index.php">
                    <i class="fas fa-home"></i>
                    <span>Trang Chủ</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản Lí Kho hàng
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="<?php echo isset($open) && $open == 'import' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/module/import/add.php">
                <i class="fas fa-file-import"></i>
                    <span>Nhập Hàng</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản Lí Sản Phẩm
            </div>
             <!-- Nav Item - Charts -->
             <li class="<?php echo isset($open) && $open == 'supplier' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/module/supplier/index.php">
                    <i class="fas fa-parachute-box"></i>
                    <span>Nhà cung cấp</span>
                </a>
            </li>
             <li class="<?php echo isset($open) && $open == 'category' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/module/category/index.php">
                    <i class="fas fa-list-ul"></i>
                    <span>Danh Mục</span>
                </a>
            </li>

            <li class="<?php echo isset($open) && $open == 'detail_category' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/module/detail_category/index.php">
                    <i class="fas fa-list-ol"></i>
                    <span>Loại Sản Phẩm</span>
                </a>
            </li>

            <li class="<?php echo isset($open) && $open == 'product' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/module/product/index.php">
                    <i class="fab fa-product-hunt"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Quản Lí Tài Khoản ADMIN
            </div>
             <!-- Nav Item - Charts -->
             <li class="<?php echo isset($open) && $open == 'manager' ? 'active':'' ?> nav-item">
                <a class="nav-link" href="/thuctap2020/admin/create_account.php">
                    <i class="far fa-plus-square"></i>
                    <span>Tạo tài khoản </span>
                </a>
            </li>
            <!-- Divider -->
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand  bg-info topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <?php 
                        if(isset($_SESSION['login']) && $_SESSION['login'] == true)
                        {
                            ?>
                            <li>
                                    Xin chào <?php echo $_SESSION['name'] ?>
                            </li>
                        <?php
                        }
                        ?>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <form action="" method="post">
                                <?php 
                                    if(isset($_SESSION['login']) && $_SESSION['login'] == true)
                                    {
                                        ?>
                                        <li>
                                            <input type="submit" name="logout"  value="Đăng Xuất"  style="background: transparent; border: none; cursor: pointer;" >
                                        </li>
                                    <?php
                                    }
                                    else
                                        {?>
                                        <li>
                                            <input type="submit" name="login"  value="Đăng Nhập"  style="background: transparent; border: none; cursor: pointer;" >
                                        </li>
                                        <?php
                                    }
                                    ?>
                        </form>
                            
                    </ul>
                    </div>
                </nav>
                <!-- End of Topbar -->