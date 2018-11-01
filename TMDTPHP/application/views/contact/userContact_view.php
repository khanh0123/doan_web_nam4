<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Giày store- Xem tất cả đơn hàng</title>
    <meta charset="utf-8">
    <meta name="author" content="http://GiayStore.tk">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/contact.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.min.css">
    <!-- End CSS -->
    <!-- Logo -->
    <link rel="shortcut icon" type="<?php echo base_url(); ?>assets/images/x-icon" href="<?php echo base_url(); ?>assets/images/if_nike_shoes_107202.png">
    <!-- End Logo -->
   <!-- Boostrap4 -->
    <link rel="stylesheet" href="<?= base_url() ?>vendor/css/bootstrap.min.css">
    <!-- End Boostrap4 -->
    <!-- Font awesome5 -->
    <link href="<?= base_url() ?>assets/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- End Font awesome -->
    
</head>
<body id="top">
    <?php $this->load->view('include/chat_facebook.php'); ?>
    <div id="header" style="background: #000000bf !important;">
        <?php $this->load->view('include/header_menu'); ?>
    </div> <!-- Hết header -->
    
    <div id="page-4" class="contact container">
        <h2>Liên hệ</h2>
        <div id="contact-container">
            <div id="left-contact">
                <h3>Nhà thiết kế</h3>
                    <img src="<?php echo base_url() ?>assets/images/contact/thedesigner.png" width="180" height="378" alt="The Designer">
                <div id="contact-person"></div>
            </div>
            <div id="form-contact"> 
                <form id="user_contact" method="post" action="<?= base_url().'lienhe/guilienhe.html' ?>">
                    <div class="input">
                        <input type="text" name="name" class="inputform name" placeholder="Họ tên" required>                
                    </div>
                    <div class="input">     
                        <input type="text" name="organization" class="inputform work" placeholder="Nơi làm việc" required>
                    </div>
                    <div class="input"> 
                        <input type="email" name="email" class="inputform email" placeholder="Địa chỉ Email" required>              
                    </div>
                    <div class="input">         
                        <input type="text" name="subject" class="inputform subject" placeholder="Chuyên ngành" required>
                    </div>
                    <div class="input">
                        <input type="text"  class="verif">   
                        <textarea  rows="9" cols="1" class="textareaform message" name="message" required placeholder="Bạn cần liên hệ điều gì?"></textarea>
                    </div>
                    <div id="recapchaWidget1" class="g-recaptcha"></div>
                    <div class="input"><input name="contact" type="submit" class="buttonform" value="Gửi liên hệ" style="cursor: pointer"></div>  
                </form>
                         
            </div>
            <div id="right-contact">
                <h3>Nhà phát triển</h3>
                <img src="<?php echo base_url() ?>assets/images/contact/developer.png" width="180" height="367" alt="the developer">
             </div> 
        </div>
        <div style="clear:both"></div>
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
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="<?= base_url() ?>assets/js/homepage.min.js"></script>

    <script src="<?= base_url() ?>assets/js/contact.min.js"></script>
    
    <script src="<?= base_url() ?>vendor/js/popper.min.js"></script>
    <script src="<?= base_url() ?>vendor/js/bootstrap.min.js"></script>


</body>
</html>