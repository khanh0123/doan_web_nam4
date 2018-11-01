
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
		<div class="row banner">
			<!-- Column -->
			<div class="col-md-4 ">
				<h4 class="alert alert-info text-sm-center">Thêm ảnh slide banner</h4>
				<div class="form-group">
					<label for="chooseimagebanner">Chọn file ảnh</label>
					<input id="chooseimagebanner" class="form-control" type="file" name="sortpic" required="" />
				</div>
				
				<div class="result"></div>
				<div class="review-image">
					<img src="" alt="" class="img-fluid img-thumb" width="100%">
				</div>
				<input type="text" class="form-control title" placeholder="Nhập mô tả" style="color: white">
				<div class="form-group mt-3">
					<button id="upload" class="btn btn-primary btn-block btn-addbanner" data-url="<?= base_url() ?>admin/homepage/addbanner" data-url_="<?= base_url() ?>admin/homepage/deleteBanner/">Thêm</button>
				</div>  
			</div>
			<div class="col-md-8">
				<h4 class="alert alert-info text-sm-center">Danh sách banner</h4>
				<table class="table table-inverse listbanner table-responsive">
					<thead>
						<tr>
							<th scope="col">STT</th>
							<th scope="col">Mô tả</th>
							<th scope="col">Ảnh</th>
							<th scope="col">Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($databanner as $value) { ?>
						
							<tr>
								<th scope="row" class="stt"><?= $value['stt'] ?></th>
								<td class="title"><?= $value['title'] ?></th>
								<td style="width: 15%" class="image"><img class="img-fluid" src="<?= $value['url'] ?>" alt="<?= $value['title'] ?>"></td>
								<td><b class="btn btn-danger btn-removebanner" data-url='<?= base_url()."admin/homepage/deleteBanner/" ?>'><i class="fa fa-remove"></i></b></td>
							</tr>

						<?php }  ?>
					</tbody>
				</table>
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