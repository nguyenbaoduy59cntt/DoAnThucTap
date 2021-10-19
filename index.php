<?php
$open = "home"; 
require("header.php"); 
error_reporting(0);
?>
    <div class="hero-wrap" style="background-image: url('public/frontend/images/about.jpg');" data-stellar-background-ratio="0.5">
    </div>

    <section class="ftco-intro">
    	<div class="container">
    		<div class="row no-gutters " >
    			<div class="col-md-3 d-flex bg-danger">
    				<div class="intro d-lg-flex w-100 ftco-animate" >
    					<div class="icon">
    						<span style="font-size: 70px;">D</span>
    					</div>
    					<div class="text" >
    						<h2>DRIVE CHANGE</h2>
    						<p>Dám Thay Đổi.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex">
    				<div class="intro color-1 d-lg-flex w-100 ftco-animate">
    					<div class="icon">
    						<span>S</span>
    					</div>
    					<div class="text">
    						<h2>Strive for Excellence</h2>
    						<p>Vươn Tới Sự Ưu Việt.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex">
    				<div class="intro color-1 d-lg-flex w-100 ftco-animate">
    					<div class="icon">
							<span>C</span>
    					</div>
    					<div class="text">
    						<h2>Customer Hear</h2>
    						<p>Đặt Khách Hàng Trong Tim</p>
    					</div>
    				</div>
				</div>
				<div class="col-md-3 d-flex">
    				<div class="intro d-lg-flex w-100 ftco-animate">
    					<div class="icon">
							<span>H</span>
    					</div>
    					<div class="text">
    						<h2>Happy Workplay</h2>
    						<p>Nơi Làm Việc Vui Vẻ.</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

		<section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 ">
						<div  class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(public/frontend/images/mua2tang1.jpg);"></div>
							<a class="js-scroll-trigger" href="#khuyenmai">Sản Phẩm Khuyến Mãi</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 ">
						<div  class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(public/frontend/images/giasoc.jpg);"></div>
							<a class="js-scroll-trigger" href="#giatot">Giá Siêu Tốt</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 ">
						<div  class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(public/frontend/images/hangtuoi.jpg);"></div>
							<a class="js-scroll-trigger" href="#hangtuoi">Hàng Tươi Giá Tốt Mỗi Ngày</a>
						</div>
					</div>
					
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
					<div class="col-md-7 heading-section text-center ftco-animate" id="khuyenmai">
						<h2>Sản Phẩm Khuyến Mãi</h2>
					</div>
				</div>
				<div class="row">
				<?php
					require("admin/autoload/autoload.php");
					$query = "SELECT * FROM `sanpham` ORDER BY giamGia DESC LIMIT 4";
					//Truy vấn nè
					$result = mysqli_query($connect, $query);
					$numrow = mysqli_num_rows($result);
					if ($numrow <> 0) 
					{
						while ($rows = mysqli_fetch_array($result)) 
						{ ?>
							<div class="col-md-3 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(public/uploads/product/<?php echo $rows['hinhAnh']?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
												<a href="addtocart.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>
												<a href="detail.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>

									<div class="text text-center">
										<span class="sale">Sản phẩm khuyến  mãi</span>
										<span class="category">Brandy</span>
										<h2><?php echo $rows['tenSP']; ?></h2>
										<p class="mb-0"><span class="price"><?php echo $rows['donGiaSP'].' VNĐ'; ?></span></p>
									</div>
								</div>
							</div>
						<?php
						}
					}
				?>
				
				</div>
			</div>
		</section>
		
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
					<div class="col-md-7 heading-section text-center ftco-animate" id="giatot">
						<h2>Giá Siêu Tốt</h2>
					</div>
				</div>
				<div class="row">
				<?php
					require("admin/autoload/autoload.php");
					$query = "SELECT * FROM `sanpham` ORDER BY (donGiaSP - (donGiaSP *  giamGia/100)) DESC LIMIT 4";
					//Truy vấn nè
					$result = mysqli_query($connect, $query);
					$numrow = mysqli_num_rows($result);
					if ($numrow <> 0) 
					{
						while ($rows = mysqli_fetch_array($result)) 
						{ ?>
							<div class="col-md-3 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(public/uploads/product/<?php echo $rows['hinhAnh']?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
												<a href="addtocart.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>
												<a href="detail.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>

									<div class="text text-center">
										<span class="seller">Giá siêu tốt</span>
										<span class="category">Brandy</span>
										<h2><?php echo $rows['tenSP']; ?></h2>
										<p class="mb-0"><span class="price"><?php echo $rows['donGiaSP'].' VNĐ'; ?></span></p>
									</div>
								</div>
							</div>
						<?php
						}
					}
				?>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
					<div class="col-md-7 heading-section text-center ftco-animate" id="hangtuoi">
						<h2>Hàng tươi giá tốt mỗi ngày</h2>
					</div>
				</div>
				<div class="row">
				<?php
					require("admin/autoload/autoload.php");
					$query = "SELECT * FROM `sanpham`WHERE sanpham.maNCC LIKE 'CNDD'";
					//Truy vấn nè
					$result = mysqli_query($connect, $query);
					$numrow = mysqli_num_rows($result);
					if ($numrow <> 0) 
					{
						while ($rows = mysqli_fetch_array($result)) 
						{ ?>
							<div class="col-md-3 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(public/uploads/product/<?php echo $rows['hinhAnh']?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
												<a href="addtocart.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>
												<a href="detail.php?id=<?php echo $rows['maSP']?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>

									<div class="text text-center">
										<span class="new">Hàng tươi giá tốt mỗi ngày</span>
										<span class="category">Brandy</span>
										<h2><?php echo $rows['tenSP']; ?></h2>
										<p class="mb-0"><span class="price"><?php echo $rows['donGiaSP'].' VNĐ'; ?></span></p>
									</div>
								</div>
							</div>
						<?php
						}
					}
				?>
					
				</div>
				<div class="row justify-content-center">
					<div class="col-md-4">
						<a href="./allproducts.php" class="btn btn-primary d-block">Xem Tất Cả Sản Phẩm <span class="fa fa-long-arrow-right"></span></a>
					</div>
				</div>
			</div>
		</section>
  
    <section class="ftco-section testimony-section img" style="background-image: url(images/bg_4.jpg);">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Dịch Vụ</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center" style="background: none;"><img style=" width:70px;" src="public/uploads/free.png" alt=""></i></div>
                  <div class="text">
                    <p class="mb-4" style="margin-top: 10px;">Giao hàng miễn phí trong 10km</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <span class="position">Xem chi tiết  tại <a style="color: blue;" href="">ĐK áp dụng.</a></span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center" style="background: none";><img style="width:70px;" src="public/uploads/doi-tra-hang.png" alt=""></div>
                  <div class="text">
                    <p class="mb-4" style="margin-top: 10px;">Hỗ trợ đổi trả trong vòng 7 ngày.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <span class="position">Không áp dụng cho thực phẩm tươi sống</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center" style="background: none;"><img style=" width:70px;" src="public/uploads/thanh-toan-khi-nhan-hang.jpg" alt=""></i></div>
                  <div class="text">
                    <p class="mb-4" style="margin-top: 10px;">Thanh toán khi nhận  hàng.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                    	<div class="pl-3">
		                    <span class="position">Thanh toán bằng tiền mặt.</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center" style="background: none;"><img style=" width:70px;" src="public/uploads/online.png" alt=""></div>
                  <div class="text">
                    <p class="mb-4" style="margin-top: 10px;">Hỗ trợ Online.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <span class="position">8h đến 17h từ Thứ 2 - Chủ Nhật</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php require("footer.php"); ?>