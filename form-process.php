<?php
$errorMSG = "";

// Verificar se o método de solicitação é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Verificar se o campo "name" está preenchido
  if (empty($_POST["name"])) {
    $errorMSG .= "O nome é obrigatório. ";
  } else {
    $name = $_POST["name"];
  }
  
  // Verificar se o campo "email" está preenchido e é um formato de e-mail válido
  if (empty($_POST["email"])) {
    $errorMSG .= "O e-mail é obrigatório. ";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "O e-mail não é válido. ";
  } else {
    $email = $_POST["email"];
  }
  
  // Verificar se o campo "subject" está preenchido
  if (empty($_POST["subject"])) {
    $errorMSG .= "O assunto é obrigatório. ";
  } else {
    $subject = $_POST["subject"];
  }
  
  // Verificar se o campo "message" está preenchido
  if (empty($_POST["message"])) {
    $errorMSG .= "A mensagem é obrigatória. ";
  } else {
    $message = $_POST["message"];
  }

  // Se não houver erros, enviar o e-mail
  if ($errorMSG === "") {
    $EmailTo = "joaopedrogiffoni@hotmail.com;" // Substitua pelo seu e-mail.

    // Preparar o corpo do e-mail
    $Body = "";
    $Body .= "Nome: ";
    $Body .= $name;
    $Body .= "\n";
    $Body .= "E-mail: ";
    $Body .= $email;
    $Body .= "\n";
    $Body .= "Assunto: ";
    $Body .= $subject;
    $Body .= "\n";
    $Body .= "Mensagem: ";
    $Body .= $message;
    $Body .= "\n";

    // Enviar o e-mail
    $success = mail($EmailTo, $subject, $Body, "From:".$email);

    // Verificar se o e-mail foi enviado com sucesso
    if ($success) {
      echo "success";
    } else {
      echo "Algo deu errado ao enviar o e-mail :(";
    }
  } else {
    echo $errorMSG;
  }
}
?>
