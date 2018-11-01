<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="footer">
		© 2018 Dashboard Admin by khánh đẹp trai
	</footer>
	<!-- ============================================================== -->
	<!-- End footer -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
				<!-- End Page wrapper  -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Wrapper -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- All Jquery -->
			<!-- ============================================================== -->


			<?php 
            $uri = $_SERVER['REQUEST_URI'];
            $uri = explode("/",$uri);
             ?>
			<!-- Jquery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

			<!-- include toast js-->
			<script src="<?php echo base_url(); ?>vendor/js/jquery.toast.js"></script>
			<!-- Bootstrap tether Core JavaScript -->
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/tether.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<!-- slimscrollbar scrollbar JavaScript -->
			<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
			<!--Wave Effects -->
			<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
			
			<?php if(array_search("product", $uri) > -1 && (array_search("add", $uri) > -1) || array_search("edit", $uri) > -1 ): ?>
			<!-- dropzone -->
			<script src="<?php echo base_url(); ?>vendor/js/dropzone.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/setupdropzone.js"></script>
			<!-- admin js -->
			<?php endif ?>

			<script src="<?= base_url(); ?>assets/js/admin.min.js"></script>
			
			<!--Menu sidebar -->
			<script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
			<!--stickey kit -->
			<script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
			<!--Custom JavaScript -->
			<script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
			<!-- ============================================================== -->
			<!-- This page plugins -->
			<!-- ============================================================== -->

			<!-- Calendar JavaScript -->
			<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
			<!-- sparkline chart -->
			<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
			<!-- ============================================================== -->
			<!-- Style switcher -->
			<!-- ============================================================== -->
			<script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
			

			
			<!-- data table js -->
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

			
			<!-- jQuery peity -->
		    <script src="<?php echo base_url(); ?>assets/plugins/tablesaw-master/dist/tablesaw.js"></script>
		    <script src="<?php echo base_url(); ?>assets/plugins/tablesaw-master/dist/tablesaw-init.js"></script>
			<script src="<?= base_url().'assets/js/init-data-table-product.js' ?>"></script>

			
					

	</body>
</html>