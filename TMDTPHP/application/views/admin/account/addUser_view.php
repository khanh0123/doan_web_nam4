
<!-- load view header -->
<?php $this->load->view('admin/include/header_admin.php'); ?>
<!-- end load view header -->

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper" >
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-6 col-8 align-self-center">
				<h3 class="text-themecolor m-b-0 m-t-0">Quản trị</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Trang chính</a></li>
					<li class="breadcrumb-item"><a href="<?= base_url() ?>admin/account/control">Tài khoản</a></li>
					<li class="breadcrumb-item active">Thêm tài khoản</li>
				</ol>
			</div>

		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row users">
			<!-- Column -->
			<div class="col-md-8 offset-md-2">
				<div class="form-group">
				  <label >Tên tài khoản:</label>
				  <input type="text" class="form-control username" name="username">
				</div>
				<div class="form-group">
				  <label >Mật khẩu:</label>
				  <input type="password" class="form-control password" name="password">
				</div>
				<div class="form-group">
				  <label >Nhập lại mật khẩu:</label>
				  <input type="password" class="form-control repassword" name="repassword">
				</div>
				<div class="form-group">
					<label >Email:</label>
					<input type="email" class="form-control email" name="email">
				</div>

				<div class="result"></div>
				<input class="btn btn-primary addUser" type="button" data-security="<?= $this->session->userdata('security'); ?>" value="Thêm" data-url="<?= base_url(); ?>admin/account/add">
			</div>

			<!-- end Column -->
		</div>
		<!-- end Row -->

		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->

	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- footer -->
	<!-- ============================================================== -->
	
<?php $this->load->view('admin/include/footer_admin.php'); ?>