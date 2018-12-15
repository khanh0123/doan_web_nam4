<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giày store</title>
	<meta charset="utf-8">
	<meta name="author" content="http://GiayStore.tk">
	<meta name="description" content="Giày dép nam nữ, giày thể thao, Keds, Slip on, giày thời trang, giày xuất khẩu, giày lười, giày nam"/>
	<meta name="keywords" content="giày,keds,vans,converse,giày vnxk,giày đẹp,giày thể thao,airmax,slipon"/>
	<meta name="robots" content="index,follow"/>
	<meta property="og:url" content="http://giaystore.tk"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.min.css">
	<!-- End CSS -->
	<!-- Logo -->
	<link rel="shortcut icon" type="<?php echo base_url(); ?>assets/images/x-icon" href="<?php echo base_url(); ?>assets/images/if_nike_shoes_107202.png">
	<!-- End Logo -->
	<!--  Boostrap4 -->
	<link rel="stylesheet" href="<?= base_url().'vendor/css/bootstrap.min.css' ?>" crossorigin="anonymous">
	<!-- End  Boostrap4 -->
	<!-- Font awesome5 -->
	<link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
	<!-- End Font awesome -->
	<!-- Owl Carousel CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>vendor/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>vendor/css/owl.theme.default.min.css">
	<!--End Owl Carousel -->

	
