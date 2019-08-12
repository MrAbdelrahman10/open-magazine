<?php

/**
 * Description of Mail
 *
 * @author MrAbdelrahman10
 */
class Mail {

    public $From = '';
    public $To;
    public $Subject;
    public $Body;

    public function Send() {
        $Mailer = new PHPMailer();
        $Mailer->IsMail();
        $Mailer->Subject = $this->Subject;
        $Mailer->Body = $this->Body;
        $Mailer->CharSet = "utf-8";
        $Mailer->IsHTML(true);
        $To = $this->To;
        if ($To) {
            if (is_array($To)) {
                for ($i = 0; $i < count($To); $i++) {
                    $Mailer->AddBCC($To[$i]);
                }
            } else {
                $Mailer->AddAddress($To);
            }
            return $Mailer->Send();
        }
    }

}
