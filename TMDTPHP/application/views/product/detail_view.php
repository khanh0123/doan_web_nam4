<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= isset($product[0]['detail']['seo-title']) ? $product[0]['detail']['seo-title'] : '' ?></title>
	<meta name="author" content="http://GiayStore.tk">
	<meta name="description" content="<?= isset($product[0]['detail']['seo-description']) ? $product[0]['detail']['seo-description'] : ''  ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-product.min.css">
	<!-- End CSS -->
	<!-- Logo -->
	<link rel="shortcut icon" type="images/x-icon" href="<?= base_url() ?>assets/images/if_nike_shoes_107202.png">
	<!-- End Logo -->
	<!--  Boostrap4 -->
	<link rel="stylesheet" href="<?= base_url().'vendor/css/bootstrap.min.css' ?>" crossorigin="anonymous">
	<!-- End  Boostrap4 -->
	<!-- Font awesome5 -->
	<link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
	<!-- End Font awesome -->
	<!-- slick-css -->
	<link rel="stylesheet" href="<?= base_url() ?>vendor/css/slick.css">
	<link rel="stylesheet" href="<?= base_url() ?>vendor/css/slick-theme.css">
	<!-- end slick css -->

	
</head>
<body id="top">
	<?php $this->load->view('include/chat_facebook.php'); ?>
	<div id="header" >
		<?php $this->load->view('include/header_menu'); ?>
	</div> <!-- Hết header -->

	<!-- start content -->
	<div class="container pt-4" id="content">			
		
		<div id="detail-product">
			<?php foreach ($product as $value): ?>	
			<div class="row">
				<div class="col-md-5 slider-product">
					<div class="slider slider-for" style="margin-bottom: 10px">
						<?php for( $i = 0 ; $i < count($value['detail']['images']) ; $i++ ): ?>

						<div><img src="<?= $value['detail']['images'][$i] ?>" alt="<?= $value['detail']['name'] ?>"  class="img-big"/></div>						
						<?php endfor ?>
					</div>
					<div class="slider slider-nav" >
						<?php for( $i = 0 ; $i < count($value['detail']['images']) ; $i++ ): ?>

						<div><img src="<?= $value['detail']['images'][$i] ?>" alt="<?= $value['detail']['name'] ?>" style="width: 95%;" /></div>	

						<?php endfor ?>						
					</div>
				</div>
				<div class="col-md-4 product-options">
					<h1 class="product-name text-uppercase" style="font-size: 1.4em"><?= $value['detail']['name']; ?></h1>
					<h5 class="product-code" style="font-size: 1.2em">Mã SP: <span class="code text-uppercase"><?= $value['code']; ?></span></h5>
					<h5 class="product-count">Kho: <span class="count"><?= $value['detail']['number']; ?></span></h5>
					<div class="product-price">Giá: <h3 class="display-2 d-inline"><?= number_format($value['detail']['price']); ?><sup>đ</sup></h3></div>
					<div class="row product-size">
						<div class="col-6 my-1 ">
							<select class="custom-select" id="sizeSelect">
								<option selected value="">Chọn size...</option>
								<?php for( $i = 0 ; $i < count($value['detail']['size']) ; $i++ ): ?>
									<option value="<?= $value['detail']['size'][$i] ?>"><?= $value['detail']['size'][$i] ?></option>
								<?php endfor ?>
							</select>
						</div>
						<div class="col-6 my-1 mb-2">
							<select class="custom-select " id="colorSelect">
								<option selected value="">Chọn màu sắc...</option>
								<?php for( $i = 0 ; $i < count($value['detail']['color']) ; $i++ ): ?>
									<option value="<?= $value['detail']['color'][$i] ?>"><?= $value['detail']['color'][$i] ?></option>
								<?php endfor ?>
							</select>
						</div>
					</div>
					

					
					<?php for($i = 0 ; $i < count($value['detail']['color']) ; $i++ ) : ?>
					<?php for($k = 0 ; $k < count($value['detail']['size']) ; $k++ ) : ?>

					<ul class="list-group mt-1">
						<li class="list-group-item">
							<span class="code text-uppercase"><?= $value['code']; ?></span> /
							<span class="color"><?= $value['detail']['color'][$i]; ?></span> /
							<span class="size"><?= $value['detail']['size'][$k]; ?></span> / 
							<span class="materia"><?= $value['detail']['material'] ?></span>
							<input type="hidden" name="code" value="<?= $value['code'] ?>">
							<input type="hidden" name="color" value="<?= $value['detail']['color'][0] ?>">
							<input type="hidden" name="size" value="<?= $value['detail']['size'][0] ?>">
							<a href="#" class="float-right add-cart" title="Thêm sản phẩm này vào giỏ hàng" data-url="<?= base_url().'giohang/them' ?>"><i class="fa fa-cart-plus"></i></a>
						</li>						
					</ul>
					<?php endfor; ?>
					<?php endfor; ?>

					<div class="line"></div>
					<div class="product-number">
						<div class="quantity_title">
							<label class="nomargin">Số lượng: </label>
						</div>
						<div class="quantity clearfix product-quantity">
							<input type="button" value="-" class="minus">
							<input type="number" id="product_quantity" min="1" name="quantity" value="1" title="Qty" class="qty" size="4">
							<input type="button" value="+" class="plus">
						</div>
					</div>
					<div class="line"></div>
					<form action="#" method="post">
						<button type="submit" class="btn btn-danger pd_page_popup button col-xs-12 buynow buynow_detail" style="width: 100%" data-url="<?= base_url().'giohang/them' ?>">Mua ngay</button>
					</form>
					
				</div>
				<div class="col-md-3 product-more-info">
					<div class="pd_policies style_2">
						<div class="pd_policies_title">
							<h5>
								SẼ CÓ TẠI NHÀ BẠN
							</h5>
							<span>từ 1-5 ngày làm việc</span>
						</div>
						<ul class="unstyled">
							<li class="clearfix" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ship cod trên toàn quốc, phí 45k/1 sản phẩm.">
								<a href="#">
									<img src="<?= base_url().'assets/' ?>images/product-detail/pd_policies_1.png" alt="Vận chuyển toàn quốc"> 
									<div class="policies_tit">VẬN CHUYỂN</div>
									<div class="policies_descrip"> Trên toàn quốc</div>
								</a>
							</li>
							<li class="clearfix" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hỗ trợ dổi trả sản phẩm trong vòng 3 đến 5 ngày, nếu không vừa size, sản phẩm bị lỗi (giữ sản phẩm sạch và chưa qua sử dụng) bạn sẽ đổi hoặc trả sản phẩm mà không tốn phí.">
								<a href="#">
									<img src="<?= base_url().'assets/' ?>images/product-detail/pd_policies_2.png" alt="Đổi trả miễn phí"> 
									<div class="policies_tit">	ĐỔI TRẢ MIỄN PHÍ </div>
									<div class="policies_descrip"> Đổi size, sản phẩm bị lỗi miễn phí trong 3 dến 5 ngày</div>
								</a>
							</li>
							<li class="clearfix" data-toggle="tooltip" data-placement="top" title="" data-original-title="Thanh toán khi nhận hàng, thanh toán online hoặc tại cửa hàng bất kì">
								<a href="#">
									<img src="<?= base_url().'assets/' ?>images/product-detail/pd_policies_3.png" alt="Thanh toán khi nhận hàng"> 
									<div class="policies_tit">THANH TOÁN</div>
									<div class="policies_descrip"> Thanh toán khi nhận hàng</div>
								</a>
							</li>

							<li class="clearfix" data-toggle="tooltip" data-placement="top" title="" data-original-title="Để lại số điện thoại, chúng tôi sẽ gọi lại bạn trong vòng 5 phút">
								<a href="#">
									<img src="<?= base_url().'assets/' ?>images/product-detail/pd_policies_4.png" alt="Hỗ trợ mua nhanh"> 
									<div class="policies_tit">HỖ TRỢ MUA NHANH</div>
									<div class="policies_descrip"> <strong style="color: #d61c1f; font-size: 18px;">080000xx</strong><br>
									từ 8:30 - 21:30 mỗi ngày</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>


			<?php if(isset($value['detail']['seo-keywords'])): ?>
			<div class="tags clearfix">
				<p>
					<span class="tag-text">
						<span class="fas fa-tags" aria-hidden="true"></span> 
						Từ khóa: 
					</span>
					<?php for( $i = 0 ;$i < count($value['detail']['seo-keywords']) ; $i++ ): ?>

						<a href="<?= base_url().'/tim-kiem.html?q='.str_replace('-', ' ' , $product[0]['detail']['seo-keywords'][$i]) ?>" rel="tag"><?= str_replace("-", " " , $value['detail']['seo-keywords'][$i]) ?></a>

					<?php endfor; ?>
				</p>
			</div>
			<?php endif; ?>



			<?php endforeach ?>


		</div>
		<div class="fb-comments" data-href="<?= $url ?>" data-numposts="5"></div>
		<div class="signup-newletter">
			
		</div>
		<hr style="background: black">
		<!-- Map -->
		<div class="map-api" style="height: 300px; padding: 30px 0;">
			<h4>Tìm chúng tôi <i class="fas fa-map-marker"></i></h4>
			<h6>---</h6>
			<div id="map-canvas"></div>
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
				title: 'Welcome To Giay Store!'
			});
		}
	</script>
	<!-- Jquery -->
	<script src="<?= base_url() ?>vendor/js/jquery.min.js"></script>
	<!-- End Jquery -->
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="<?= base_url() ?>assets/js/detail-product.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>
	<!-- load bootstrap -->
	<script src="<?= base_url().'vendor/js/popper.min.js' ?>"></script>
	<script src="<?= base_url().'vendor/js/bootstrap.min.js' ?>"></script>
	<!-- slick js -->
	<script src="<?= base_url() ?>vendor/js/slick.min.js"></script>
	<script>
		$(function() {
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: true,
				focusOnSelect: true
			});

			$('a[data-slide]').click(function(e) {
				e.preventDefault();
				var slideno = $(this).data('slide');
				$('.slider-nav').slick('slickGoTo', slideno - 1);
			});
		});	
	</script>
	<!-- end slick js -->

</body>
</html>