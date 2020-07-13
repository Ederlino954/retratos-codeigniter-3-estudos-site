<?php
    defined('BASEPATH') OR exit('URL inválida.');

    // -----------------------------------------
    class Emails{

        // ==============================
        public function enviar($assunto, $mensagem, $destinatarios){
            include_once 'assets\phpmailer\PHPMailerAutoload.php';
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->SMTPDebug = MAIL_DEBUG_MODE;
            $mail->Host = MAIL_HOST;
            $mail->Port = MAIL_PORT;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->IsHTML(true); // texto do email 
            $mail->CharSet="UTF-8";

            // remetente e destinatário 
            $mail->setFrom(MAIL_FROM, MAIL_REMETENTE);
            foreach ($destinatarios as $destinatarios ) {
                $mail->addAddress($destinatarios);
            }

            // Assunto 
            $mail->Subject = $assunto;
            // mensagem 
            $mail->Body = $mensagem;

            if ($mail->send()) {
                return 'email_sucesso';
            } else {
                return 'email_erro';
            }
        }
    }



?>
