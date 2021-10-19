<?php
$open = "product";
error_reporting(0);
require("../../autoload/autoload.php");
if (isset($_POST['submit_save'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $error = array();
        if (!empty($_POST['name'])
            && !empty($_POST['price'])
            && !empty($_POST['sale'])
            && !empty(basename($_FILES['fileUpload']['name']))
            && !empty($_POST['unit'])
            && !empty($_POST['description'])
        )
        {
            $supplier = $_POST['supplier'];
            $detail_cate = $_POST['detail_cate'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $sale = $_POST['sale'];
            $description = $_POST['description'];
            $avatar = basename($_FILES['fileUpload']['name']);
            $unit = $_POST['unit'];
            $quantity = $_POST['quantity'];

            // echo $supplier." ". $detail_cate." ".$name." ".$price." ".$sale." ".$description." ". $avatar." ".$unit." ".$quantity;
           
            //Bước 1: Tạo foler upload file ảnh
            $target_dir = "../../../public/uploads/product/";
            //Tạo đường dẫn sau khi upload lên hệ thống
            $target_file = $target_dir . basename($_FILES['fileUpload']['name']);

            //Bước 2: Kiểm tra điều kiện upload
            //1. Kiểm tra kích thước file
            //2. Kiểm tra đuôi file
            //3. Kiểm tra sự tồn tại của file

            if ($_FILES['fileUpload']['size'] > 5242880) {
                $error['fileUpload'] = "Kích thước ảnh quá lớn";
            }

            $file_type = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);

            $file_type_allow = array('png', 'jpg', 'jpeg');
            if (!in_array(strtolower($file_type), $file_type_allow))
            {
                $error['fileUpload'] = "Chỉ cho phép upload file ảnh(jgg, png, jpeg)";
            }

            if (file_exists($target_file))
            {
                $error['fileUpload'] = "File đã tồn tại trên hệ thống";
            }

            // Bước 3: Kiểm tra và chuyển file từ bộ nhớ tạm lên server

            if (empty($error)) {
                if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file))
                    echo  'thành công';
                else
                    echo 'thất bại';
            }
            $query = "INSERT INTO `sanpham` (`maSP`, `tenSP`, `donGiaSP`, `giamGia`, `moTa`, `hinhAnh`, `donVi`, `soLuong`, `maNCC`, `ma_ctDM`) 
            VALUES (NULL, '$name', $price, '$sale', '$description', '$avatar', '$unit', $quantity, '$supplier', $detail_cate');";
            $result = mysqli_query($connect, $query);
            if ($result) 
            {
                $_SESSION['success'] = 'Thêm mới thành công';
                redirectUrl('/thuctap2020/admin/module/product/index.php');
            }
        } else 
        {
            $_SESSION['error'] = 'Thêm mới thất bại, vui lòng kiểm tra lại các trường';
        }
    }
}

?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Thêm Sản Phẩm</h1>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']) ?>
    </div>
<?php endif ?>

<div class="col-md-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Nhà cung cấp</label>
            <?php
                if (isset($_POST['supplier_submit'])) 
                {
                    if(!empty($_POST['supplier']))
                    {
                        $maNCC = $_POST['supplier'];
                    }
                    else
                    {
                        $_SESSION['error'] = 'Vui lòng chọn nhà cung cấp!';
                    }
                }
            ?>
            <div style="display: flex;">
                <select class="form-control" onchange="setNCC()" id="supplier" name="supplier" style=" margin-right: 20px;">
                    <?php
                    $query1 = "SELECT * FROM nhacungcap";
                    $result = mysqli_query($connect, $query1);
                    echo "<option disabled selected='selected'>Chọn nhà cung cấp</option>";
                    while ($rows = mysqli_fetch_array($result)) 
                    {
                        //echo $selected == $rows['maNCC'] ? "<option value='$rows[maNCC]' selected='selected'>" . $rows['tenNCC'] . "</option>" : "<option value='$rows[maNCC]'>" . $rows['tenNCC'] . "</option>";
                        echo "<option  value=$rows[maNCC]" . ($rows['maNCC'] == $maNCC ? " selected='selected'" : "") . ">$rows[tenNCC]</option>";
                    }
                    ?>
                </select>
                <input type="submit" class="btn btn-warning" name="supplier_submit" value="Xác nhận">
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Loại sản phẩm</label>
            <select class="form-control" name="detail_cate">
                <?php
                $query1 = "SELECT * FROM ct_danhmuc WHERE ct_danhmuc.maNCC = '$maNCC'";
                $result = mysqli_query($connect, $query1);
                if (empty($maNCC))     echo "<option disabled selected='selected'>Vui lòng chọn nhà cung cấp</option>";
                else echo "<option disabled selected='selected'>Chọn loại sản phẩm</option>";
                while ($rows = mysqli_fetch_array($result)) {
                    echo "<option value=$rows[ma_ctDM]>$rows[ten_ctDM]</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group ">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php
                                                                                                if (isset($_POST['name'])) {
                                                                                                    echo $_POST['name'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                }
                                                                                                ?>">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1">Giá:</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="price" value="<?php
                                                                                                    if (isset($_POST['price'])) {
                                                                                                        echo $_POST['price'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }
                                                                                                    ?>">
        </div>
        <div class="form-group">
                                                                            
            <label for="exampleInputEmail1">Giảm giá(%):</label>
            <input type="number" class="form-control" placeholder="Nếu không có giảm giá thì để trống!" id="exampleInputEmail1" name="sale" value="<?php
                                                                                                    if (isset($_POST['sale'])) {
                                                                                                        echo $_POST['sale'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }
                                                                                                    ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" id="" cols="10" rows="5">
            <?php
            if (isset($_POST['description'])) {
                echo $_POST['description'];
            } else {
                echo "";
            }
            ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ảnh</label>
            <input class="form-control-file" type="file" class="form-control" name="fileUpload" id="fileUpload">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Đơn vị</label>
            <select class="form-control" name="unit">
                <option disabled selected="selected">Chọn đơn vị tính</option>
                <option value="Kg">Kg</option>
                <option value="Thùng">Thùng</option>
                <option value="Hộp">Hộp</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <input class="form-control" name="quantity" id="" value="<?php
                                                                        if (isset($_POST['quantity'])) {
                                                                            echo $_POST['quantity'];
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        ?>">
            </input>
        </div>

        <button type="submit" class="btn btn-success" name="submit_save">Lưu</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>