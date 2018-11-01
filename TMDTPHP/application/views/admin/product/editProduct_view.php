
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
					<li class="breadcrumb-item active">Sửa sản phẩm</li>
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
			<?php foreach ($products as $value): ?>
			<!-- Column -->
			<div class="col-md-6 info-product" >
				<form action="#" id="frm-edit-product" data-url="<?= base_url().'admin/product/update/'.$value['id'] ?>">
					<h3 class="alert alert-info text-center">Sửa thông tin sản phẩm</h3>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Tên sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required="required" value="<?= isset($value['detail']['name']) ? $value['detail']['name'] : '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Mã sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="code" placeholder="Nhập mã sản phẩm" required="required" value="<?= $value['code'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Danh mục</label>
						<div class="col-md-9">
							<select class="form-control custom-select" data-placeholder="Chọn danh mục sản phẩm" tabindex="1" name="category" required="required">
								<?php foreach ($category as $cgr): ?>
								<option value="<?= $cgr['id'] ?>" <?= $cgr['id'] == $value['category'] ? 'selected' : '' ?> ><?= $cgr['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Giá tiền</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="price" placeholder="Nhập giá tiền sản phẩm" required="required" value="<?= isset($value['detail']['price']) ? $value['detail']['price']: '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Số lượng</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="number" placeholder="Nhập số lượng sản phẩm" required="required" value="<?= isset($value['detail']['number']) ? $value['detail']['number'] : '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Chất liệu</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="material" placeholder="Nhập chất liệu sản phẩm" value="<?= isset($value['detail']['material']) ? $value['detail']['material'] : '' ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="control-label text-right col-md-3">Màu sắc</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="color" placeholder="Nhập màu sắc sản phẩm" required="required" value="<?= isset($value['detail']['color']) ? implode(",", $value['detail']['color']) : '' ?>">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu sản phẩm có nhiều màu thì phân cách bởi dấu phẩy " , "</small>
						</div>

					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Kích cỡ</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="size" placeholder="Nhập kích cỡ sản phẩm" required="required" value="<?= isset($value['detail']['size']) ? implode(",", $value['detail']['size']) : '' ?>">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu sản phẩm có nhiều kích cỡ thì phân cách bởi dấu phẩy " , "</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Xuất xứ</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="origin" placeholder="Nhập xuất xứ sản phẩm" value="<?= isset($value['detail']['origin']) ? $value['detail']['origin'] : '' ?>">
						</div>
					</div>
					<h3 class="alert alert-success text-center">Sửa thông tin SEO cho trang web</h3>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Tiêu đề</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-title" placeholder="Nhập tiêu đề cho trang web" value="<?= isset($value['detail']['seo-title']) ? $value['detail']['seo-title'] : '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Mô tả sản phẩm</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-description" placeholder="Nhập mô tả cho bài viết" value="<?= isset($value['detail']['seo-description']) ? $value['detail']['seo-description'] : '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Link SEO</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-link" placeholder="Nhập linkseo cho bài viết" required="required" value="<?= isset($value['detail']['seo-link']) ? str_replace('-',' ',$value['detail']['seo-link']) : '' ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-right col-md-3">Từ khóa SEO</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="seo-keywords" value="<?= isset($value['detail']['seo-keywords']) ? str_replace("-",' ',implode(",", $value['detail']['seo-keywords'])) : '' ?>" required="required">
							<small class="form-control-feedback" style="color: #da3434">Lưu ý: nếu có nhiều từ khóa thì phân cách bởi dấu phẩy " , "</small>
						</div>
					</div>
<button class="btn btn-danger btn-block mt-2 btn-updateproduct" type="submit"  >Xác nhận thay đổi</button>

				</form>
			</div> <!-- end info-product -->
			
			<div class="col-md-6 image-product">
				<h3 class="alert alert-info text-center">Quản Lý Hình Ảnh</h3>
				<form action="#" class="dropzone" id="my-awesome-dropzone">
						<?php if(isset($value['detail']['images'])) : ?>
						<?php for( $i = 0 ; $i < count($value['detail']['images']) ; $i++ ): ?>
							<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
								<div class="dz-image"><img data-dz-thumbnail="" alt="" src="<?= $value['detail']['images'][$i]?>" style="width: 100%"></div>
								<input type="hidden" value="<?= $value['detail']['images'][$i]?>" name="current-image[]" class="current-image">
								<a class="dz-remove btn-delete-image" href="#" data-dz-remove="" >Remove file</a>
							</div>
						<?php endfor ?>
						<?php endif ?>
				</form>
				
				
				<div class="row progress"></div>
			</div>
			<?php endforeach ?>
	

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