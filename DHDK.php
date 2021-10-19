<?php
$open = "home"; 
$action = "DHDK";
require("header.php"); 
error_reporting(0);
?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('public/frontend/images/about.jpg');" data-stellar-background-ratio="0.5">
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
					<div class="col-md-9">
						<div class="row mb-4">
							<div class="col-md-12 d-flex justify-content-between align-items-center">
								<h4 class="product-select">Tất cả sản phẩm</h4>
                               
							</div>
						</div>
						<div class="row">
                        <?php
                            require("admin/autoload/autoload.php");
                            $query = "SELECT * FROM `sanpham` JOIN ct_danhmuc on sanpham.ma_ctDM = ct_danhmuc.ma_ctDM WHERE ct_danhmuc.maDM = 'DHDK'";
                            //Truy vấn nè
                            $result = mysqli_query($connect, $query);
                            $numrow = mysqli_num_rows($result);
                            if ($numrow <> 0) 
                            {
                                while ($rows = mysqli_fetch_array($result)) 
                                { ?>
                                    <div class="col-md-4 d-flex">
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
                                                
                                                <span class="category">MM Mega Market</span>
                                                <h2><?php echo $rows['tenSP']; ?></h2>
                                                <p class="mb-0"><span class="price"><?= number_format($rows['donGiaSP'], 0, ",",".") ?> VNĐ</span></p>                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            else
                            {
                                
                                echo "Không có sản phẩm nào!";
                            }
                        ?>
						</div>
						<div class="row mt-5">
		        </div>
					</div>
					<div class="col-md-3">
						<div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Loại sản phẩm</h3>
                <ul class="p-0">
                <?php require("menu_sub.php");  ?>
                </ul>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>
<?php require("footer.php"); ?>