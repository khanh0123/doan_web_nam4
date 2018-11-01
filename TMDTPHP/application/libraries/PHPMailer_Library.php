<?php defined('BASEPATH') OR exit('No direct script access allowed.');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(APPPATH."third_party/phpmailer/PHPMailer.php");
require_once(APPPATH."third_party/phpmailer/Exception.php");
require_once(APPPATH."third_party/phpmailer/SMTP.php");


class PHPMailer_Library
{
    public function __construct()
    {
        
    }
    public function test()
    {
    	return 1;
    }


    public function sendMail($subject = '',$title = '' , $mailto = '' ,$nameto='' ,$mailfrom = 'giaystore.tk@gmail.com',$namefrom = 'ADMIN GIAYSTORE.TK', $message = '')
	{


		$mail = new PHPMailer();
		// Get full html:
		$body = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="UTF-8">
		<title>'.$title.'</title>
		</head>
		<body>
		<div style="width: 100%;max-width:650px;margin: 0 auto;">
		<table style="width: 100%">
		<tr>
		<td style="background-color: gray;">
		<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
		<tbody>
		<tr>
		<td valign="middle" style="padding:8px 0px" width="180"> 
		<a href="http://giaystore.tk" style="text-decoration:none;color:#ffffff" title="Cửa hàng giaystore.tk" target="_blank"> 
		<img src="http://giaystore.tk/assets/images/logo.png" alt="Giaystore.tk" border="0" height="auto" width="100%" class="CToWUd" style="max-width:70px">
		</a>					
		</td>
		<td align="right" style="font-size:14px;font-family:arial;color:white;">
		Hotline: 09825555xxx	
		</td> 
		</tr>
		</tbody>
		</table>

		</td>
		</tr>
		<tr>				
		<td style="border-collapse:collapse;border-left:1px solid #ff6e40;border-right:1px solid #ff6e40"> 
		<table cellspacing="0" cellpadding="0" border="0" style="width:100%">
		<tbody>
		<tr> 
		<td style="padding:18px 20px 20px 20px;vertical-align:middle;line-height:20px;font-family:Arial;background-color:#ff6e40;text-align:center"> 
		<span style="color:#ffffff;font-size:115%;text-transform:uppercase">'.$title.'</span> 
		</td> 
		</tr>  
		<tr> 
		<td style="padding:20px 20px 12px 20px"> 
		<span style="font-size:13px;color:#252525;font-family:Arial,Helvetica,sans-serif"> Chào '.$nameto.', </span> 
		</td> 
		</tr>
		<tr> 
		<td style="padding:4px 20px 12px 20px"> 
		<span style="font-size:12px;color:#252525;font-family:Arial,Helvetica,sans-serif;line-height:18px">'.$message.'</span> 
		</td> 
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</table>
		</div>
		</body>
		</html>';
		
		
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'giaystore.tk@gmail.com';                 // SMTP username
		    $mail->Password = 'nzdxoprdyiyfrqku';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($mailfrom, $namefrom);
		    $mail->addAddress($mailto, $nameto);     // Add a recipient
		    $mail->addReplyTo($mailfrom, $namefrom);
		   	// Optional name

		    //Content
		    $mail->isHTML(true);  // Set email format to HTML
		    $mail->CharSet = 'UTF-8';                                 
		    $mail->Subject = $subject;
		    $mail->Body    = $body;

		    if($mail->send())
		    	return 1;
		    return 0;
		} catch (Exception $e) {
			return 0;
		}
	}
}
 ?>