
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
					<li class="breadcrumb-item">Sản phẩm</li>
					<li class="breadcrumb-item active">Thêm sản phẩm</li>
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
		
		<div class="row product">
			<!-- Column -->
			<div class="col-md-6 info-product" >
				<form action="" id="frm-info-product" class="frmaddnewproduct">
					<h3 class="alert alert-info">Nhập thông tin sản phẩm</h3>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Tên sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Mã sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="code" placeholder="Nhập mã sản phẩm" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Danh mục</label>
						<div class="col-md-9">
							<select class="form-control custom-select" data-placeholder="Chọn danh mục sản phẩm" tabindex="1" name="category" required="required">
								<?php foreach ($category as $value): ?>
								<option value="<?= $value['id'] ?>" ><?= $value['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Giá tiền</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="price" placeholder="Nhập giá tiền sản phẩm" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Số lượng</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="number" placeholder="Nhập số lượng sản phẩm" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Chất liệu</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="material" placeholder="Nhập chất liệu sản phẩm" >
						</div>
					</div>

					<div class="form-group row">
						<label class="control-label text-right col-md-3">Màu sắc</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="color" placeholder="Nhập màu sắc sản phẩm" required="required">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu sản phẩm có nhiều màu thì phân cách bởi dấu phẩy " , "</small>
						</div>

					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Kích cỡ</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="size" placeholder="Nhập kích cỡ sản phẩm" required="required">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu sản phẩm có nhiều kích cỡ thì phân cách bởi dấu phẩy " , "</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Xuất xứ</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="origin" placeholder="Nhập xuất xứ sản phẩm" >
						</div>
					</div>
					<h3 class="alert alert-success">Nhập thông tin SEO</h3>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Tiêu đề</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-title" placeholder="Nhập tiêu đề cho trang web" >
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Mô tả sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-description" placeholder="Nhập mô tả cho bài viết" >
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Link SEO</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-link" placeholder="Nhập link seo cho bài viết" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Từ khóa SEO</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-keywords" placeholder="Nhập từ khóa seo cho bài viết" required="required">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu có nhiều từ khóa thì phân cách bởi dấu phẩy " , "</small>
						</div>
					</div>

				</form>
			</div> <!-- end col-md-6 -->
			
			<div class="col-md-6 image-product">
				<h3 class="alert alert-info">Chọn hình ảnh</h3>
				<form action="#" class="dropzone" id="my-awesome-dropzone"></form>
				
				<button class="btn btn-danger btn-block mt-2 " id="btn-addnewproduct" data-url="<?= base_url().'admin/product/add' ?>">Thêm sản phẩm</button>
				<div class="row progress"></div>
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