<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giày store</title>
	<meta charset="utf-8">
	<meta name="author" content="http://GiayStore.tk">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Logo -->
	<link rel="shortcut icon" type="images/x-icon" href="<?= base_url() ?>assets/images/if_nike_shoes_107202.png">
	<!-- End Logo -->

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-product.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/cart.min.css">
	
	<!-- Boostrap4 -->
	<link rel="stylesheet" href="<?= base_url() ?>vendor/css/bootstrap.min.css">
	<!-- End Boostrap4 -->
	<!-- Font awesome5 -->
	<link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
	<!-- End Font awesome -->

	<!-- End CSS -->

	
</head>
<body id="top">
	<?php $this->load->view('include/chat_facebook.php'); ?>
	<!--Header-->
    <div id="header" style="position: absolute;">
		<?php $this->load->view('include/header_menu'); ?>
	</div> <!-- Hết header -->
	<!-- start content -->
	<div class="container pt-4" id="content">
		<h3 class="text-center alert alert-danger">Thông tin giao hàng</h3>
		<!-- form đặt hàng -->
		<form action="<?= base_url() ?>thanh-toan.html" method="POST" id="form-checkout">
			<div class="row">
				<div class="col-md-7 billing-fill">
					<h4>Thông tin đặt hàng</h4>
					<div class="billing-detail">
						<div class="form-group">
						    <label for="name">Họ tên:</label>
							<input type="text" class="form-control" name="name" placeholder="Họ tên" id="name" required>
						</div>
						<div class="form-group">
						    <label for="email">Địa chỉ Email:</label>
						    <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
						</div>
						<div class="form-group">
						    <label for="phone">Số điện thoại:</label>
							<input type="text" class="form-control" name="phone" placeholder="Số điện thoại" id="phone" required>
						</div>

						<div class="form-group">
						    <label for="address">Địa chỉ nhận hàng:</label>
							<input type="text" class="form-control" name="address" placeholder="Địa chỉ" id="address" required>
						</div>

					</div>
				</div> <!-- hết form điền thông tin -->
				<div class="col-md-5 your-order">
					<h4 class="text-uppercase title">Đơn hàng</h4>
					<table cellpadding="0" class="thead-order" >
						<tr>
							<th class="text-uppercase text-left">Sản phẩm</th>
							<th class="text-uppercase text-right">Thành tiền</th>
						</tr>
					</table>
					<table cellpadding="0" class="detail-order">
						<?php foreach ($product as $value): ?>
							<?php 

								for($i = 0 ; $i < count($cart) ; $i++ ) {
									if( $value['code'] == $cart[$i]['code'] ) {
										$size = $cart[$i]['size'];
										$color = $cart[$i]['color'];
										break;
									}
								} 

							?>
							
						
						<tr class="info-order">
							<td class="info-product text-left"><?= $value['name'] .' - [ '.$color . ' ] - [ size '. $size .' ]' ?>  × <span class="count"><?= $value['num'] ?></span></td>
							<td class="info-product text-right"><span class="money"><?= number_format($value['total']) ?></span><sup>đ</sup></td>
						</tr>

						<?php endforeach ?>
						<tr class="subtotal">
							<td class="text-left">Tạm tính</td>
							<td class="text-right"><span class="money"><?= number_format($totalmoney) ?></span> <sup>đ</sup> </td>
						</tr>

						<?php $shipping = isset($countcart) ? 20000*$countcart : 20000 ?>
						<tr class="order-shipping">
							<td class="text-left">Phí vận chuyển</td>
							<td class="text-right"><span class="money"><?= number_format($shipping) ?></span> <sup>đ</sup> </td>
						</tr>
						<tr class="total-complete">
							<td class="text-left">Tổng tiền</td>
							<td class="text-right"><span class="money"><?= number_format($totalmoney+$shipping); ?></span> <sup>đ</sup> </td>
						</tr>
					</table>
					<div class="form-check accept-policy">
					    <input name="policy" value="true" type="checkbox" class="form-check-input" id="accept-policy" required>
					    <label class="form-check-label" for="accept-policy"><small>Tôi đã đọc và đồng ý các <a href="#">điều khoản và điều kiện.</small> </a></label>
					</div>
					<button type="submit"  class="btn btn-danger btn-block go-pay">Tiến hành thanh toán</button>
				</div>
			</div>
		</form> <!-- hết form -->
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
	<!-- <script src="../assets/js/cart.js"></script> -->
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>
	

</body>
</html>