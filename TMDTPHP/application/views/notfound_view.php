<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>404 NOT FOUND</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
	*{
		margin: 0;
		padding: 0;
	}
	.error{
		width: 100%;
		height: 100%;

	}
	body,html{
		width: 100%;
		height: 100%;

	}
	.error img{
		width: 100%
	}
	</style>
	<link rel="stylesheet" href="<?= base_url().'vendor/css/bootstrap.min.css' ?>">
	 <!-- Font awesome5 -->
   <link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- End Font awesome -->
</head>
<body>
	<div class="container">
		<div class="error">
			<img src="<?= base_url().'assets/images/gif/404_gif.gif' ?>" alt="error404">
		</div>
		<div class="alert alert-danger text-center">Trang bạn tìm kiếm hiện không khả dụng</div>
		<div class="alert alert-info text-center"><a href="<?= base_url() ?>">Quay lại trang chủ <i class="fas fa-undo-alt"></i></a></div>
	</div>

</body>
</html>