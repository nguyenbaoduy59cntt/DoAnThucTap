<?php
    $open = "supplier";
     require ("../../autoload/autoload.php");
     error_reporting(0);
     $id= $_GET['id'];
     $query = "SELECT * FROM `nhacungcap` WHERE maNCC = '$id' ";
     $result = mysqli_query($connect, $query);

     while($row = mysqli_fetch_array($result))
     {
        $id_old=$row['maNCC'];
        $name_old=$row['tenNCC'];
        $phone_old=$row['sdtNCC'];
        $addres_old=$row['diaChiNCC'];
        $email_old=$row['emailNCC'];
        $fax_old=$row['fax'];
        $zipcode_old=$row['maBuuDien'];

     }
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

            $query ="UPDATE `nhacungcap` SET `maNCC`='$id',
                                            `tenNCC`='$name',
                                            `sdtNCC`='$phone',
                                            `diaChiNCC`='$address',
                                            `emailNCC`='$email',
                                            `fax`='$fax',
                                            `maBuuDien`='$zip_code' WHERE maNCC='$id'";
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                if($name == $name_old 
                    && $id == $id_old
                    && $phone == $phone_old 
                    && $address == $addres_old
                    && $email == $email_old 
                    && $fax == $fax_old
                    && $zip_code == $zipcode_old)
                {
                    $_SESSION['success'] = 'Kh??ng c?? g?? thay ?????i';
                    redirectUrl('/thuctap2020/admin/module/supplier/index.php');
                }
                else
                {
                    $_SESSION['success'] = 'C???p nh???t th??nh c??ng';
                    redirectUrl('/thuctap2020/admin/module/supplier/index.php');
                }
            }
        }
        else
            $_SESSION['error'] = 'Th??m m???i th???t b???i, vui l??ng ki???m tra l???i c??c tr?????ng';
    }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">C???p Nh???t Nh?? Cung C???p</h1>

                    <?php if(isset($_SESSION['error'])):?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                            </div>
                    <?php endif ?>

                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">M??:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $id_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">T??n:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $name_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">S??? ??i???n tho???i:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="<?php echo $phone_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">?????a ch???:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="address" value="<?php echo $addres_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $email_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fax:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="fax" value="<?php echo $fax_old?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">M?? b??u ??i???n:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="zip_code" value="<?php echo $zipcode_old?>">
                            </div>
                            <button type="submit" class="btn btn-success">L??u</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>