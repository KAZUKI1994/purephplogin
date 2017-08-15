<?php
/**
 * Created by PhpStorm.
 * User: higashiguchi0kazuki
 * Date: 8/15/17
 * Time: 10:21
 */

class Mail{
    /**
     * 送信専用メール
     */
    const SEND_ONLY_EMAIL = "送信用メールアドレス";

    /**
     * 送信専用メール　表示名
     */
    const SEND_ONLY_EMAIL_NAME = "PureLogin";

    /**
     * 送信専用メール　言語名
     */
    const SEND_ONLY_EMAIL_LANGUAGE = "japanese";

    /**
     * 送信専用メール　文字コード
     */
    const SEND_ONLY_EMAIL_ENCODING = 'utf-8';

    /**
     * ホスト名
     */
    const MAIL_HOST = 'mail.example.com';

    /**
     * ポート
     */
    const MAIL_PORT = '25';

    /**
     * ユーザー名
     */
    const MAIL_USER = 'contact@example.com';

    /**
     * パスワード
     */
    const MAIL_PASS = 'smtp_password';

    /**
     * メールを送信する
     * @param string $strRecipient 宛先
     * @param string $strSubject 題名
     * @param string $strBody 本文
     * @param array('path'=>'', 'name'=>'') $binAttachment 添付ファイル
     * @throws \Exception
     */
    public static function send($strRecipient, $strSubject, $strBody, array $binAttachment = []){
        Log::write('*** send_mail ***');

        if(empty($strRecipient)){
            throw new \Exception('宛先が設定されていません。');
        }
        if(empty($strSubject)){
            throw new \Exception('メールタイトルが設定されていません。');
        }
        if(empty($strBody)){
            throw new \Excemption('メール本文が設定されていません。');
        }

        mb_language(self::SEND_ONLY_EMAIL_LANGUAGE);
        mb_internal_encoding(self::SEND_ONLY_EMAIL_ENCODING);

        $from = self::SEND_ONLY_EMAIL;
        $fromname = self::SEND_ONLY_EMAIL_NAME;

        $mail = new \PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = TRUE;
        $mail->Host = self::MAIL_HOST;
        $mail->Port = self::MAIL_PORT;
        $mail->Username = self::MAIL_USER;
        $mail->Password = self::MAIL_PASS;

        $mail->CharSet = "iso-20220-jp";
        $mail->Encoding = "7bit";

        $mail->AddAddress($strRecipient);
        $mail->From = $from;
        $mail->FromName = mb_encode_mineheader(
            mb_convert_encoding(
                $fromname
                , "JIS"
                , self::SEND_ONLY_EMAIL_ENCODING
            )
        );
        $mail->Subject = mb_encode_mimeheader($strSubject);
        $mail->Body = mb_convert_encoding(
            $strBody
            , "JIS"
            , self::SEND_ONLY_EMAIL_ENCODING
        );

        foreach($binAttachment as $attachment){
            if(array_key_exists('path', $attachment) &&
               array_key_exists('name', $attachment) &&
               file_exists($attachment['path'])){
                $mail->AddAttachment(
                    $attachment['path'], $attachment['name']
                );
            }else if(array_key_exists('path', $attachment) &&
                     file_exsists($attachment['path'])){
                $mail->AddAttachment($attachment['path']);
            }else if(file_exists($attachment)){
                $mail->AddAttachment($attachment);
            }
        }
        if(!$mail->Send()){
            throw new \Exception($mail->ErrorInfo);
        }
    }

    /**
     * メールテンプレートに変数を割り当てて本文を取得
     * @param string $templateName
     * @param array $args
     */
    static public function getTemplate($templateName, array $args = []){
        $smarty = new \Smarty();
        $smarty->setTemplateDir(BASE_DIR . '/smarty/templates/mail/');
        foreach($args as $k => $v){
            $smarty->assign($k, $v);
        }
        return $smarty->fetch($templateName);
    }


}