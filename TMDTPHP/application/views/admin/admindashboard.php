
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
					<li class="breadcrumb-item active">Quản trị</li>
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
		<div class="row">
			<!-- Column -->
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<!-- Row -->
						<div class="row">
							<div class="col-8"><span class="display-6">2376 <i class="ti-angle-down font-14 text-danger"></i></span>
								<h6>Total Visits</h6>
							</div>
							<div class="col-4 align-self-center text-right  p-l-0">
								<div id="sparklinedash3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<!-- Row -->
						<div class="row">
							<div class="col-8"><span class="display-6">3670 <i class="ti-angle-up font-14 text-success"></i></span>
								<h6>Page Views</h6>
							</div>
							<div class="col-4 align-self-center text-right p-l-0">
								<div id="sparklinedash"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<!-- Row -->
						<div class="row">
							<div class="col-8"><span class="display-6">1562 <i class="ti-angle-up font-14 text-success"></i></span>
								<h6>Unique Visits</h6>
							</div>
							<div class="col-4 align-self-center text-right p-l-0">
								<div id="sparklinedash2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<!-- Row -->
						<div class="row">
							<div class="col-8"><span class="display-6">35% <i class="ti-angle-down font-14 text-danger"></i></span>
								<h6>Bounce Rate</h6>
							</div>
							<div class="col-4 align-self-center text-right p-l-0">
								<div id="sparklinedash4"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row -->

		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->
		<!-- .right-sidebar -->
		<div class="right-sidebar">
			<div class="slimscrollright">
				<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
				<div class="r-panel-body">
					<ul id="themecolors" class="m-t-20">
						<li><b>With Light sidebar</b></li>
						<li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
						<li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
						<li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
						<li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
						<li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
						<li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
						<li class="d-block m-t-30"><b>With Dark sidebar</b></li>
						<li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
						<li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
						<li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
						<li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
						<li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
						<li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme working">12</a></li>
					</ul>
					<ul class="m-t-20 chatonline">
						<li><b>Chat option</b></li>
						<li>
							<a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	
	
<?php $this->load->view('admin/include/footer_admin.php'); ?>