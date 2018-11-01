<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Get Token Full</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
<div class="container">
  <div class="header clearfix">

    <br />

  </div>

  <div class="panel panel-primary">
		  <!-- <div class="panel-heading">Get Token Facebook Full</div>
        <span>Hướng dẫn: vào trang cá nhân nhấn ctrl + U rồi copy source dán vào đây</span> -->
        <div class="panel-body">
          <form id="flogin" name="flogin" class="form-horizontal" action="" method="POST">
				<div class="form-group col-sm-12">
					<input name="user"class="form-control" placeholder="Tài khoản" />
				 </div>
				 <div class="form-group col-sm-12">
					<input name="pass" type="password" class="form-control" placeholder="Mật khẩu" />
       </div>
       <!-- <div class="form-group col-sm-12">
         <textarea name="token" id="token" class="form-control" placeholder="Dán vào đây" ></textarea>
       </div> -->
       <div style="text-align: center">
        <input type="submit" name="btn-submit" id="btn-submit" class="btn btn-danger" value='Get token' />
      </div>
      <br /><br />
    </form>
    <p id="ketqua" class="alert alert-info" style="word-wrap: break-word;">TOKEN: <span style="color: red"></span></p>
  </div>
</div>

<footer class="footer">
  <p>&copy; 2018</p>
</footer>

</div> <!-- /container -->
<!-- <script src="/vendor/js/jquery-3.2.1.min.js" type="text/javascript"></script> -->
<!-- <script src="/vendor/js/bootstrap.min.js" ></script> -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>
  $(document).ready(function (){	
    var progressing = 0;
  	$('form#flogin').submit(function(event) {
  		event.preventDefault();
      // var source = $('#token').val();
      // var reg = /(access_token:")([a-zA-Z0-9]+)/;
      // var data = source.match(reg);
      // // var need = data.exec(source);
      // if(data[2]){
      //   $('#ketqua span').html(data[2]);
      // } else {
      //   $('#ketqua span').html('Input không hợp lệ');
      // }
    	$('#ketqua').html('<span>Đang xử lý...</span>');
      if(progressing){
        return false;
      } 
      progressing = 1;
      $.ajax({
        type        : 'POST',
        url         : '/api/getFullToken',
        data        : $('form#flogin').serialize(),
        dataType    :'JSON',
        cache		    : false
      })

      .done(function(res) {
        if(res){
          if(res.error){
            $('#ketqua span').html(res.message);
          } else if(res.success){
            $('#ketqua span').html(res.token);
          }
        }
      });


    });
  });

   // function check_token(token)
   // {
   // 		$('#check').html('<center><img src="/vendor/loading.gif" /> Đang tải...</center>');
   //      $.ajax({
   //          type        : 'POST',
   //          url         : 'api.php?type=checktoken',
   //          data        : 'token='+token,
   //          cache		: false
   //      })

   //          .done(function(data) {
   // 				$('#check').html(data);
   //          });
   // }
 </script>




</body>
</html>
