<?php 
ob_start();
session_start();





$to      = $_SESSION['uye_mail']; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------------------------

Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$_SESSION['uye_mail'].'&hash='.$_SESSION['uye_hash'].'
 
'; // Our message above including the link
                     
$headers = 'From:deneme@denememailasasd.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email











 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 
<div align="center">
	<h3><a href="index.php">Mail Başarı ile Gönderildi.Gelen Mailden e-mailinizi onaylayın.Anasayfaya dönmek için tıklayın.</a></h3>
</div>

 </body>
 </html>