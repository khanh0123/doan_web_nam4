
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
					<li class="breadcrumb-item">Tài khoản</li>
					<li class="breadcrumb-item active">Quản lý tài khoản</li>
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
		<div class="row users" >
			<!-- Column -->
			<div class="col-md-12 col-sm-6">
				<h2>Quản lý tài khoản</h2>
				<p>Tất cả tài khoản trên website</p>            
				<table class="table table-inverse table-responsive">
					<thead >
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Tài khoản</th>
							<th scope="col">Email</th>
							<th scope="col">Quyền truy cập</th>
							<th scope="col">Lần đăng nhập cuối</th>
							<th scope="col">Xóa</th>
							<th scope="col">Sửa/Lưu</th>
						</tr>
					</thead>
					<tbody >
						<?php foreach ( $listUser as $value ) { ?>						
						<tr class="oneuser">
							<th scope="row" class="id"><?= $value['id'] ?></td>
							<td class="username"><input class="form-control" type="text" value="<?= $value['username'] ?>" disabled></td>
							<td class="email"><input class="form-control" type="text" value="<?= $value['email'] ?>" disabled></td>
							<td class="role">

								<select class="custom-select mb-2 mr-sm-2 mb-sm-0" disabled>
									<option value="admin" <?php echo $value['role'] == 'admin' ? 'selected' : ''  ?> >Quản trị web ( top level)</option>
									<option value="mod" <?php echo $value['role'] == 'mod' ? 'selected' : ''  ?> > Quản lý ( Hạn chế quyền )</option>
									<option value="member" <?php echo ($value['role'] == 'member' || empty($value['role'])) ? 'selected' : ''  ?> >Thành viên thường</option>
								</select>
							</td>
							<td><?= Date('d/m/y - h:i:s - A',$value['lastactive']) ?></td>
							<td class="text-center">
								<b class="btn btn-danger btn-remove" data-url="<?= base_url().'admin/account/delete/'.$value['id'] ?>"><i class="fa fa-remove"></i></b>
							</td>
							<td class="text-center">
								<b class="btn btn-success btn-edit "><i class="fa fa-edit"></i></b>
								<b class="btn btn-primary btn-save hidden-xs-up" data-url="<?= base_url().'admin/account/update/'.$value['id'] ?>"><i class="fa fa-pencil"></i></b>
							</td>
						</tr>


						<?php } ?>
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