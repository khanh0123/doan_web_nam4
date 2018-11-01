
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
				<li class="breadcrumb-item">Captcha</li>
				<li class="breadcrumb-item active">Quản lý captcha</li>
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

	<div class="row control-captcha" style="font-family: segoe ui light !important;">
		<div class="col-md-12">
			<!-- <table id="data-all-product" class="tablesaw table-bordered table tablesaw-swipe table-responsive"  data-tablesaw-mode="columntoggle"> -->
			<!-- <div class=" tablesaw-bar tablesaw-mode-columntoggle"> -->
			<table class="table table-responsive" style="width: 100%;color: white">
				<thead>
					<tr>
						<th scope="col" >Email</th>
						<th scope="col" >Public key</th>
						<th scope="col" >Private key</th>
						<th scope="col" >Sửa/Lưu</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $value): ?>						
						<tr>
							<td><input type="text" class="form-control " value="<?= $value['email'] ?>" name="email" disabled></td>
							<td><input type="text" class="form-control" value="<?= $value['publickey'] ?>" name="publickey" disabled></td>
							<td><input type="text" class="form-control" value="<?= $value['privatekey'] ?>" name="privatekey" disabled></td>
							<td>
								<b class="btn btn-primary btn-edit"><i class="fa fa-pencil"></i></b>
								<b class="btn btn-success hidden-xs-up btn-save" data-url="<?= base_url() ?>admin/captcha/update"><i class="fa fa-save"></i></b>
								<input type="hidden" name="id" value="<?= $value['id'] ?>">
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<!-- </div> -->
		</div>

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


<?php $this->load->view('admin/include/footer_admin.php'); ?>