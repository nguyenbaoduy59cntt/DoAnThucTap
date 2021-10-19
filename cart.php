<?php
	require("header.php"); 
	error_reporting(0);
	require("admin/autoload/autoload.php");
?>

<?php
	if(!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
	}

	if(isset($_GET['action']))
	{
		function update($add = false)
		{
			foreach($_POST['quantity'] as $id => $soLuong)
				{
					if($soLuong == 0)
					{
						unset($_SESSION['cart'][$id]);
					}
					else
					{
						if($add)
							$_SESSION['cart'][$id] += $soLuong;
						else
							$_SESSION['cart'][$id] = $soLuong;
					}
				}
		}
		
		switch($_GET['action'])
		{
			case "add":
				update(true);
				break;
				
			case "delete":
				if(isset($_GET['id']))
				{
					unset($_SESSION['cart'][$_GET['id']]);
					break;
				}
			case "submit":
				if(isset($_POST['update_click']))
				{
					update();
				}elseif(isset($_POST['order_click']))
				{
					if(empty($_POST['name']))
					{
						$_SESSION['error'] = "Bạn chưa nhập tên người nhận!";
					}elseif(empty($_POST['phone']))
					{
						$_SESSION['error'] = "Bạn chưa nhập số điện thoại người nhận!";
					}elseif(empty($_POST['note']))
					{
						$_SESSION['error'] = "Bạn chưa nhập địa chỉ người nhận!";
					}elseif($_POST['quantity'] == null)
					{
						$_SESSION['error'] = "Giỏ hàng rỗng!";
					}
					
					if($_SESSION['error'] == null && $_POST['quantity'] != null)
					{
						
						$_SESSION['success'] = "Đặt hàng thành công. Bạn vui lòng chờ quản trị viên phê duyệt đơn hàng!";
						$result = mysqli_query($connect,"SELECT *  FROM `sanpham` WHERE `maSP` IN (".implode(",",array_keys($_POST['quantity'])).")");
						$total = 0;
						$orderProduct = array();
						while($row = mysqli_fetch_array($result))
						{
							$orderProduct[] = $row; //tạo mảng chứa sản phẩm để thêm vào chi tiết đơn đặt hàng
							$total += ($row['donGiaSP'] - ($row['donGiaSP'] * $row['giamGia'])/100)  * $_POST['quantity'][$row['maSP']];
						}

						date_default_timezone_set('Asia/Ho_Chi_Minh');
						date ($format, $timestamp = 'time()');
						$date =  date('Y-m-d H:i:s');
						
						$name_ins = $_POST['name'];
						$phone_ins = $_POST['phone'];
						$add_ins = $_POST['note'];

						$insertOrder = mysqli_query($connect,"INSERT INTO `dondathang`(`ngayDatHang`,`tenKH`, `SDT`, `diachiKH`, `tongTien`) 
																VALUES ('$date','$name_ins','$phone_ins','$add_ins',$total)");

						$order_ID = $connect->insert_id;
						$insertStr = "";
						$num = 0;
						
						foreach($orderProduct as $key => $result)
						{

							$insertStr .=  "('".$order_ID."', '".$result['maSP']."', '".$_POST['quantity'][$result['maSP']]."', '".($result['donGiaSP'] - ($result['donGiaSP'] * $result['giamGia'])/100)."','".$result['giamGia']."')";
							if($key != count($orderProduct) - 1)
							{
								$insertStr .= ",";
							}
						}
						$insert_detailOrder = mysqli_query($connect,"INSERT INTO `ct_dondathang` (`maDDH`, `maSP`, `soLuong`, `giaSP`,`giamGia`)
						VALUES ".$insertStr." ");
					}
				}
				break;
		}
	}

	if(!empty($_SESSION["cart"]))
	{	
		$result = mysqli_query($connect,"SELECT *  FROM `sanpham` WHERE `maSP` IN (".implode(",",array_keys($_SESSION["cart"])).")");
	}
?>

 <section class="hero-wrap hero-wrap-2" style="background-image: url('public/frontend/images/cart.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          </div>
        </div>
      </div>
    </section>
<section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="table">
					<form action="./cart.php?action=submit" method="post">
							<table class="table">
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
								<thead class="thead-primary">
									<tr>
										<th width=5%>STT</th>
										<th width=38%>Sản phẩm</th>
										<th width=10%>Ảnh</th>
										<th width=10%>Giá(VNĐ)</th>
										<th width=15%>Số lượng</th>
										<th width=21%>Tổng tiền(VNĐ)</th>
										<th width=2%>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$total = 0;
									$stt = 1;
									while($row = mysqli_fetch_array($result)) { ?>
									<tr class="alert" role="alert">
										<td>
											<?=$stt; ?>
										</td>
										<td>
											<div class="email">
												<span><?=$row['tenSP']?></span>
											</div>
										</td>
										<td>
											<div class="img" style="background-image: url(public/uploads/product/<?=$row['hinhAnh']?>);"></div>
										</td>
										<td><?= number_format($row['donGiaSP'], 0, ",",".") ?></td>
										<td class="quantity">
											<div class="input-group">
												<input type="text" name="quantity[<?=$row['maSP']?>]" class="quantity form-control input-number" value="<?=$_SESSION["cart"][$row['maSP']]?>">
											</div>
										</td>
										<td><?= number_format((($row['donGiaSP'] - ($row['donGiaSP'] * $row['giamGia']/100))  * $_SESSION["cart"][$row['maSP']]), 0, ",",".") ?></td>
										<td>
											<button type="button" class="close">
												<span aria-hidden="true"><a href="./cart.php?action=delete&id=<?=$row['maSP']?>" class="fa fa-close"></a></span>
											</button>
										</td>
									</tr>
									<?php
									$total += ($row['donGiaSP'] - ($row['donGiaSP'] * $row['giamGia']/100))  * $_SESSION["cart"][$row['maSP']];
									 $stt++; }?>
									<tr>
										
										<td colspan="4" style="text-align: center; color: red; font-size: 25px;" >Tổng tiền:</td>
										<td colspan="3" style="text-align: center; color: red; font-size: 25px;"><?= number_format($total, 0, ",",".") ?> VNĐ</td>
									</tr>
									<div class="form-group">
										<input type="submit" name="update_click" value="Cập nhật" class="btn btn-primary">
									</div>
								</tbody>
								
							</table>
							<h3 class="mb-4">Thông Tin Đặt Hàng</h3>
								<div class="row col-md-7">
									<div class="col-md-12">
										<div class="form-group">
											<label class="label" for="name">Họ tên:</label>
											<input type="text" class="form-control" name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} else echo ''; ?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="label" for="subject">Số điện thoại:</label>
											<input type="text" class="form-control" name="phone" id="subject" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} else echo ''; ?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="label" for="#">Địa chỉ</label>
											<textarea name="note" class="form-control" id="note" cols="30" rows="4"><?php if(isset($_POST['note'])){echo $_POST['note'];} else echo ''; ?></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="submit" name="order_click" value="Đặt Hàng" class="btn btn-primary">
											<div class="submitting"></div>
										</div>
									</div>
								</div>
					</form>
				</div>
    		</div>
    	</div>
    </section>
    <?php require("footer.php"); ?>