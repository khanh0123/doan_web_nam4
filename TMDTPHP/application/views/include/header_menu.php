<!-- Menu -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark menu-top"> <!--Menu-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="logo" style="max-width:75px">
        <a class="navbar-brand" href="<?= base_url() ?>" ><img class="img-fluid" src="<?= base_url() ?>assets/images/logo.png" alt="LOGO HERE"></a>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav menu-left">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>"><i class="fa fa-home"></i> TRANG CHỦ </a>
            </li>
            <?php if(!empty($category)) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">SẢN PHẨM</a>
                    <ul class="dropdown-menu">
                        <?php foreach ($category as $value): ?>

                            <li><a class="dropdown-item" href="<?= base_url() ?>sanpham/danhmuc?setpage=<?= strtolower($value['name']) ?>"><?= strtoupper($value['name']) ?></a></li>

                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>lien-he-voi-chung-toi.html">LIÊN HỆ <i class="fa fa-comment"></i></a></li>

        </ul>
        <ul class="navbar-nav ml-auto menu-right">

            <!-- Login Open the Modal -->
            <?php if( $this->session->has_userdata('username') ) { ?>
                <input type="hidden" value="<?= $this->session->userdata('security'); ?>" id="security">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Xin chào <?= $this->session->userdata('username').' '?><i class="fa fa-user"></i> <span class="fas fa-caret-down"></span></a>
                    <ul class="dropdown-menu">

                        <?php if( $this->session->userdata('role') == 'admin' ||  $this->session->userdata('role') == 'mod' )   { ?>
                            
                            <li><a href="<?= base_url(); ?>admin" class="dropdown-item">Quản lý trang web</a></li>

                        <?php }?>
                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModal_changepass">Đổi mật khẩu</a></li>
                        <li><a href="<?= base_url(); ?>quanlydonhang.html" class="dropdown-item">Đơn hàng của tôi</a></li>
                        <li><a href="<?= base_url(); ?>logout" class="btn-logout dropdown-item" data-href="<?= base_url(); ?>api/logout">Đăng xuất</a></li>
                    </ul>
                </li>

            <?php  } else { ?>

                <li class="nav-item"><a class="nav-link btn-frm-login" data-toggle="modal" data-target="#myModal_login" href="#">Đăng nhập &nbsp;<i class="far fa-user"></i></a></li>
                
            <?php } ?>

            <li class="nav-item" id="cart"><a class="nav-link" href="<?= base_url() ?>giohang.html">Giỏ hàng &nbsp;<i class="fas fa-shopping-cart"></i> (<span class="count"><?= isset($countcart) ? $countcart : 0 ?></span>)</a></li>
            <li class="nav-item search">
                <form action="<?= base_url() ?>tim-kiem.html" method="GET" class="form-search">
                    <div class="input-group">
                        <input class="form-control py-2 border-right-0 border input-search" type="search" placeholder="Tìm kiếm" name="q" require="required">
                        <span class="input-group-append" >
                            <div class="input-group-text bg-transparent btn-search-submit"><i class="fa fa-search"></i></div>
                        </span>
                    </div>
                </form>
                
            </li>
        </ul>
        
    </div>

