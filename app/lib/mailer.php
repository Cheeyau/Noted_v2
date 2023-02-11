<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require APPROOT . '/lib/PHPMailer/src/PHPMailer.php'; 
    require APPROOT . '/lib/PHPMailer/src/SMTP.php'; 
    require APPROOT . '/lib/PHPMailer/src/Exception.php';
    
    class Mailer {
        // Send mail for resetting password 
        public function SendMail(string $userEmail, string $subject,string $body) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = MAILACCOUNT;
            $mail->Password = MAILPASSWORD;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;

            $mail->setFrom(MAILACCOUNT, 'NoReply.Noted!');
            $mail->addAddress($userEmail);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $body;
            
            if($mail->send()) {
                return true;
            } else {
                return false;
        }}
    } 