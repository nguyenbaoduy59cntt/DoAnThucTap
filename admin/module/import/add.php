<?php
$open = "import";
error_reporting(0);
require("../../autoload/autoload.php");


function layDonGia($arr, $connect){
    $arrDonGia = [];

    // echo count($arr);
    for($i = 0; $i < count($arr); $i++){
        $id = $arr[$i];

        $query = "SELECT `donGiaSP`FROM `sanpham` WHERE sanpham.maSP = $id";
        $result = mysqli_query($connect, $query);
        $arrDonGia[] = mysqli_fetch_array($result)['donGiaSP'];
        
    }
    return $arrDonGia;
}
    $arrId = [];
    $arrName = [];
    $arrCTDM =[];
    
    if(!empty($_POST['supplier']))
    {
        $maNCC = $_POST['supplier'];
    }

    if(isset($_POST['supplier_submit']) && empty($_POST['supplier']))
    {
        $_SESSION['error'] = 'Vui lòng chọn nhà cung cấp!';
    }
    
    if(isset($_POST['soLuong_submit']))
    {
        $sl = $_POST['soLuong'];
        $arrId = range(0,$sl);
        $arrName = range(0,$sl);
    }


    //giữ lại dữ liệu
    {
        $sl = $_POST['soLuong'];
        for($i = 0; $i< $sl; $i++)
        {
            $arrId[$i] = empty($_POST["id$i"]) ? "" : $_POST["id$i"];
            $arrName[$i] = empty($_POST["getName$i"]) ? "" : $_POST["getName$i"];
            $arrQty[$i] = empty($_POST["price$i"]) ? "" :$_POST["price$i"];

            if(isset($_POST["getId$i"]))
            {
                $newId = $arrId[$i];
                $lsp = $_POST['detail_cate'];
                $query = "SELECT `tenSP` FROM `sanpham` WHERE sanpham.maNCC = '$maNCC' AND sanpham.ma_ctDM= '$lsp' AND `maSP` = $newId";
                $result = mysqli_query($connect, $query);
                $rows = mysqli_fetch_array($result);
                if(in_array($rows['tenSP'], $arrName)){
                    $arrName[$i] = "Đã nhập mã này rồi";
                }else{
                    $arrName[$i] = $rows['tenSP'];
                    if (empty($arrName[$i])) $arrName[$i] = "Mã không tồn tại";
                }
                // var_dump($arrCTDM);
            }
        }
    }
    if(isset($_POST['addRow']))
    {
        $sl++;
    }
    if(isset($_POST['subRow']))
    {
        $sl--;
    }
    if(isset($_POST['supplier_submit'])){
        $sl = 0;
    }

    function ktNhap($arr, $sl){
        for($i = 0; $i < $sl; $i++){
            if(empty($arr[$i]) || $arr[$i] == 'Mã không tồn tại' || $arr[$i] == 'Đã nhập mã này rồi') return false;
        }
        return true;
    }
    if (isset($_POST['submit_save'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $error = array();
            if ($sl == 0)
            {
                $_SESSION['error'] = 'Đơn hàng chưa có sản phẩm nào!';
            }
            elseif(!ktNhap($arrId, $sl) || !ktNhap($arrName, $sl) || !ktNhap($arrQty, $sl)){
                $_SESSION['error'] = 'Chưa nhập đủ trường';
            }
            else{
                //lấy đơn giá
                $arrDonGia = layDonGia($arrId, $connect);
                $maQT = $_SESSION['maQT'];
                $supplier = $_POST['supplier'];
                $detail_cate = $_POST['detail_cate'];
                
                $queryNhapDonHang = "INSERT INTO `donhangnhap`(`maQT`, `MaNCC`, `MaCTDM`) VALUES ('$maQT','$supplier','$detail_cate')";
                $result = mysqli_query($connect, $queryNhapDonHang);
                
                if(!$result){
                    $_SESSION['error'] = 'Nhập thất bại';    
                }
                else{
                    
                    // var_dump($arrDonGia);
                    if(($_SESSION["login"]) == true)
                    {
                        $maDHN =  mysqli_insert_id($connect);

                        for($i = 0; $i < $sl; $i++){
                            $queryChiTiet = "INSERT INTO `chitiet_donhangnhap`(`maDHN`, maSP, `soLuong`, `donGiaNhap`) VALUES ($maDHN, '$arrId[$i]', $arrQty[$i], $arrDonGia[$i])";
                            $result = mysqli_query($connect, $queryChiTiet);

                            $queryUpdate = "UPDATE `sanpham` SET `soLuong` = sanpham.soLuong + $arrQty[$i] WHERE sanpham.MaSP = '$arrId[$i]'";
                            $result = mysqli_query($connect, $queryUpdate);
                            // chỗ này k kiểm tra thất bại hay không, nhưng 99% là được
                            }
                            $_SESSION['success'] = 'Nhập thành công';
                    }
                    else
                    {
                        $_SESSION['error'] = 'Nhập thất bại! Bạn vui lòng đăng nhập';    
                    }
                } 

            } 
        }
    }
    // echo $sl;
?>
    <?php require("../../layout/header.php"); ?>
    <!-- Begin Page Content -->
    <h1 align="center">Đơn Hàng Nhập</h1>
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
            <div style="display: flex;">
                <?php
                    
                ?>
                <div style="display: flex;" class="col-md-4">
                    <select class="form-control" id="supplier" name="supplier" >
                        <?php
                        $selected = $_POST['supplier'];
                        $query1 = "SELECT * FROM nhacungcap";
                        $result = mysqli_query($connect, $query1);
                        echo "<option disabled selected='selected'>Chọn nhà cung cấp</option>";
                        while ($rows = mysqli_fetch_array($result)) 
                        {
                            echo $selected == $rows['maNCC'] 
                            ? "<option value='$rows[maNCC]' selected='selected'>" . $rows['tenNCC'] . "</option>" 
                            : "<option value='$rows[maNCC]'>" . $rows['tenNCC'] . "</option>";
                        }
                        ?>
                    </select>
                    <input  type="submit" style="padding: 2px 2px;" class="btn btn-warning" name="supplier_submit" value="Xác nhận">
                </div>

                <select class="form-control col-md-3" name="detail_cate">
                    <?php
                    $selected = $_POST['detail_cate'];
                    $query1 = "SELECT * FROM ct_danhmuc WHERE ct_danhmuc.maNCC = '$maNCC'";
                    $result = mysqli_query($connect, $query1);
                    if (empty($maNCC))  echo "<option disabled selected='selected'>Vui lòng chọn nhà cung cấp</option>";
                    else echo "<option disabled selected='selected'>Chọn loại sản phẩm</option>";
                    while ($rows = mysqli_fetch_array($result))
                    {
                        echo $selected == $rows['ma_ctDM'] 
                        ? "<option value='$rows[ma_ctDM]' selected='selected'>" . $rows['ten_ctDM'] . "</option>" 
                        : "<option value='$rows[ma_ctDM]'>" . $rows['ten_ctDM'] . "</option>";
                    }
                    ?>
                </select>

                <div class="form-group col-md-5 " style="display: flex">
                    <input type="number" placeholder="Số lượng hàng" class="form-control" value="<?php echo empty($sl) ? "" : $sl?>" name="soLuong">
                    <input  style="margin-left:5px;" type="submit" style="padding: 2px 2px;" class="btn btn-warning" name="soLuong_submit" value="Xác nhận">
                    <button style="margin-left:5px;" type="submit" class="btn btn-success" name="addRow">+</button>
                    <button  style="margin-left:5px;" type="submit" class="btn btn-success" name="subRow">-</button>
                </div>
        </div>
    </div>
    <div>
        <table class="table" >
            <thead class="thead-dark">
                <tr>
                    <th width="25%" colspan="2" scope="col">Mã</th>
                    <th width="55%" scope="col">Tên</th>
                    <th width="20%" scope="col">Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                       if($sl > 0)
                       {
                           $i = 0;
                             while($i < $sl)
                             {?>
                                 <tr>
                                    <td scope="row"><input name="id<?php echo $i ?>" type="text" value=<?php echo $arrId[$i]?>></td>
                                    <td><button type="submit" class="btn btn-success" name="getId<?php echo $i?>"><i class="fas fa-check"></i></button></td>
                                    <td><input class="bg-dark" size="80" readonly type="text" name="getName<?php echo $i?>" value="<?php echo $arrName[$i]?>"></td>
                                    <td><input type="text" name="price<?php echo $i?>" value="<?php echo $arrQty[$i]?>"></td>
                                </tr>
                             <?php
                             $i++;
                           }
                       }
                ?>
                
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-success" name="submit_save">Nhập Ngay</button>
    

    
    </form>
</div>
<?php require("../../layout/footer.php"); ?>