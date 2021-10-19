<?php
$open = "product";
error_reporting(0);
require("../../autoload/autoload.php");

$id = $_GET['id'];
$query = "SELECT * FROM `sanpham` WHERE maSP = '$id'";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {
    $id_old = $row['maSP'];
    $name_old = $row['tenSP'];
    $price_old = $row['donGiaSP'];
    $sale_old = $row['giamGia'];
    $description_old = $row['moTa'];
    $avatar_old = $row['hinhAnh'];
    $unit_old = $row['donVi'];
    $quantity_old = $row['soLuong'];
    $supplier_old = $row['maNCC'];
    $detail_cate_old = $row['ma_ctDM'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        isset($_POST['id'])
        && isset($_POST['name'])
        && isset($_POST['price'])
        && isset($_POST['sale'])
        && isset($_POST['description'])
        && isset($_POST['unit'])
        && isset($_POST['quantity'])
        && isset($_POST['supplier'])
        && isset($_POST['detail_cate'])
    ) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $description = $_POST['description'];
        $unit = $_POST['unit'];
        $quantity = $_POST['quantity'];
        $supplier = $_POST['supplier'];
        $detail_cate = $_POST['detail_cate'];

        $query = "UPDATE `sanpham` SET `maSP`='$id',`tenSP`='$name',`donGiaSP`= $price,`giamGia`= $sale,`moTa`='$description',`hinhAnh`='$avatar_old',`donVi`='$unit',`soLuong`= $quantity,`maNCC`='$supplier',`ma_ctDM`= '$detail_cate' WHERE sanpham.maSP='$id'";
        $result = mysqli_query($connect, $query);

        $_SESSION['success'] = 'Cập nhật thành công';
        redirectUrl('/thuctap2020/admin/module/product/index.php');
    } else
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Chỉnh Sửa Sản Phẩm</h1>
<div class="col-md-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã sản phẩm</label>
            <input readonly type="text" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $id_old ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $name_old ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giá</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="price" value="<?php echo $price_old ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giảm giá(%):</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="sale" value="<?php echo $sale_old ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" id="" cols="10" rows="5"><?php echo $description_old ?>
                                </textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Đơn vị</label>
            <select class="form-control" name="unit">
                <?php
                $selected = $unit_old;
                ?>
                <option value="Kg" <?php if ($selected == 'Kg') {
                                        echo 'selected="selected"';
                                    } ?>>Kg</option>
                <option value="Thùng" <?php if ($selected == 'Thùng') {
                                            echo 'selected="selected"';
                                        } ?>>Thùng</option>
                <option value="Hộp" <?php if ($selected == 'Hộp') {
                                        echo 'selected="selected"';
                                    } ?>>Hộp</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <input class="form-control" name="quantity" id="" value="<?php echo $quantity_old ?>">
            </input>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nhà cung cấp</label>
            <select class="form-control" name="supplier">
                <?php
                $selected = $supplier_old;
                $query1 = "SELECT * FROM nhacungcap";
                $result = mysqli_query($connect, $query1);
                while ($rows = mysqli_fetch_array($result)) {
                    echo $selected == $rows['maNCC'] ? "<option value='$rows[maNCC]' selected='selected'>" . $rows['tenNCC'] . "</option>" : "<option value='$rows[maNCC]'>" . $rows['tenNCC'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Loại sản phẩm</label>
            <select class="form-control" name="detail_cate">
                <?php
                $selected = $detail_cate_old;
                $query1 = "SELECT * FROM ct_danhmuc";
                $result = mysqli_query($connect, $query1);
                while ($rows = mysqli_fetch_array($result)) {
                    echo $selected == $rows['ma_ctDM'] ? "<option value='$rows[ma_ctDM]' selected='selected'>" . $rows['ten_ctDM'] . "</option>" : "<option value='$rows[ma_ctDM]'>" . $rows['ten_ctDM'] . "</option>";
                    //echo "<option value=$rows[ma_ctDM]>$rows[ten_ctDM]</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>