</head>
<body id="top">
	<?php $this->load->view('include/chat_facebook.php'); ?>
	<!--Header-->
    <div id="header" style="position: absolute;">
		<?php $this->load->view('include/header_menu'); ?>
	</div> <!-- Hết header -->

	
	<!-- Banner -->
	<div class="banner">
		<!-- Hình Nền -->
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<?php $num_banner = isset($banner) ?  count($banner) : '' ?>
			<ol class="carousel-indicators">
				<?php for($i = 0 ;$i < $num_banner ; $i++): ?>

				<li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"  <?= $i == 0 ? 'class="active"' : ''  ?>></li>


				<?php endfor; ?>
			</ol>
			<div class="carousel-inner">
				<?php $active = false; ?>
				<?php foreach ($banner as $value): ?>			
				
					<div class="carousel-item <?= ! $active ? 'active' : '' ?>">
						<img class="d-block w-100" src="<?php echo $value['url']; ?>" alt="<?= $value['title'] ?>">
					</div>

				<?php $active = true; ?>
				<?php endforeach ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div><!-- Hết Hình Nền -->
	</div> <!--End banner-->
	<!-- Nội dung web -->
	<div class="container pt-4" id="content">

		<div class="product-new">
			<div class="title mt-3 row">
				<h3 class="title-center">
					<b></b>
					<span class="title-main "><img class="" src="<?php echo base_url(); ?>assets/images/gif/new.gif" alt="ico sản phẩm mới">Hàng Mới Về <img class="" src="<?php echo base_url(); ?>assets/images/gif/new.gif" alt="ico sản phẩm mới"></span>
					<b></b>
				</h3>
			</div>

			<div class="row">
				<?php foreach ( $product as $value ): ?>	
				<?php if(in_array($value['id'],$optionsproduct['listnew'])) : ?>
				<?php $link = base_url().'sanpham/'.$value['id'].(!empty($value["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($value["detail"]["seo-link"]))) : '') ?>

				<div class="col-lg-3 col-md-3 col-sm-3 col-6 product_new mt-3 mb-3">
					<div class="image-product">
						<a href="<?= $link ?> ">
							<img class="image-load" src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif" data-src="<?php echo $value['detail']['images'][0] ?>"  alt="<?= $value['detail']['name'] ?>">
							<noscript><img src="<?php echo $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name'] ?>"></noscript>
							<div class="bg-black-op" title="Xem chi tiết sản phẩm"></div>
						</a>
					</div>
					
					<div class="name_product"><a href="<?= $link ?> "><?= $value['detail']['name'] .' - '. $value['detail']['color'][0]  .' - ' . $value['detail']['size'][0]?></a></div>
					<div class="cart_product pt-3">
						<input type="hidden" name="code" value="<?= $value['code'] ?>">
						<input type="hidden" name="color" value="<?= $value['detail']['color'][0] ?>">
						<input type="hidden" name="size" value="<?= $value['detail']['size'][0] ?>">
						<a href="#" class="add-cart" title="Thêm vào giỏ hàng"><i class="fas fa-cart-plus" style="font-size: 1.5em"></i></a>
					</div>
					<div class="clear"></div>
					<div class="price_product">Giá: <span> <?= isset($value['detail']['price']) ? number_format($value['detail']['price']) : 'Liên hệ' ?><sup>đ</sup></span></div>
				</div>

				<?php endif ?>
				<?php endforeach ?>
				
				
			</div>
		</div><!-- Hết SP mới -->

		<!-- Sản phẩm bán chạy -->
		<div class="best-seller">
			<div class="title mt-3">
				<h3 class="title-center">
					<b></b>
					<span class="title-main ">Bán chạy <img src="<?php echo base_url(); ?>assets/images/gif/hot.gif" alt="giảm giá" width="20%"></span>
					<b></b>
				</h3>
			</div>
			<div class="owl-carousel owl-theme">
				<?php foreach ( $product as $value ): ?>	
				<?php if(in_array($value['id'],$optionsproduct['listseller'])) : ?>
				<?php $link = base_url().'sanpham/'.$value['id'].(!empty($value["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($value["detail"]["seo-link"]))) : '') ?>


				<div class="item mb-3 mt-3">
					<a href="<?= $link ?> ">
						<img class="image-load" src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif" data-src="<?php echo $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name'] ?>">
						<noscript><img src="<?php echo $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name'] ?>"></noscript>
					</a>
					<div class="name_product"><a href="<?= $link ?> "><?= $value['detail']['name'] .' - '. $value['detail']['color'][0]  .' - ' . $value['detail']['size'][0]?></a></div>
					<div class="cart_product pt-3">
						<input type="hidden" name="code" value="<?= $value['code'] ?>">
						<input type="hidden" name="color" value="<?= $value['detail']['color'][0] ?>">
						<input type="hidden" name="size" value="<?= $value['detail']['size'][0] ?>">
						<a href="#" class="add-cart" title="Thêm vào giỏ hàng"><i class="fas fa-cart-plus" style="font-size: 1em"></i></a>
					</div>
					<div class="clear"></div>
					<div class="price_product">Giá: <span> <?= isset($value['detail']['price']) ? number_format($value['detail']['price']) : 'Liên hệ' ?><sup>đ</sup></span></div>
				</div>

				<?php endif ?>
				<?php endforeach ?>
			</div> 
		</div><!-- Hết Sản phẩm bán chạy -->
		
		<!-- Sản phẩm giảm giá -->
		<div class="product-sale">
			<div class="title mt-3">
				<h3 class="title-center">

					<b></b>
					<span class="title-main ">Đang giảm giá <img class="image-load" src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif" data-src="<?php echo base_url(); ?>assets/images/gif/sale.gif" alt="giảm giá" width="20%"></span>
					<b></b>
				</h3>
			</div>
			<div class="row">

				<?php foreach ( $product as $value ): ?>	
				<?php if(in_array($value['id'],$optionsproduct['listsale'])) : ?>
				<?php $link = base_url().'sanpham/'.$value['id'].(!empty($value["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($value["detail"]["seo-link"]))) : '') ?>

				<div class="col-lg-3 col-md-3 col-sm-3 col-6 product_new mt-3 mb-3">
					<div class="image-product">
						<a href="<?= $link ?> ">
							<img class="image-load" src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif" data-src="<?php echo $value['detail']['images'][0] ?>"  alt="<?= $value['detail']['name'] ?>">
							<noscript><img src="<?php echo $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name'] ?>"></noscript>
							<div class="bg-black-op" title="Xem chi tiết sản phẩm"></div>
						</a>
					</div>
					
					<div class="name_product"><a href="<?= $link ?> "><?= $value['detail']['name'] .' - '. $value['detail']['color'][0]  .' - ' . $value['detail']['size'][0]?></a></div>
					<div class="cart_product pt-3">
						<input type="hidden" name="code" value="<?= $value['code'] ?>">
						<input type="hidden" name="color" value="<?= $value['detail']['color'][0] ?>">
						<input type="hidden" name="size" value="<?= $value['detail']['size'][0] ?>">
						<a href="#" class="add-cart" title="Thêm vào giỏ hàng"><i class="fas fa-cart-plus" style="font-size: 1.5em"></i></a>
					</div>
					<div class="clear"></div>
					<div class="price_product">Giá: <span> <?= isset($value['detail']['price']) ? number_format($value['detail']['price']) : 'Liên hệ' ?><sup>đ</sup></span></div>
				</div>

				
				<?php endif ?>
				<?php endforeach ?>
			</div>
		</div><!-- Hết Sản phẩm giảm giá --> 	
		<div class="signup-newletter">
			
		</div>
		<hr style="background: black">
		<!-- Map -->
		<div class="map-api" style="height: 300px; padding: 30px 0;">
			<h4>Tìm chúng tôi <i class="fas fa-map-marker"></i></h4>
			<h6>---</h6>
			<div id="map-canvas"></div>
			<script>
				var map;
				function initMap() {
					map = new google.maps.Map(document.getElementById('map-canvas'), {
						center: {lat: 10.739618, lng: 106.669596},
						zoom: 8
					});
					var marker = new google.maps.Marker({
						position: {lat: 10.739618, lng: 106.669596},
						map: map,
						title: 'Welcome To My House!'
					});
				}
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
			async defer></script>
		</div><!-- End Map -->
	</div> <!-- Hết content -->
	<!-- BackTop -->
	<div class="container-fluid backtop_dad">
		<a href="#top"><i class="fas fa-caret-square-up fa-3x backtop"></i></a>
	</div><!--End BackTop -->
	<div class="clear"></div>	
	<!-- footer -->
	<div class="container-fluid footer" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
                    <h5 class="title_footer">LIÊN HỆ</h5>
                    <p>Giay Store: 180 Cao Lỗ, Phường 4, Quận 8 TPCHM</p>
                    <p>HOTLINE: 0163xxxxxxx</p>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
					<h5 class="title_footer">GIỚI THIỆU</h5>
					<p>Tầm nhìn - Sứ mệnh</p>
					<p>Về chúng tôi</p>
					<p>Hệ thống phân phối</p>
					<p>Lịch sử hình thành</p>
					<p>Bộ máy tổ chức</p>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
					<h5 class="title_footer">DỊCH VỤ</h5>
					<p>Giao hàng & nhận hàng</p>
					<p>Trung tâm hỗ trợ</p>
					<p>Hướng dẫn đổi trả hàng</p>
					<p>Hướng dẫn thanh toán</p>
					<p>Hướng dẫn đặt hàng</p>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
					<h5 class="title_footer">THÔNG TIN</h5>
					<p>Chính sách riêng tư</p>
					<p>Điều khoản và điều kiện</p>
					<p>Thỏa thuận người dùng</p>
					<p>Chính sách đổi trả</p>
					<p>Chính sách bảo hành</p>
				</div>
			</div>
			<div class="row footer_copyright">
				<div class="col-12 ">
					<p>Copyright &copy; <?= Date("Y") ?> - <?= base_url(); ?></p>
				</div>
			</div>
		</div>
	</div><!--End footer -->


	<!-- Jquery -->
	<script src="<?= base_url() ?>vendor/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>vendor/js/lazyload.min.js"></script>
	<script>

		window.addEventListener("DOMContentLoaded", function(event) {
				images = document.querySelectorAll('.image-load[src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif"]');
				lazyload(images);
				let interval = setInterval(function() {
					images = document.querySelectorAll('.image-load[src="http://ipl.uv.es/thamazon/gvapps/wamazon/resources/images/loading.gif"]');					
					images.length > 0 ? lazyload(images) : clearInterval(interval);
				}, 2000);			
			
		});
		
	</script>
	<!-- End Jquery -->
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>

	<!-- Owl Carousel JS-->
	<script src="<?= base_url() ?>vendor/js/owl.carousel.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?= base_url() ?>vendor/js/init-owl-carousel.js" type="text/javascript"></script>
	<!-- End Owl Carousel JS-->
	
	
	<script src="<?= base_url().'vendor/js/popper.min.js' ?>"></script>
	<script src="<?= base_url().'vendor/js/bootstrap.min.js' ?>"></script>


</body>
</html>