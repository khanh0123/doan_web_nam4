
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
				<li class="breadcrumb-item">Liên hệ</li>
				<li class="breadcrumb-item active">Quản lý liên hệ</li>
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
						<th scope="col" >ID</th>
						<th scope="col" data-tablesaw-priority="1">Họ tên</th>
						<th scope="col" data-tablesaw-priority="2">Tổ chức</th>
						<th scope="col" data-tablesaw-priority="3">Email</th>
						<th scope="col" data-tablesaw-priority="4">Chuyên ngành</th>
						<th scope="col" data-tablesaw-priority="5">Nội dung</th>
						<th scope="col" data-tablesaw-priority="6">Địa chỉ IP</th>
						<th scope="col" data-tablesaw-priority="7">Ngày gửi</th>
						<th scope="col" >Trả lời</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($contact as $value): ?>
						
						<tr style="width: 100%">
							<td><?= $value['id'] ?></td>							
							<td><?= $value['name'] ?></td>
							<td><?= $value['organization'] ?></td>
							<td><?= $value['email'] ?></td>
							<td><?= $value['subject'] ?></td>
							<td class="message"><?= $value['message'] ?></td>
							<td><?= $value['ip'] ?></td>							
							<td><?= Date('Y/m/d h:i:s A',$value['datetime']) ?></td>
							<td class="text-center"><b class="btn btn-warning"><i class="fa fa-envelope-square"></i></b></td>
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