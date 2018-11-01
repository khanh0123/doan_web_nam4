<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giày store</title>
	<meta charset="utf-8">
	<meta name="author" content="http://GiayStore.tk">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-product.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/cart.min.css">
	<!-- End CSS -->
	<!-- Logo -->
	<link rel="shortcut icon" type="images/x-icon" href="<?= base_url() ?>assets/images/if_nike_shoes_107202.png">
	<!-- End Logo -->
	<!-- CDN Boostrap4 -->
	<link rel="stylesheet" href="<?= base_url() ?>vendor/css/bootstrap.min.css">
	<!-- End CDN Boostrap4 -->
	<!-- Font awesome5 -->
	<link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
	<!-- End Font awesome -->

	
</head>
<body id="top">
	<?php $this->load->view('include/chat_facebook.php'); ?>
	<!--Header-->
    <div id="header" style="position: absolute;">
		<?php $this->load->view('include/header_menu'); ?>
	</div> <!-- Hết header -->

	<!-- start content -->
	<div class="container pt-4" id="content">
		<h3 class="text-left alert alert-success">Chọn phương thức thanh toán</h3>
		<form action="xac-nhan-dat-hang.html" method="post" id="formpayment">
			<div class="row">

				<div class="col-md-8 method-payment">
					<div class="method-payment-list" data-url="<?= base_url().'chon-phuong-thuc-thanh-toan.html' ?>">
						<div class="method " id="method-payment-1" data-method="1">
							<img src="<?= base_url() ?>assets/images/others/icon-payment-1.png" class="icon">
							<div class="title">Thanh toán khi nhận hàng</div>
						</div>
						<div class="method" id="method-payment-2" data-method="2">
							<img src="<?= base_url() ?>assets/images/others/icon-payment-2.png" class="icon">
							<div class="title">Thẻ tín dụng/ ghi nợ</div>
						</div>
						<div class="method" id="method-payment-3" data-method="3">
							<img src="<?= base_url() ?>assets/images/others/icon-payment-3.png" class="icon">
							<div class="title">Thẻ ATM</div>
						</div>
						<div class="method" id="method-payment-4" data-method="4">
							<img src="https://www.nganluong.vn/css/newhome/img/button/safe-pay-1.png" class="icon">
							<div class="title">NganLuong.vn</div>
						</div>

					</div>
					<input type="hidden" id="method-payment-current" value="1" name="method-payment">
					<div class="clearfix"></div>
					
					<div class="description-method">
						<div class="g-recaptcha" id="recapchaWidget1"></div>
						<div class="description-info">
							
						</div>
						
					</div>
				</div>

				<div class="col-md-4 info-order">
					
					<div class="detail-order">
						<h5 class="title">Thông tin đơn hàng</h5>
						<table>
							<tr>
								<td class="text-left">Tạm tính( <span class="product-count"><?= $countcart ?></span> Sản phẩm)</td>
								<td class="text-right"><span class="money"><?= number_format($total_money) ?> <sup>đ</sup> </span></td>
							</tr>
							<tr>
								<td class="text-left">Phí giao hàng</td>
								<td class="text-right"><span class="money"><?= number_format($shipping) ?> <sup>đ</sup> </span></td>
							</tr>
							<tr class="total-finish"> 
								<td class="text-left">Tổng tiền</td>
								<td class="text-right "><span class="money"><?= number_format($total_money+$shipping) ?> <sup>đ</sup> </span></td>
							</tr>

						</table>
					</div>
					
				</div>
			</div>
		</form>

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
				title: 'Welcome To My House!'
			});
		}
	</script>
	<!-- Jquery -->
	<script src="<?= base_url() ?>vendor/js/jquery.min.js"></script>
	<!-- End Jquery -->
	<script src="<?= base_url() ?>vendor/js/popper.min.js"></script>
	<script src="<?= base_url() ?>vendor/js/bootstrap.min.js"></script>
	<script src="https://www.recaptcha.net/recaptcha/api.js"async defer></script>	

	<script src="<?= base_url() ?>assets/js/cart.min.js"></script>
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>


</body>
</html>