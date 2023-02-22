<?php



class DefaultUtility {


    /**
     * Function to push otp
     * auther: Hemant thakur
     * @param string array
     * @return boolean
     */
    static function post_to_url($url, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=' . $value . '&';
        }
        rtrim($fields, '&');
        // $url=$url.'?'.$fields;
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_TIMEOUT, 500);
        if (ENV == 'prod') {
            curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        if ($result === false) {
            $error = array();
            $error['ERROR_MSG'] = curl_error($post);
            $error['ERROR_CODE'] = curl_errno($post);
            $error['url'] = $url;
            $return = array();
            $return['STATUS_ID'] = '222';
            $return['STATUS_MSG'] = 'CURL_ERROR';
            $return['RESPONSE'] = $error;

            $error_message = "cURL ERROR: \t " . curl_errno($post) . " - " . curl_error($post);
            // echo json_encode($return);
            return false;
        }
        /* if (curl_errno($post) > 0) 
          return FALSE; */
        curl_close($post);

        return $result;
    }

    static function sendsmtpEmail($host, $port, $username, $password, $subject, $content, $to, $email_name = null, $cc = null, $bcc = null, $attchement = null) {
        //$email_name would be the notification_name in the database table
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = $port;
        $mail->Host = $host;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        $mail->SetFrom($username, $email_name);
        $mail->Subject = $subject;
        $mail->MsgHTML($content);
        if ($mail->Send() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }

}
