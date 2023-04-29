<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Http\Request;

class Mail
{
    private $mail;

    function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = env('MAIL_HOST');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = env('MAIL_USERNAME');
        $this->mail->Password = env('MAIL_PASSWORD');
        $this->mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $this->mail->Port = env('MAIL_PORT');
        $this->mail->CharSet = 'UTF-8';
    }


    public function sendMail($to, $subject, $body, $attachmentPath = null, $isHTML = false)
    {
        $this->mail->setFrom($this->mail->Username);
        $this->mail->addAddress($to);
        $this->mail->addReplyTo($this->mail->Username);

        if (isset($attachmentPath)) { $this->mail->AddEmbeddedImage($attachmentPath,'attachment'); }

        $this->mail->isHTML($isHTML);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        $this->mail->send();
    }
    

    public function testEmail(Request $request)
    {
        $to = $request->input('to');
        $subject = 'Email Test';
        $message = 'This is a test email sent by card-delivery-server software.';

        $this->testMail = new Mail();
        $this->testMail->sendMail($to, $subject, $message);

        return 'Email sent successfully';
    }
}

?>
