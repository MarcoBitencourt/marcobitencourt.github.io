<?php

//Formulário de Contato | Versão 7.5 (klebrr)<br>
//Autor Original: Autor Original: Apoena
//http://www.phpbrasil.com
// adaptado em 05/09/2005 - kleber (klebrr em klebrr.com)
// não funcionava com php 5.0.1 e 5.0.4	 (Testado apenas no Linux)
// dispensei o include (config.php) pra ficar num só arquivo	

echo "<html>
<head>
<title> Processando... </title>
<link rel=\"stylesheet\" href=\"class.css\" type=\"text/css\">
</head>";
// Variaveis originadas no email_form.php
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
global $email; //função para validar a variável $email no script todo
// adicionei a captura do ip do remetente 
$ip = $_SERVER['REMOTE_ADDR'];
//Seu email, para onde irao as informações do formulário
$mail_destino = "marcostyle1@gmail.com";
echo "<body bgcolor=\"#FFFFFF\" leftmargin=\"10\" topmargin=\"10\" marginwidth=\"0\" marginheight=\"0\">
<center><font class=\"texto\">";
//Mensagem de cabeçalho do email
$mail_header = "Stronda Emuladores & IPTV";
//Mensagem para o email de resposta
$msg_reply = "Olá $nome,\nRecebemos a sua mensagem \nObrigado pelo seu contato!\n\n Esta é uma mensagem automática.\n Por Favor não responda este e-mail.\n $ip";
//Mensagem de Erro
$msg_erro = "Atenção!! Os campos (Nome, E-mail e Mensagem ) não podem estar em branco.";
//Endereço do seu SMTP (para se conectar no SMTP)	(acho que é só para windows afinal não tem postfix ou sendmail)
//$msg_smtp_url = "<p>smtp.prov.com.br</p>";
//Login do seu SMTP (para se conectar no SMTP)
//$msg_smtp_login = "";
//Senha do seu SMTP (para se conectar no SMTP)
//$msg_smtp_senha = "";

//Obrigatoriedade
if ($nome!="" and $email!="")
	{
	$msg.="$mail_header\n\n";
	$msg.="Nome: $nome\n";
	$msg.="Email: $email\n";
	$msg.="Mensagem: $mensagem\n";
	$msg.="ip da origem: $ip";

	if (mail($mail_destino, "Mensagem de: $nome", $msg, "From:$mail_destino"))
		{
		//Imprimindo confirmação de envio
		echo 
			" </font></center>
			<html>
			<meta http-equiv=refresh content=10;URL=./></html>";
			echo "<font class=\"texto\">";
			echo "<b>olá! $nome</b>,<br><br>sua mensagem:<br> <font color=\"#FF0000\"><b>$mensagem </b></font><br>Foi enviada com sucesso!<br><br>";
			echo "Obrigado!<br>vc receberá um e-mail de confirmação desta mensagem<br><br>endereço ip: <b>$ip</b></font> 
			";
		//Enviando mensagem de confirmação para o email do internauta
		 mail("$nome<$email>", "Re:Formulário enviado: $assunto", $msg_reply, "From:<$mail_destino>");
		}
		else
		echo
			"
			<meta http-equiv=refresh content=3;URL=../>
			</html><center><br><br><font color=red>
			<b>Erro ao enviar e-mail!</b>
			</font></center>
			";
	}
else
	{
	//Alerta sobre os campos obrigatórios
	echo 
		"
		<br><br><center>
		$msg_erro <br><br>
		<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>
		</center>
		";
	}
header("Location: index.html");
?>

