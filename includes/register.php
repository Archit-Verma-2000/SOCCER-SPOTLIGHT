<?php

     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
     // print_r($_POST);
     $fname=$db->test_input($_POST["fname"]);
     $lname=$db->test_input($_POST["lname"]);
     $email=$db->test_input($_POST["email"]);
     $phone=$db->test_input($_POST["phone"]);
     $password=$db->test_input($_POST["pass"]);
     $hash=password_hash($password,PASSWORD_DEFAULT);
     $userexist=$db->user_exists($fname,$lname,$email);
     if($userexist!=NULL)
     {
          $msg=["status"=>"failed","msg"=>$db->msg("danger","User exists")];
          $json=json_encode($msg);
          echo $json;
     }
     else
     {
          $db->Register($fname,$lname,$email,$phone,$hash);
     
         require '../vendor/autoload.php';    // Load Composer's autoloader
         $mail = new PHPMailer(true);
         // Sanitize inputs
          try {
              $mail->isSMTP();
<<<<<<< HEAD
              $mail->Host = $_ENV['MAIL_HOST']; // Correct SMTP server
=======
              $mail->Host = 'smtp.gmail.com'; // Correct SMTP server
>>>>>>> 15433eeafea1fc719e1a83ca104a436bbff6841d
              $mail->SMTPAuth = true;
               
              // Use your own Gmail account credentials to authenticate
              $mail->Username = $_ENV['Username'];  // Your Gmail address
              $mail->Password =$_ENV['Password'];  // Your Gmail address
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption method
<<<<<<< HEAD
              $mail->Port = $_ENV['MAIL_PORT'];  // TLS port is 587
=======
              $mail->Port = 587;  // TLS port is 587
>>>>>>> 15433eeafea1fc719e1a83ca104a436bbff6841d
          
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
              $mail->addReplyTo($_ENV['Username'], 'Add reply');
              // Set email format to HTML
              $mail->isHTML(true);
              $mail->Subject = "Registration link";
              // .date("l jS \of F Y h:i:s A").
              $mail->Body = "
              <div>
                  <h1>Hello User</h1><br><br>
                  <p>You have received a new registration link, please</p><br><br>
                  <a href='http://localhost/Soccer-Spotlight/includes/action.php?action=registerlink&email=$email'>click here</a><p>to register</p>  
              </div>";
              
              // $mail->SMTPDebug = 3; // Set to 0 in production to avoid exposing sensitive information
             
              // Send the email
             
            
              if($mail->send())
              {
                   $msg=["status"=>"success","msg"=>$db->msg('success', "Mail has been sent")];
                   $json=json_encode($msg);
                   echo $json;
              }
              else
              {
               $msg=["status"=>"failed","msg"=>$db->msg('success', "Mail failed to send")];
               $json=json_encode($msg);
               echo $json;
              }
            }  
           catch (Exception $e) {
              // Output detailed error message
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          }         
     }
?>



  
    