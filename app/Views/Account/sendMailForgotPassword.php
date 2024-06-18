<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Library/PHPMailer/src/Exception.php';
require 'Library/PHPMailer/src/PHPMailer.php';
require 'Library/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// Passing `true` enables exceptions 
try {
    //Server settings
    $mail->SMTPDebug = 0;                           //Enable verbose debug output

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->CharSet = "utf-8"; // set charset to utf8
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->Port = 587; // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username   = 'minhhuan190102@gmail.com';                     //SMTP username
    $mail->Password   = 'vcho tlpc agae yome';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('minhhuan190102@gmail.com', 'LIVEDOC');
    $mail->addAddress("$email", "$email");     //Add a recipient // người nhận

    $mail->addReplyTo('minhhuan190102@gmail.com', 'LIVEDOC');
  

    
    $emailencode = base64_encode($email);
   $confirmUser =   _WEB_ROOT."/account/newPassword/$emailencode";
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.'>
      <title>Email Confirmation</title>
      <!-- Custom CSS -->
      <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        body {
          font-family: Arial, sans-serif;
          background-color: #f8f9fa;
        }
        .container {
          max-width: 800px;
          margin: 50px auto;
          padding: 20px;
        }
        .card {
          border: 1px solid #ccc;
          border-radius: 5px;
          background-color: #fff;
        }
        .card-header {
          background-color: #9fd7ec;
          color: #fff;
          text-align: center;
          padding: 5px;
          border-top-left-radius: 5px;
          border-top-right-radius: 5px;
        }

        .card-header h4{
          color: #3883ce;
        }

        .card-body {
          background-color: #b2dded;
          text-align: center;
          padding: 20px;
        }

        .card-body a,p{
          padding-bottom: 10px;
        }
        .card-footer {
          background-color: #9fd7ec;
          padding: 10px;
          display: flex;
          align-items: center;
          justify-content: center; 
        }


        .logo-container img {
            width: 40%;
            margin-right: -10px;
            height: auto; 
            display: block; 
        }

        h6 {
            margin: 0; 
            margin-right: 0;
            text-align: center;
        }

        .btn {
          display: inline-block;
          background-color: #dc3545;
          color: #fff;
          text-decoration: none;
          padding: 5px 10px;
          border-radius: 5px;
          transition: background-color 0.3s ease;
        }
        .btn:hover {
          background-color: #c82333;
        }
      </style>
    </head>
    <body>
      <div class='container'>
            <div class='card'>
                <div class='card-header'>
                    <h4>LIVEDOC</h4>
                  </div>
                  <div class='card-body'>
                    <p class='mb-2'>Chúng tôi vừa nhận yêu cầu đặt lại mật khẩu từ bạn.</p>
                    <p class='mb-2'>Vui lòng nhấn vào nút dưới đây để tạo lại mật khẩu mới của bạn:</p>
                    <a class='btn' href='$confirmUser' style='color: #fff;'>Tạo mật khẩu mới</a>
                  </div>
                  <div class='card-footer'>
                        <div class='logo-container'>
                            <img alt='' src='https://admin.medinet.gov.vn//UploadImages/Config/soytehcm/logofooter_2311_moi.png'>
                        </div>
                        <div class='copyright-container'>
                            <h6>Copyright © 2024 by Công ty CP Bệnh Viện Đa khoa LIVEDOC. All rights reserved</h6>
                        </div>
                </div>                            
            </div>
      </div>
    </body>
    </html>
    ";


    $mail->isHTML(true);
    $mail->Subject = "Xin chào $email!";   
    $mail->Body = $html;

    $mail->send();
    // echo '<script>alert("Thông tin đã được gửi về email")</script>';

} catch (Exception $e) {
    echo "Email không được gửi. Chi tiết lỗi: {$mail->ErrorInfo}";
}
