<?php

    //Criado um Inbox em mailtrap.io para testes

    use PHPMailer\PHPMailer\PHPMailer;

    function enviar_email($destinatario, $assunto, $mensagemHTML) {

        require 'vendor/autoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->SMTPAuth = true;
        $mail->Username = 'c12d40bd8fbdd2';
        $mail->Password = '********0719';

        $mail->SMTPSecure = false;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('c12d40bd8fbdd2', "Teste Boss");
        $mail->addAddress($destinatario);
        $mail->Subject = $assunto;

        $mail->Body = $mensagemHTML;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }

    }
?>