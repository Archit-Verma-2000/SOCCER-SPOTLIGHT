<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
     try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Correct SMTP server
        $mail->SMTPAuth = true;
        // "pqtdzjvjkxneyhaq" "vaac tjgt irxs ckmw"
        // Use your own Gmail account credentials to authenticate
        $mail->Username = $_ENV['Username'];  // Your Gmail address
        $mail->Password =$_ENV['Password'];  // Your Gmail address
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption method
        $mail->Port = 587;  // TLS port is 587
    
        // Set the sender email (user's email address)
        $mail->setFrom( $_ENV['Username']);  // $email is user input
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        
        // Add the recipient email (admin or destination email)
        $mail->addAddress($email); 
        $mail->addReplyTo( $_ENV['Username'], 'Add reply');
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = "OTP request";
        // .date("l jS \of F Y h:i:s A").
        $mail->Body = '
        <div>
            <h1>Dear ' . $LoggedUser["first_name"] . ' ' . $LoggedUser["last_name"] . '</h1><br><br>
            <p>Your verification code is <span style="color:red;">' . $otp . '</span>. It is valid for 5 minutes. Do not share this code with anyone.</p>  
        </div>';
        
        // $mail->SMTPDebug = 3; // Set to 0 in production to avoid exposing sensitive information
       
        // Send the email
       
      
        if($mail->send())
        {
            $msg="otp-send+".$db->msg('success', "OTP SEND ")."+".$email;
            echo $msg;
        }
        else
        {
            echo $db->msg("danger","Mail didnt send");
        }
      }  
     catch (Exception $e) {
        // Output detailed error message
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
?>