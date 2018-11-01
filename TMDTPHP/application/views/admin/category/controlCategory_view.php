
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
					<li class="breadcrumb-item">Banner</li>
					<li class="breadcrumb-item active">Quản lý</li>
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
		<div class="row category">
			<!-- Column -->
			<div class="col-md-4 ">
				<h4 class="alert alert-info text-sm-center">Thêm danh mục sản phẩm</h4>
				<input type="text" class="form-control mb-2 add-name" placeholder="Nhập tên danh mục" style="color: white">
				<b class="btn btn-primary btn-block btn-add" data-url="<?= base_url() ?>admin/category/add">Thêm</b>

			</div>
			<div class="col-md-8">
				<h4 class="alert alert-info text-sm-center">Danh sách danh mục</h4>
				<div class="list-category">
					<?php foreach ($category as $value): ?>

					<div class="card card-inverse card-primary mb-3">
						<div class="card-block">
							<div class="text-sm-right">
								<a href="#" class="btn btn-info btn-edit"><i class="fa fa-pencil"></i></a>
								<a href="#" data-url="<?= base_url() ?>admin/category/update" class="btn btn-success btn-save hidden-xs-up"><i class="fa fa-floppy-o" ></i></a>
								<a href="#" data-url="<?= base_url() ?>admin/category/delete" class="btn btn-danger btn-delete"><i class="fa fa-remove"></i></a>
								<input type="hidden" class="form-control id" value="<?= $value['id'] ?>">
							</div>
							<blockquote class="card-blockquote ">
								<fieldset class="form-group hidden-xs-up ">
									<input type="text" class="form-control name-edit" value="<?= $value['name'] ?>" style="color: white">									
								</fieldset>
								<div class="name-category"><?= $value['name'] ?></div>
							</blockquote>
						</div>
					</div>

					<?php endforeach ?>
				</div>
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
	
<?php $this->load->view('admin/include/footer_admin.php'); ?>