</nav><!--Hết Menu-->

                
<?php if( ! $this->session->has_userdata('username')) { //start if?>
    <!-- Form Login -->
    <form action="<?= base_url(); ?>api/login" method="post" id="formlogin">
        <!-- Modal -->
        <div class="modal fade" id="myModal_login"> <!-- Phải trùng với data-target -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Đăng nhập tài khoản</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <div class="form-group">
                            <label for="user1">Tài khoản</label>
                            <input type="text" class="form-control" id="user1" placeholder="Nhập tên đăng nhập" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Mật khẩu</label>
                            <input type="password" class="form-control" id="pwd1" placeholder="Nhập mật khẩu" name="password" > 
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Ghi nhớ
                            </label>
                        </div>
                        <div class="result">
                            
                        </div>
                    </div>
                    <div class="form-group text-right pr-3">
                        <span>Chưa có tài khoản? <a data-dismiss="modal" data-toggle="modal" data-target="#myModal_signup" href="#">Đăng ký.</a> </span>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- Submit form -->
                        <input type="submit" class="btn btn-primary" value="Đăng nhập" name="login">
                        <!--End Submit form -->
                        <!-- Close Modal -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        <!-- Close Modal -->
                    </div>

                </div>
            </div>
        </div> <!-- End Modal -->
    </form><!-- End Form -->

    <!-- Form của SignUp -->
    <form action="<?= base_url(); ?>api/signup" method="post" id="formsignup">
        <!-- Modal -->
        <div class="modal fade" id="myModal_signup"> <!-- Phải trùng với data-target -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Đăng ký</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <div class="form-group">
                            <label for="user2">Tài khoản</label>
                            <input type="text" class="form-control" id="user2" placeholder="Nhập tên tài khoản" name="signup" required minlength="5">
                        </div>
                        <div class="form-group">
                            <label for="pwd2">Mật khẩu</label>
                            <input type="password" class="form-control" id="pwd2" placeholder="Enter password" name="password" required minlength="5">
                        </div>
                        <div class="form-group">
                            <label for="pwd2_re">Lặp lại mật khẩu</label>
                            <input type="password" class="form-control" id="pwd2_re" placeholder="Repeat password" name="repassword" required minlength="5">
                        </div>
                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="email" class="form-control" id="email2" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="result">
                            
                        </div>
                    </div>
                    <div class="form-group text-right pr-3">
                        <span>Đã có tài khoản? <a data-dismiss="modal" data-toggle="modal" data-target="#myModal_login" href="#">Đăng nhập.</a> </span>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                       <div id="captchasingup" class="g-recaptcha"></div>
                       <!-- Submit form -->
                       <button type="submit" class="btn btn-primary">Xác nhận đăng ký</button>
                       <!--End Submit form -->
                       <!-- Close Modal -->
                       <input type="hidden" name="signupform">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                       <!-- Close Modal -->
                   </div>
               </div>
           </div>
       </div> <!-- End Modal -->
   </form><!-- End Form -->
   
   

<?php } else {//end if ?>

    <!-- form doi mat khau -->
    <form action="<?= base_url(); ?>changepass" method="post" id="formchangepass">
        <!-- Modal -->
        <div class="modal fade" id="myModal_changepass"> <!-- Phải trùng với data-target -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Đổi mật khẩu</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <div class="form-group">
                            <label for="oldpass">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="oldpass" placeholder="Nhập vào mật khẩu hiện tại" name="oldpass" >
                        </div>
                        <div class="form-group">
                            <label for="newpass">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="newpass" placeholder="Nhập mật khẩu mới" name="newpass" > 
                        </div>
                        <div class="form-group">
                            <label for="renewpass">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="renewpass" placeholder="Nhập lại mật khẩu mới" name="renewpass" > 
                        </div>
                        <div class="result">
                            
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- Submit form -->
                        <input type="submit" class="btn btn-primary" value="Xác nhận đổi" >
                        <!--End Submit form -->
                        <!-- Close Modal -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        <!-- Close Modal -->
                    </div>

                </div>
            </div>
        </div> <!-- End Modal -->
    </form><!-- End Form -->

<?php } //end else ?>

<?php if(isset($publickeycaptcha)): ?>

    <script type="text/javascript">
      var onloadCallback = function() {
        if(document.querySelector("#captchasingup") != null) {
            widgetId1 = grecaptcha.render('captchasingup', {
              'sitekey' : '<?= $publickeycaptcha  ?>'
          });
        }
        if(document.querySelector("#recapchaWidget1") != null) {
            widgetId2 = grecaptcha.render('recapchaWidget1', {
              'sitekey' : '<?= $publickeycaptcha  ?>'
          });

        }                    
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<?php endif; ?>
