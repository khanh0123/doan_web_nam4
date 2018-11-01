<?php
defined('BASEPATH') OR exit('No direct script access allowed');  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ADMIN">
    <meta name="author" content="giaystore.tk">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Trang Quản Trị</title>
    <!-- data table css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style-dashboard.min.css" rel="stylesheet">
    <!-- include dropzone css -->
    <link href="<?php echo base_url(); ?>vendor/css/dropzone.css" rel="stylesheet">
    <!-- include toast css -->
    <link href="<?php echo base_url(); ?>vendor/css/jquery.toast.css" rel="stylesheet">
    
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/megna-dark.css" id="theme" rel="stylesheet">
    
    

    <link href="<?php echo base_url(); ?>assets/plugins/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- load css file upload -->
    
</head>
<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader" >
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" style="z-index: 999999;">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url(); ?>">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span style="">
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url(); ?>assets/images/logo-text.png" alt="homepage" class="dark-logo">
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url(); ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage"></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown">
                                <ul>
                                    <li><div class="drop-title">Thông báo</div></li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="<?= base_url(); ?>">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5><?= strtoupper($this->session->userdata('username')); ?> (<?= $this->session->userdata('role'); ?>)</h5> <span class="mail-desc">Chào mừng đến với giaystore.tk </span> <span class="time"><?= Date("h:i - A"); ?></span> 
                                                </div>
                                            </a>
                                            <!-- Message -->
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Xem tất cả thông báo</strong> <i class="fa fa-angle-right"></i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Nhập vào để tìm kiếm..."> <a class="srh-btn"><i class="ti-search"></i></a> </form>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user" class="profile-pic"></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?= strtoupper($this->session->userdata('username')).'[ '.$this->session->userdata('role').' ] ' ?></h4>
                                                <p class="text-muted"><?= $this->session->userdata('username') ?>@giaystore.tk</p><a href="#" class="btn btn-rounded btn-danger btn-sm">Xem trang cá nhân</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> Trang cá nhân</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Tin nhắn</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Thiết lập</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="account/logout" data-href="<?= base_url() ?>api/logout" class="btn-logout"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                                </ul>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user"> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?= strtoupper($this->session->userdata('username')).'[ '.$this->session->userdata('role').' ] ' ?><span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> Trang cá nhân</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Tin nhắn</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Thiết lập</a>
                            <div class="dropdown-divider"></div> <a href="account/logout" data-href="<?= base_url() ?>api/logout" class="dropdown-item btn-logout"><i class="fa fa-power-off"></i> Đăng xuất</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->

                
                <nav class="sidebar-nav ">
                    <ul id="sidebarnav" class="in">
                        <li class="nav-small-cap">Tác vụ</li>
                        <li  >
                            <a  href="<?= base_url(); ?>admin">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Trang quản trị</span>
                            </a>
                            
                        </li>
                        <li >
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Tài khoản</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url(); ?>admin/account/add" >Thêm tài khoản</a>
                                </li>
                                <li><a href="<?= base_url(); ?>admin/account/control">Quản lý tài khoản</a></li>
                            </ul>
                        </li>
                        
                        <li >
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-bank"></i><span class="hide-menu">Thuộc tính trang chủ</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url() ?>admin/homepage/controlBanner">Banner</a>
                                   
                                </li>
                            </ul>
                        </li>
                        <li >
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-tags"></i><span class="hide-menu">Danh mục</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url() ?>admin/category/control">Quản lý</a>
                                   
                                </li>
                            </ul>
                        </li>
                        <li >
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-product-hunt"></i><span class="hide-menu">Sản phẩm</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url(); ?>admin/product/add" >Thêm sản phẩm</a>
                                </li>
                                <li><a href="<?= base_url(); ?>admin/product/control">Quản lý sản phẩm</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-first-order"></i><span class="hide-menu">Đơn Hàng</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url(); ?>admin/orders/control" >Quản Lý Đơn Hàng</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-check"></i><span class="hide-menu">Captcha</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url(); ?>admin/captcha/control" >Quản Lý Captcha</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Liên hệ</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li >
                                    <a href="<?= base_url(); ?>admin/contact/control" >Quản Lý liên hệ</a>
                                </li>

                            </ul>
                        </li>

                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>

            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link"  title="" data-original-title="Thiết lập"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="#" class="link"  title="" data-original-title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="<?= base_url() ?>account/logout" data-href="<?= base_url() ?>api/logout" class="link btn-logout" title="" data-original-title="Đăng xuất"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>
        <input type="hidden" id="current_level" value="<?= $this->session->userdata('role'); ?>" >
        <input type="hidden" id="security_code" value="<?= $this->session->userdata('security'); ?>">
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->