<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Giày store- Liên hệ</title>
    <meta charset="utf-8">
    <meta name="author" content="http://GiayStore.tk">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.min.css">
    <!-- End CSS -->
    <!-- Logo -->
    <link rel="shortcut icon" type="<?php echo base_url(); ?>assets/images/x-icon" href="<?php echo base_url(); ?>assets/images/if_nike_shoes_107202.png">
    <!-- End Logo -->
    <!--  Boostrap4 -->
    <link rel="stylesheet" href="<?= base_url().'vendor/css/bootstrap.min.css' ?>" crossorigin="anonymous">
    <!-- End  Boostrap4 -->
    <!-- Font awesome5 -->
    <link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- End Font awesome -->
    <style>body,html{width: auto;height: auto;background-color:#eff0f4;}</style>
    
</head>
<body id="top">
    <?php $this->load->view('include/chat_facebook.php'); ?>
    <div id="header" style="background: #000000bf !important;color: white">
        <?php $this->load->view('include/header_menu'); ?>
    </div> <!-- Hết header -->
    
    <div id="show-orders">
       <div class="container">
            <h2 class="alert alert-success text-center mt-3">Danh sách đơn hàng</h2>
            <?php if(empty($dataorders)): ?>
                
                <h5 class="text-left" style="color: red">Bạn chưa có bất kì đơn hàng nào</h5>

            <?php endif; ?>
            <?php foreach ($dataorders as $value): ?>
            <?php $cart = $value['detail']['cart'];  ?>

                
            
            <div class="info-order mb-2">
                <div class="row info-main">
                    <div class="col-6 order-code text-left" >Đơn hàng <a href="<?= base_url() ?>chitietdonhang.html/<?= $value['id'] ?>"><span class="code">#<?= $value['id'] ?></span></a><br>Đặt ngày <span><?= Date('d/m/y',$value['datetime']); ?></span>
                    </div>
                    <div class="col-6 view-detail text-right">
                        <a  href="<?= base_url() ?>chitietdonhang.html/<?= $value['id'] ?>">Chi tiết</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table detail-info" style="width: 100%">
                        <?php foreach ($cart as $product): ?>
                        <tr>
                            <td>
                                <img class="img-fluid" src="<?= isset($product['thumbnail']) ? $product['thumbnail'] : '' ?>" alt="<?= isset($product['name']) ? $product['name'] : 'SP không tồn tại' ?>">
                            </td>
                            <td>
                                <span><?= isset($product['name']) ? $product['name'] : 'Sản phẩm đã bị xóa hoặc không tồn tại' ?></span>
                            </td>
                            <td>
                                SL: <span><?= $product['num']; ?></span>
                            </td>
                            <td class="title">
                                <span style="color:red"><?= $value['status'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div> <!-- end info-order -->
            <?php endforeach ?>
            
       </div> <!-- het container -->
       <div class="clearfix"></div>
       <br class="mt-2 mb-2">
       <div class="container text-center">
        <nav aria-label="...">
            <ul class="pagination">
                <?php if($numpage > 1): ?>

                    <li class="page-item <?= $currentpage == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $currentpage > 1 ? base_url().'quanlydonhang.html?p='.($currentpage - 1) : '#' ?>" <?= $currentpage == 1 ? 'tabindex="-1"' : '' ?> >Trước</a>
                    </li>

                <?php endif; ?>
                <?php for($i = 1 ; $i <= $numpage ; $i++ ): ?>

                    <li class="page-item <?= $currentpage == $i ? 'active' : '' ?>"><a class="page-link" <?= $currentpage != $i ? 'href="'.base_url().'quanlydonhang.html?p='.$i : '' ?> "><?= $i ?></a></li>

                <?php endfor; ?>


                <?php if( $currentpage < $numpage ) :  ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= base_url().'quanlydonhang.html?p='.($currentpage + 1) ?>">Sau</a>
                    </li>

                <?php endif; ?>
            </ul>
        </nav>

    </div>

    </div>
<!-- BackTop -->
    <div class="container-fluid backtop_dad">
        <a href="#top"><i class="fas fa-caret-square-up fa-3x backtop"></i></a>
    </div><!--End BackTop -->
    <div class="clear"></div>   
    <!-- footer -->
    <div class="container-fluid footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
                    <h5 class="title_footer">LIÊN HỆ</h5>
                    <p>Giay Store: 180 Cao Lỗ, Phường 4, Quận 8 TPCHM</p>
                    <p>HOTLINE: 0163xxxxxxx</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
                    <h5 class="title_footer">GIỚI THIỆU</h5>
                    <p>Tầm nhìn - Sứ mệnh</p>
                    <p>Về chúng tôi</p>
                    <p>Hệ thống phân phối</p>
                    <p>Lịch sử hình thành</p>
                    <p>Bộ máy tổ chức</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
                    <h5 class="title_footer">DỊCH VỤ</h5>
                    <p>Giao hàng & nhận hàng</p>
                    <p>Trung tâm hỗ trợ</p>
                    <p>Hướng dẫn đổi trả hàng</p>
                    <p>Hướng dẫn thanh toán</p>
                    <p>Hướng dẫn đặt hàng</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12 footer_info">
                    <h5 class="title_footer">THÔNG TIN</h5>
                    <p>Chính sách riêng tư</p>
                    <p>Điều khoản và điều kiện</p>
                    <p>Thỏa thuận người dùng</p>
                    <p>Chính sách đổi trả</p>
                    <p>Chính sách bảo hành</p>
                </div>
            </div>
            <div class="row footer_copyright">
                <div class="col-12 ">
                    <p>Copyright &copy; <?= Date("Y") ?> - <?= base_url(); ?></p>
                </div>
            </div>
        </div>
    </div><!--End footer -->
    <!-- Jquery -->
    <script src="<?= base_url() ?>vendor/js/jquery.min.js"></script>
    <!-- End Jquery -->
    <script src="<?= base_url() ?>vendor/js/popper.min.js"></script>
    <script src="<?= base_url() ?>vendor/js/bootstrap.min.js"></script> 
    <!-- <script src="../assets/js/cart.js"></script> -->
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="<?= base_url() ?>assets/js/homepage.min.js"></script>


</body>
</html>