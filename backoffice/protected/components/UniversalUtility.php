<?php

require '/var/www/html/3rdPartyTools/PHPMailer-master/PHPMailerAutoload.php';

class UniversalUtility {
    /* Function is used to add header and footer in email content
     * Author : Rahul Kumar
     * @param : varchar(Email Content)
      @return : full email body with header and footer
     * emailHFB [Email Header Footer BODY]
     * @05072017
     */

    static function emailHFB($content) {
        $BODY = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'></head><body><div style='padding:0;margin:0;background:#ffffff;background-image:url('http://www.mpzmail.com/cp3/images/newslettertextures/grayWallpaper.jpg');background-repeat:no-repeat;background-position:center'><table width='100%' cellpadding='30'><tbody><tr><td align='center'><table style='border:2px solid #0d0555' width='600' cellspacing='0' cellpadding='15' border='0' bgcolor='#ffffff'><tbody><tr><td><div><table style='padding:0px;padding-top:0px;padding-bottom:30px' width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td><table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td valign='top' align='left'><table style='margin-right:30px' cellspacing='0' cellpadding='0' align='left'><tbody><tr><td width='1'><a href='https://caipotesturl.com' target='_blank'><img src='http://freeemaileditor.com/users/118685//957098.png' alt='Single Window Clearance System' title='Single Window Clearance System' width='102.97029702970298' border='0'></a></td></tr></tbody></table><div style='color:#111111;font-size:14px;font-family:'Arial';text-align:Left'><div style='font-style:normal;text-align:center'><span style='color:rgb(0,0,153);font-family:&quot;Arial Black&quot;;font-size:large;font-weight:bold'>SINGLE WINDOW CLEARANCE SYSTEM</span></div><div style='text-align:center'><span style='color:rgb(0,0,153);font-family:&quot;Arial Black&quot;;font-size:large;font-weight:bold'>'<span style='font-style:italic'>Come as a visitor, stay as an investor'</span></span></div></div></td></tr></tbody></table></td></tr></tbody></table><table style='padding:0px;padding-top:0px;padding-bottom:30px' width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td><table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td bgcolor=''>$content</td></tr></tbody></table></td></tr></tbody></table><table width='100%' cellspacing='0' cellpadding='10'><tbody><tr><td bgcolor='#f1f1f1' align='Center'><div><div style='color:#5d5d5d;font-size:11px;font-family:'Arial''><div style='text-align:center'><font face='Arial, Verdana'><span style='font-size:13.3333px;font-weight:bold'>Contact Us</span></font></div>

<div style='text-align:center'><font face='Arial, Verdana'><span style='font-size:13.3333px;font-weight:bold'>Toll Free: 18002701213</span></font></div>
<div style='text-align:center'><font face='Arial, Verdana'><span style='font-size:13.3333px;font-weight:bold'>Email: <span style='color:rgb(0,0,153)'><a href='mailto:mpr@doiuk.org' target='_blank'>mpr@doiuk.org</a></span></span></font></div>
</div></div></td></tr></tbody></table><table style='margin-bottom:30px' width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td align='center'><table cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center'><span style='padding-right:5px;padding-left:5px;color:#111111;font-size:14px;font-family:'Arial''><a href='https://www.facebook.com/investmentinuk/' target='_blank'><img src='http://www.freeemaileditor.com/edit/ezSocialIcons/facebookb.png' alt='Facebook' title='Facebook' width='40' border='0'></a></span></td><td align='center'><span style='padding-right:5px;padding-left:5px;color:#111111;font-size:14px;font-family:'Arial''><a href='https://twitter.com/investmentinuk' target='_blank'><img src='http://www.freeemaileditor.com/edit/ezSocialIcons/twitterb.png' alt='Twitter' title='Twitter' width='40' border='0'></a></span></td></tr></tbody></table></td></tr></tbody></table></div></td></tr></tbody></table></td></tr></tbody></table></div></body></html>";
        return $BODY;
    }

    /**
     * Function to send email with attachment
     * auther: Rahul Kumar
     * @param string string
     * @date 09052018
     */
    static function sendEmailWithAttachment($host, $port, $username, $password, $subject, $message, $to, $attachmentPath) {
        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Host = $host;
        $mail->SMTPDebug = 1;
        $mail->port = $port;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SetFrom($username, EMAIL_NAME);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);
        $mail->AddAttachment($attachmentPath);
        $mail->SMTPSecure = 'tls';
        $mail->AddAddress($to, $username);
        if ($mail->Send() == FALSE) {
            echo "not send";die;
            return false;
        } else {
              echo "send";die;
            return true;
        }
        
    }
        
    
    /**
     * @authour: Rahul Kumar 
     * @date: 10052018
     * @params: $subject,$toEmail,$html (content to send),$attachecdFiles (path of a file which you want to send as attachment)
     * @description : Send Email with attachment and HTML content
    */
    static function TriggerEmail($subject,$toEmail,$html,$attachecdFiles) {
        $mailr = new PHPMailer;
        //$mailr->SMTPDebug = 3;                                   // Enable verbose debug output
        //$mailr->isSMTP();                                       // Set mailer to use SMTP
        $mailr->Host = EMAIL_HOST;                               // Specify main and backup SMTP servers
        //$mailr->SMTPAuth = true;                              // Enable SMTP authentication
        $mailr->Username = EMAIL_USERNAME;                     // SMTP username
        $mailr->Password = EMAIL_PASSWORD;                    // SMTP password
        $mailr->Port = EMAIL_PORT;                           // TCP port to connect to
        $mailr->setFrom(EMAIL_USERNAME, 'Single Window Clearence System - Uttrakhand');
        $mailr->addAddress($toEmail);     // Add a recipient
       // $mailr->addAddress('anand.joshi@in.ey.com');     // Add a recipient
       // $mailr->addAddress('manish1.Jakhmola@in.ey.com');     // Add a recipient
       // $mailr->addAddress('kanhan.Vijay@in.ey.com');     // Add a recipient
        //$mailr->addAddress('investuttarakhand@siidcul.com', 'Enquire'); 
        //$mailr->addAddress('startuputtarakhand@gmail.com', 'Enquire'); 
        $mailr->addBCC("anand.joshi@in.ey.com", "SWCS UK");
        $mailr->addBCC("rahulkumar.ey@gmail.com", "SWCS UK");
        $mailr->addReplyTo(EMAIL_USERNAME, 'Single Window Clearence System - Uttrakhand');
        $mailr->addAttachment($attachecdFiles);                       // Add attachments
        $mailr->addAttachment('/var/www/html/themes/backend/uploads/SingleWindowTimelines.pdf');                     // Add More
        $mailr->isHTML(true);                                       // Set email format to HTML
        $mailr->Subject = $subject;
        $mailr->Body = $html;
        $mailr->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //print_r($mail);
        if (!$mailr->send()) {
            echo 'Due to some technical error your Enquiry message was not sent.';
            echo 'Mailer Error: ' . $mailr->ErrorInfo;
        }else{
            echo "Email Sent";
        }
      // die;
    }
}
