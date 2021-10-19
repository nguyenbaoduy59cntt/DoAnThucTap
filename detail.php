<?php require("header.php"); 
error_reporting(0);
require("admin/autoload/autoload.php");?>

<?php
	$id = $_GET['id'];
    $query="SELECT * FROM sanpham WHERE sanpham.maSP = '$id'";
    //Truy vấn nè
    $item = mysqli_fetch_array(mysqli_query($connect,$query));
	$name = $item['tenSP'];
    $price = $item['donGiaSP'];
    $sale = $item['giamGia'];
    $avatar = $item['hinhAnh'];
    $description = $item['moTa'];
	$stock = $item['soLuong'];
	$unit = $item['donVi'];
    ?>

	
     <section class="hero-wrap hero-wrap-2" style="background-image: url('public/frontend/images/detail.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper px-md-4">
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<form method="post" action="./cart.php?action=add"  class="contactForm">
											<h3 class="mb-4 label" style="font-size: 20px;"> <?php echo $name; ?></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="label" for="name">Giá: <?php echo $price; ?> VNĐ</label>
														</div>
													</div>
													<div class="col-md-6"> 
														<div class="form-group">
															<label class="label" for="email">Giảm giá: <?php echo $sale; ?> %</label>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="label" for="subject">Mô tả:</label>
															<textarea readonly name="message" class="form-control" style="color: #b7472a;" id="message" cols="30" rows="4" placeholder="Message"><?php echo $description; ?></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="label" for="#">Số lượng trong kho: <?php echo $stock.' '. $unit; ?> </label>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group" style="display: flex;">
															<label style="width:50%" class="label" for="subject">Số lượng đặt hàng:</label>
															<input type="text" value="1" class="form-control" name="quantity[<?php echo $id?>]" id="subject" placeholder="Nhập số lượng vào đây">
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<input type="submit" value="Thêm Vào Giỏ Hàng" name="submit_add" class="btn btn-primary">
														</div>
													</div>
												</div>
										
									</div>
								</div>
									<div class="col-md-5 order-md-first d-flex align-items-stretch">
										<img style="width: 100%; height: 100%" src="public/uploads/product/<?php echo $avatar?>" alt="Ảnh bị lỗi rồi!">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php require("footer.php"); ?>