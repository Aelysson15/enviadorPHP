<?php
$Nome		= $_POST["Nome"];	// Pega o valor do campo Nome
$Fone		= $_POST["Fone"];	// Pega o valor do campo Telefone
$Email		= $_POST["Email"];	// Pega o valor do campo Email
$Mensagem	= $_POST["Mensagem"];	// Pega os valores do campo Mensagem

$Vai 		= "Nome: $Nome\n\nE-mail: $Email\n\nTelefone: $Fone\n\nMensagem: $Mensagem\n";

require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'enviador@gmail.com');	// <-- Insira aqui o seu GMail
define('GPWD', 'senha');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}


 if (smtpmailer('recebedor@dominio.com.br', 'enviador@gmail.com', 'Nome do Enviador', 'Assunto do Email', $Vai)) {

	Header("location:http://www.dominio.com.br/obrigado.html"); // Redireciona para uma página de obrigado.

}
if (!empty($error)) echo $error;
?>
================================================
<?php
	$para = "meuemail@email.com";
	$assunto = "Formulário de Contato";
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$tel = $_REQUEST['tel'];
	$subject = $_REQUEST['subject'];
	$text = $_REQUEST['text'];

		$corpo 	= "<strong>Mensagem de Contato</strong><br /><br />";
		$corpo .= "<strong>Nome: </strong> $name<br />";
		$corpo .= "<strong>E-mail: </strong> $email<br />";
		$corpo .= "<strong>Telefone: </strong> $tel<br />";
		$corpo .= "<strong>Curso de Interesse: </strong> $subject<br />";
		$corpo .= "<strong>Mensagem: </strong> $text<br />";

		$header 	= "Content-type: text/html; charset=utf-8\n";
		$header 	.= "From: $email Reply-to: $email\n";
		

	mail($para, $assunto, $corpo, $header);

	header("location:contato.php?msg=enviado");

?>
