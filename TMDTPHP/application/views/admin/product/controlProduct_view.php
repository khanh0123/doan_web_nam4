
<!-- load view header -->
<?php $this->load->view('admin/include/header_admin.php'); ?>
<!-- end load view header -->

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper" >
	<!-- <style>
	.page-wrapper{
		background: white !important;color: #564f4fa6 !important;
	}
	.row.product select{
		color: black !important;
	}
	.row.product {
		font-family: segoe ui;
	}
</style> -->

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
				<li class="breadcrumb-item active">Quản lý sản phẩm</li>
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

	<div class="row product" style="font-family: segoe ui light !important;">
		<div class="col-md-12 text-right mb-3">
			<b class="btn btn-primary btn-save-options" style="width: 30%" data-url="<?= base_url().'admin/homepage/updateOptionsProduct' ?>">Lưu lại</b>
			
		</div> <!-- end col-12 -->
		<div class="col-md-12">
			<!-- <table id="data-all-product" class="tablesaw table-bordered table tablesaw-swipe table-responsive"  data-tablesaw-mode="columntoggle"> -->
			<!-- <div class=" tablesaw-bar tablesaw-mode-columntoggle"> -->
			<table id="data-all-product" class="tablesaw table-bordered table-hover table tablesaw-swipe table-responsive" data-tablesaw-mode="columntoggle" style="width: 100%"  >
				<thead>
					<tr>
						<th class="hidden-xs-up" scope="col" data-tablesaw-priority="persist" data-tablesaw-sortable-default-col>ID</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Mã SP</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Tên SP</th>
						<th scope="col" data-tablesaw-priority="6">Ảnh</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Danh mục</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Giá</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Số lượng</th>
						
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Thay đổi cuối</th>
						<th scope="col" data-tablesaw-priority="8">SP mới</th>
						<th scope="col" data-tablesaw-priority="9">SP bán chạy</th>
						<th scope="col" data-tablesaw-priority="10">SP giảm giá</th>
						<th data-tablesaw-priority="11">Xóa</th>
						<th data-tablesaw-priority="12">Sửa</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $value): ?>
						
						<tr>
							<td class="hidden-xs-up"><?= !empty($value['id']) ? $value['id'] : ' ' ?></td>
							<td ><?= !empty($value['code']) ? $value['code'] : ' ' ?></td>
							<td><?= !empty($value['detail']['name']) ? $value['detail']['name'] : ' ' ?></td>
							<td style="width: 10%"><img src="<?= !empty($value['detail']['images']) ? $value['detail']['images'][0] : ' ' ?>" alt="" class="img-fluid" style="width: 100%"></td>
							<td><?= !empty($value['category']) ? $value['category'] : ' ' ?></td>
							<td><?= !empty($value['detail']['price']) ? number_format($value['detail']['price']).'<sup>đ</sup>' : ' ' ?></td>
							<td><?= !empty($value['detail']['number']) ? $value['detail']['number'] : ' ' ?></td>
							
							<td><?= !empty($value['lastchange']) ? Date("d/m/y - h:i:A",$value['lastchange']) : ' ' ?></td>
							<td>
								<div class="form-check">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input option-product-check" name="cbo-newproduct" value="<?= $value['id'] ?>" <?= !empty($optionsproduct['listnew']) ? (in_array($value['id'], $optionsproduct['listnew']) ? 'checked': '') : '' ?> >
										<span class="custom-control-indicator"></span>

									</label>
								</div>
							</td>
							<td>
								<div class="form-check">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input option-product-check" name="cbo-sellerproduct" value="<?= $value['id'] ?>" <?=  !empty($optionsproduct['listseller']) ? (in_array($value['id'], $optionsproduct['listseller']) ? 'checked': '') : '' ?> >
										<span class="custom-control-indicator"></span>

									</label>
								</div>
							</td>
							<td>
								<div class="form-check">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input option-product-check" name="cbo-saleproduct" value="<?= $value['id'] ?>" <?= !empty($optionsproduct['listsale']) ? ( in_array($value['id'], $optionsproduct['listsale']) ? 'checked': '') : '' ?>>
										<span class="custom-control-indicator"></span>

									</label>
								</div>
							</td>
							<td><b class="btn btn-danger btn-delete" data-url="<?= base_url().'admin/product/delete/'.$value['id'] ?>"><i class="fa fa-remove"></i></b></td>
							<td><a href="<?= base_url().'admin/product/edit/'.$value['id'] ?>" class="btn btn-info btn-edit"><i class="fa fa-pencil"></i></a></td>
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