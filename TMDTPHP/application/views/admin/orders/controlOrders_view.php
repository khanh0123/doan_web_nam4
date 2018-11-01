
<!-- load view header -->
<?php $this->load->view('admin/include/header_admin.php'); ?>
<!-- end load view header -->

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper" >
	<style>
	.list-orders input{
		color: white;
	}
</style>

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

	<div class="row list-orders" style="font-family: segoe ui light !important;">
		<div class="col-md-12">
			<!-- <table id="data-all-product" class="tablesaw table-bordered table tablesaw-swipe table-responsive"  data-tablesaw-mode="columntoggle"> -->
			<!-- <div class=" tablesaw-bar tablesaw-mode-columntoggle"> -->
			<table id="data-all-product" class="table table-bordered table-striped dataTable no-footer table-responsive" data-tablesaw-mode="columntoggle" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" data-tablesaw-priority="persist" data-tablesaw-sortable-default-col>Mã đơn hàng</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Ngày đặt hàng</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Trạng thái</th>
						<th scope="col" data-tablesaw-priority="3">Cập nhật trạng thái đơn hàng</th>
						<th scope="col" data-tablesaw-priority="4">Xem chi tiết</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($listorder as $value): ?>
						
						<tr style="width: 100%">
							<td><?= $value['id'] ?></td>
							<td><?= Date('y-m-d h:i:s',$value['datetime']) ?></td>
							<td>
								<select class="c-select order-status">
									<?php foreach ($liststatus as $stt): ?>
										<option value="<?= $stt['id'] ?>" <?= $stt['id'] == $value['status'] ? 'selected' : '' ?>><?= $stt['name'] ?></option>
									<?php endforeach ?>
								</select>		
							</td>
							<td class="text-center">
								<input type="hidden" name="id-order" value="<?= $value['id'] ?>">
								<b class="btn btn-success update-status-order" data-url="<?= base_url() ?>admin/orders/updatestatus"><i class="fa fa-save"></i></b>
							</td>
							<td><a href="<?= base_url()."admin/orders/detail/".$value['id'] ?>">Chi tiết</a></td>
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