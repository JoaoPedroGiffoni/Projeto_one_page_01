<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se todos os campos foram preenchidos
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        // Configurar o destinatário do email
        $to = "joaopedrogiffoni@hotmail.com";
        $subject = "Novo formulário de contato";

        // Construir o corpo do email
        $body = "Nome: $name\n";
        $body .= "Email: $email\n";
        $body .= "Mensagem:\n$message";

        // Configurar os cabeçalhos do email
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Enviar o email
        if (mail($to, $subject, $body, $headers)) {
            echo "Obrigado por entrar em contato. Seu formulário foi enviado com sucesso.";
        } else {
            echo "Desculpe, ocorreu um erro ao enviar o formulário.";
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}
?>
