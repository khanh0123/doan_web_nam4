<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giày store</title>
	<meta charset="utf-8">
	<meta name="author" content="http://GiayStore.tk">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-product.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/cart.css">
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
		<h3 class="text-center alert <?= !empty($success) ? 'alert-success' : 'alert-danger' ?>"><?= !empty($success) ? $success : $error ?></h3>
		<?= !empty($redirectto) ? ('<a target="_blank" href="'.$redirectto.'" class="hidden-xs-up btn btn-success btn-thanh-toan" >Thanh toán ngay</a><script>var t = setTimeout(function(){document.querySelector(".btn-thanh-toan").click();},3000)</script>') : '' ?>
		<a href="<?= base_url() ?>" class="btn btn-block btn-outline-danger col-4">Tiếp tục mua hàng</a>
		

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
				<div class="col-12">
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
	<!-- <script src="../assets/js/cart.js"></script> -->
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="<?= base_url() ?>assets/js/homepage.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>

</body>
</html>