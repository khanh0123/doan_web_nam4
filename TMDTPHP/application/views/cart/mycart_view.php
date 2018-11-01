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
	<!--  Boostrap4 -->
	<link rel="stylesheet" href="<?= base_url() ?>vendor/css/bootstrap.min.css">
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
	<div class="container pt-4 my-cart" id="content">
		<h3 class="text-center alert alert-danger ">Giỏ hàng của tôi</h3>
		<div class="shopping-cart">
			<div class="row">
				<?php if(empty($product) ) { ?>
					<h3 class='col-md-12 text-center alert alert-info empty-cart'>Không có sản phẩm nào trong giỏ hàng</h3>
					<span><a href="<?= base_url(); ?>" class="btn btn-outline-success back-to-shopping">Tiếp tục mua sắm</a></span>
				<?php } else { ?>

				<div class="col-md-8">
					<table class="table detail">
						<thead>
							<tr>
								<th scope="col" colspan="3" class="text-uppercase">Sản phẩm</th>
								<th scope="col" class="text-uppercase">Giá</th>

								<th scope="col" class="text-uppercase">Số lượng</th>
								<th scope="col" class="text-uppercase">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
							<?php $total_money = 0; ?>
							<?php foreach ($product as $value): ?>		

							<?php $link = base_url().'sanpham/'.$value['id'].(!empty($value["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($value["detail"]["seo-link"]))) : '') ?>
							
							<?php 
								for( $i = 0; $i < count($cart) ; $i++ ){  

									if($cart[$i]['code'] == $value['code']) {
										$num = $cart[$i]['num'];
										$size = $cart[$i]['size'];
										$color = $cart[$i]['color'];
										break;
									}
								} 


							?>
							<?php $sum = $value['detail']['price']*$num; $total_money += $sum; ?>

							<tr scope="row" class="product">
								<td class="product-remove">
									<input type="hidden" value="<?= $value['code']; ?>" name="code">
									<a href="#" class="remove-item-cart" data-url="<?= base_url() ?>giohang/xoa"><i class="fas fa-times-circle"></i></a>
								</td>
								<td class="product-thumbnail">
									<a href="<?= $link ?>"><img src="<?= $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name']?>"> </a>
								</td>
								<td class="product-name"><a href="<?= $link ?>"><?= $value['detail']['name'] . ' - ' . $color . ' - ' . $size ?></a></td>
								<td class="product-price font-weight-bold"><span><?= number_format($value['detail']['price'])?></span><sup>đ</sup></td>

								<td class="product-quantity">

									<input name="num" type="number" class="form-control number" min="1" max="10" value="<?= $num ?>">
								</td>
								<td class="product-total font-weight-bold"><span><?= number_format($sum) ?></span> <sup>đ</sup></td>
							</tr>

							<?php endforeach ?>							

							<tr scope="row" class="button">
								<td colspan="5">
									<span>
										<a href="<?= base_url() ?>" class="btn btn-outline-success back-to-shopping">Tiếp tục mua sắm</a>
									</span>
									<span>
										<a href="#" class="btn btn-info update-cart disabled" data-url="<?= base_url() ?>giohang/capnhat">Cập nhật giỏ hàng</a>
									</span></td>
								</tr>

						</tbody>
					</table>
				</div> <!-- het col-8 -->
				<div class="col-md-4 cart-total">
					
					<div class="cart-total-detail">
						<div class="title text-uppercase">Tổng Tiền</div>
				        <table cellpadding="0">
				        	<tbody>
				        		<tr class="temp-total">
				        			<th>Tạm tính</th>
				        			<td><span class="price"><?= number_format($total_money); ?></span><sup>đ</sup></td>
				        		</tr>
				        		<tr class="sum-total">
				        			<th>Tổng tiền</th>
				        			<td><span  class="price"><?= number_format($total_money); ?></span><sup>đ</sup></td>
				        		</tr>
				        	</tbody>
				        </table>
				        <br>
				        <a href="<?= base_url() ?>thong-tin-giao-hang.html" class="btn btn-danger btn-next btn-block mt-4">Tiếp tục</a>
					</div>
					
				</div>
				<?php } //end else ?>
			</div> <!-- end row -->
			
		</div> <!-- hết shopping cart  -->
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
	
	<script src="<?= base_url() ?>assets/js/cart.min.js"></script>
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>
	

</body>
</html>