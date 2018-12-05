#Cấu hình
Cấu hình base_url tại ./application/config/config.php
Cấu hình database tại ./application/config/database.php
Cấu hình tài khoản google để gửi mail tại ./application/libraries/PHPMailer_Library.php

#Database
File database mẫu lưu tại ./application/libraries/TMDT.sql

#Tài khoản admin mặc định
username: admin
password: khanhadmin007

#Cronjob
Cronjob url YOUR_DOMAIN/mail/sendmail?s=PASS_MAIL để auto gửi mail cho khách hàng
Cấu hình với command mẫu:[ wget -q -O /dev/null "http://giaystore.tk/mail/sendmail?s=23cf7becf4f9776bc93f6de8c615433e13e4c8bda4b160883421280ed93a928d" > /dev/null 2>&1 ]

Lưu ý: PASS_MAIL nằm trong table `homepage` với record có name là passmail




#Lưu ý
Lưu ý: website yêu cầu chạy phiên bản php 7+