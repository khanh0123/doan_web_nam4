
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
				<li class="breadcrumb-item"><a href="<?= base_url() ?>admin">Trang chính</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url() ?>orders/control">Đơn hàng</a></li>
				<li class="breadcrumb-item active">Chi tiết đơn hàng</li>
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

	<div class="row detail-order" style="font-family: segoe ui light !important;">
		<div class="col-md-12">
			
			<h3 class="alert alert-success text-center">Đơn hàng: <?= $order['id'] ?></h3>
			<h6>Thông tin đơn hàng</h6>

			<table class="table table-responsive table-bordered" style="width: 100%">
				<thead class="thead-dark"> 
					<tr>
						<th scope="col" >Sản phẩm</th>
						<th scope="col" >Màu sắc</th>
						<th scope="col" >Kích thước</th>
						<th scope="col" >Số lượng</th>
						<th scope="col" >Giá tiền</th>
						

					</tr>
				</thead>
				<tbody>
					<?php foreach ($order['detail']['cart'] as $value): ?>
						
						<tr scope="row" style="width: 100%">
							<td><?= $value['productname'] ?></td>
							<td><?= $value['color'] ?></td>
							<td><?= $value['size'] ?></td>
							<td><?= $value['num'] ?></td>
							<td><?= number_format($value['productprice']) ?> <sup>đ</sup></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">Phí ship:</td>

						<td><?= number_format($order['detail']['shipping']) ?></td>
					</tr>
					<tr>
						<td colspan="4">Tổng:</td>

						<td><?= number_format($order['detail']['shipping']+$order['detail']['total_money']) ?></td>
					</tr>

				</tfoot>
			</table>
			<h6>Thông tin thanh toán</h6>

			<table class="table table-responsive table-bordered" style="width: 100%">
				<thead class="thead-dark"> 
					<tr>
						<th scope="col" >Họ tên</th>
						<th scope="col" >Email</th>
						<th scope="col" >Số điện thoại</th>
						<th scope="col" >Địa chỉ giao hàng</th>
						<th scope="col" >Ngày đặt hàng</th>
						<th scope="col" >Phương thức thanh toán</th>
						<th scope="col" >Trạng thái đơn hàng</th>
						<th scope="col" >Lưu</th>

					</tr>
				</thead>
				<tbody>
						<tr scope="row" style="width: 100%">
							<td><?= $order['detail']['info_payment']['name'] ?></td>
							<td><?= $order['detail']['info_payment']['email'] ?></td>
							<td><?= $order['detail']['info_payment']['phone'] ?></td>
							<td><?= $order['detail']['info_payment']['address'] ?></td>
							<td><?= Date('y-m-d h:i:s A',$order['datetime']) ?></td>
							<td><?= $order['payment'] ?></td>
							<td>
								<select class="c-select form-control order-status" style="color: white">
									<?php foreach ($liststatus as $stt): ?>
										<option value="<?= $stt['id'] ?>" <?= $stt['id'] == $order['status'] ? 'selected' : '' ?>><?= $stt['name'] ?></option>
									<?php endforeach ?>
								</select>		
							</td>
							<td>
								<input type="hidden" name="id-order" value="<?= $order['id'] ?>">
								<b class="btn btn-success update-status-order" data-url="<?= base_url() ?>admin/orders/updatestatus"><i class="fa fa-pencil"></i></b>
							</td>
						</tr>
				</tbody>
			</table>

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