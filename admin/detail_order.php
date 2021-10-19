<?php require("layout/header.php");
error_reporting(0);
require("autoload/autoload.php");
$id= $_GET['id'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Begin Page Content -->
    <h1 align="center">Chi Tiết Đơn Hàng</h1>

    <?php
    $sql = "SELECT * FROM `ct_dondathang` WHERE maDDH=$id";
    $query = mysqli_query($connect, $sql);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th width="5%">STT</th>
                        <th width="12%">Mã sản phẩm</th>
                        <th width="15%">Số lượng</th>
                        <th width="20%">Đơn giá</th>
                        <th width="20%">Tổng tiền</th>
                        <th width="20%">Tổng tiền sau khi giảm</th>
                    </thead>
                    <tbody>
                        <form method="GET">
                        <?php
                        $stt = $rowPerpage * ($pages - 1) + 1;
                        // echo "submit_id_$rows[id]";

                        while ($rows = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $rows['maSP'] ?></td>
                                <td><?php echo $rows['soLuong'] ?></td>
                                <td><?php echo $rows['giaSP'] ?></td>
                                <td><?php echo $rows['giaSP'] * $rows['soLuong'] ?></td>
                                <td><?php echo $rows['soLuong'] * ($rows['giaSP'] - ($rows['giaSP']*(($rows['giamGia'])/100))) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </form>
                    </tbody>
                </table>
                    <a class="btn btn-info" href="index.php"> <i class="fas fa-backward"></i>&nbsp;Trở về</a>
                            
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
    <?php require("layout/footer.php"); ?>