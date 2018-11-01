<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="<?= base_url(); ?>">
	<title>Hiển thị theo danh mục</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   	<meta name="author" content="http://GiayStore.tk">
	<meta name="description" content="Giày dép nam nữ, giày thể thao, Keds, Slip on, giày thời trang, giày xuất khẩu, giày lười, giày nam"/>
	<meta name="keywords" content="giày,keds,vans,converse,giày vnxk,giày đẹp,giày thể thao,airmax,slipon"/>
	<meta name="robots" content="index,follow"/>
   <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-product.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style_product.min.css">

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

</head>
<body id="top" class="display-category">
	<?php $this->load->view('include/chat_facebook.php'); ?>
	<div id="header" >
		<?php $this->load->view('include/header_menu'); ?>
	</div> <!-- Hết header -->
	
	<div class="container new_product">
		<h4 class="text-uppercase"><?= isset($_GET['setpage']) ? $_GET['setpage'] : 'Unknown' ?></h4>
		<h6>---</h6>
		<?php if(empty($products)) { ?>
			
			<h4 class="alert alert-info text-center">Không có sản phẩm nào thuộc danh mục này</h4>

			
		<?php } else { ?>
		<div class="row">

			

			<?php foreach ($products as $value): ?>
			<?php $link = base_url().'sanpham/'.$value['id'].(!empty($value["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($value["detail"]["seo-link"]))) : '') ?>
				
			
				<div class="col-lg-3 col-md-3 col-sm-3 col-6 product_new mt-3">
					<div class="image-product">
						<a href="<?= $link ?>">
							<img src="<?php echo $value['detail']['images'][0] ?>" alt="<?= $value['detail']['name'] ?>">
							<div class="bg-black-op" title="Xem chi tiết sản phẩm"></div>
						</a>

					</div>
					<div class="name_product"><a href="<?= $link ?>" title="Xem chi tiết sản phẩm"><?= $value['detail']['name'] ?></a></div>
					<div class="cart_product pt-3">
						<input type="hidden" name="code" value="<?= $value['code'] ?>">
						<input type="hidden" name="color" value="<?= $value['detail']['color'][0] ?>">
						<input type="hidden" name="size" value="<?= $value['detail']['size'][0] ?>">
						<a href="#" class="add-cart" title="Thêm vào giỏ hàng" data-url="<?= base_url() ?>giohang/them"><i class="fas fa-cart-plus" style="font-size: 1.5em" ></i></a>
					</div>
					<div class="clear"></div>
					<div class="price_product">Giá: <span> <?= isset($value['detail']['price']) ? number_format($value['detail']['price']) : 'Liên hệ' ?><sup>đ</sup></span></div>
				</div>
			<?php endforeach ?>

			
			
		</div>
		
		<?php } //end else  ?>
	</div>
	<div class="clearfix"></div>
	<br>
	<div class="container text-center">
		<nav aria-label="...">
			<ul class="pagination">
				<li class="page-item <?= $currentpage == 1 ? 'disabled' : '' ?>">
					<a class="page-link" href="<?= $currentpage > 1 ? base_url().'sanpham/danhmuc?setpage='.strtolower($_GET['setpage']).'&page='.($currentpage - 1) : '#' ?>" <?= $currentpage == 1 ? 'tabindex="-1"' : '' ?> >Trước</a>
				</li>
				<?php for($i = 1 ; $i <= $numpage ; $i++ ): ?>

				<li class="page-item <?= $currentpage == $i ? 'active' : '' ?>"><a class="page-link" <?= $currentpage != $i ? 'href="'.base_url().'sanpham/danhmuc?setpage='.strtolower($_GET['setpage']).'&page='.$i.'"' : '' ?> "><?= $i ?></a></li>

				<?php endfor; ?>


				<?php if( $currentpage < $numpage ) :  ?>

				<li class="page-item">
					<a class="page-link" href="<?= base_url().'sanpham/danhmuc?setpage='.strtolower($_GET['setpage']).'&page='.($currentpage + 1) ?>">Sau</a>
				</li>

				<?php endif; ?>
			</ul>
		</nav>
	  	
	</div>


	<!-- Map -->
	<div class="container" style="height: 300px; padding: 30px 0;">
		<h4>LOCATION <i class="fas fa-map-marker"></i></h4>
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
	<!-- BackTop -->
	<div class="container-fluid backtop_dad">
		<div class="row">
			<div class="col-12">
				<a href="#top"><i class="fas fa-caret-square-up fa-3x backtop"></i></a>
			</div>
		</div>
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
	<!-- End Jquery -->
	<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevSagkgBe8XjOjctGl3vplXiV9mQiIt0&callback=initMap"
	async defer></script>
	<!-- load bootstrap -->
	<script src="<?= base_url().'vendor/js/popper.min.js' ?>"></script>
	<script src="<?= base_url().'vendor/js/bootstrap.min.js' ?>"></script>
	<script src="<?= base_url() ?>assets/js/homepage.min.js"></script>

</body>
</html>