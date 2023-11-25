<?php include('header.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $ttl ?> - Contato </title>
	<?php
	include('core/mod_includes/php/funcoes-jquery.php');
	?>
</head>

<body>
	<div id='janela' class='janela' style='display:none;'> </div>

	<?php
	date_default_timezone_set('America/Sao_Paulo');
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$linha = $_POST['linha'];

	if ($linha ==''){
		$pagina = ucwords(str_replace("_", " ", $_GET['pg']));

	}else {
		$pagina = $linha;
	}
	$pag = $_GET['pg']; 

	?>
	<script>
		var nome  = "<?php echo $nome?>";
		var email  = "<?php echo $email?>";
		if (nome == '' && email == ''){
			alert('Por favor, preencha todos os campos do formulário!'); 
			window.history.back();
		}

	</script>

	<?php 
	
	$agora = time();
	$data = getdate($agora);
	$dia_semana = $data[wday];
	$dia_mes = $data[mday];
	$mes = $data[mon];
	$ano = $data[year];
	switch ($dia_semana) {
		case 0:
			$dia_semana = "Domingo";
			break;
		case 1:
			$dia_semana = "Segunda-feira";
			break;
		case 2:
			$dia_semana = "Terça-feira";
			break;
		case 3:
			$dia_semana = "Quarta-feira";
			break;
		case 4:
			$dia_semana = "Quinta-feira";
			break;
		case 5:
			$dia_semana = "Sexta-feira";
			break;
		case 6:
			$dia_semana = "Sábado";
			break;
	}
	switch ($mes) {
		case 1:
			$mes = "Janeiro";
			break;
		case 2:
			$mes = "Fevereiro";
			break;
		case 3:
			$mes = "Março";
			break;
		case 4:
			$mes = "Abril";
			break;
		case 5:
			$mes = "Maio";
			break;
		case 6:
			$mes = "Junho";
			break;
		case 7:
			$mes = "Julho";
			break;
		case 8:
			$mes = "Agosto";
			break;
		case 9:
			$mes = "Setembro";
			break;
		case 10:
			$mes = "Outubro";
			break;
		case 11:
			$mes = "Novembro";
			break;
		case 12:
			$mes = "Dezembro";
			break;
	}
	$datap = $dia_semana . ', ' . $dia_mes . ' de ' . $mes . ' de ' . $ano;

	// $sql = "INSERT INTO cadastro_contato (contato_email, contato_nome, contato_telefone, contato_assunto, contato_mensagem) VALUES (:contato_email, :contato_nome, :contato_telefone, :contato_assunto, :contato_mensagem)";
	// $stmt = $PDO->prepare($sql);
	// $stmt->bindValue(':contato_email',$email);
	// $stmt->bindValue(':contato_nome',$nome);
	// $stmt->bindValue(':contato_telefone',$telefone);
	// $stmt->bindValue(':contato_assunto',$ass);
	// $stmt->bindValue(':contato_mensagem',$mensagem);
	// $stmt->execute();

	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	require("core/mod_includes/php/phpmailer/class.phpmailer.php");

	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP();
	$mail->Host = "smtp.tuttofresco.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)

	$mail->Username = 'autenticacao@tuttofresco.com.br'; // Usuário do servidor SMTP
	$mail->Password = 'tutto@fresco#2021'; // Senha do servidor SMTP
	$mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
	$mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
	$mail->SMTPAutoTLS = true;
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "$email"; // Seu e-mail
	$mail->Sender = "autenticacao@tuttofresco.com.br"; // Seu e-mail
	$mail->FromName = "$nome"; // Seu nome

	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAddress('marcelo@mogicomp.com.br');
	$mail->AddAddress('tico.komiyama@gmail.com');

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$assunto = 'Tutto Fresco - Formulário de Contato';
	$mail->Subject  = '=?utf-8?B?' . base64_encode($assunto) . '?='; // Assunto da mensagem
	$mail->Body = "
<head>
	<style type='text/css'>
		.margem 		{ padding-top:20px; padding-bottom:20px; padding-left:20px;padding-right:20px;}
		a:link 			{}
		a:visited 		{}
		a:hover 		{ text-decoration: underline; color:#2C4E67; }
		a:active 		{ text-decoration: none; }
		.texto			{ font-family:'Calibri'; color:#666; font-size:14px; text-align:justify; font-weight:normal;}
		hr				{ border:none; border-top:1px solid #2C4E67;}
		.rodape			{ font-family:Calibri; color:#727272; font-size:12px; text-align:justify; font-weight:normal; }
				
	</style>
</head>
<body>
	<table style='font-family:Calibri;' align='center' border='0' width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td align='left'>
			<table class='texto'>
				<tr>
					<td align='right'>
						<b>Nome:</b>
					</td>
					<td align='left'>$nome</td>
				</tr>
				<tr>
					<td align='right'>
						<b>E-mail:</b>
					</td>
					<td align='left'>
						$email
					</td>
				</tr>
				<tr>
					<td align='right'>
						<b>Telefone:</b>
					</td>
					<td align='left'>
						$telefone
					</td>
				</tr>
				<tr>
					<td align='right'>
						<b>Assunto:</b>
					</td>
					<td align='left'>
						$pagina
					</td>
				</tr>
			</table>
			<hr>
			<span class='rodape'>
				<font size='1' color='#2C4E67'><b>Mensagem enviada:</b></font> " . $datap . "<br>
				Este é um email gerado automaticamente pelo sistema.<br><br>
				As informações contidas nesta mensagem e nos arquivos anexados são para uso restrito, sendo seu sigilo protegido por lei, não havendo ainda garantia legal quanto à integridade de seu conteúdo. Caso não seja o destinatário, por favor desconsidere essa mensagem. O uso indevido dessas informações será tratado conforme as normas da empresa e a legislação em vigor.
			</font>
		</td>
	</tr>
	</table>
</body>
";
	/*$mail->AltBody = 'Este é o corpo da mensagem de teste, em Texto Plano! \r\n 
<IMG src="http://seudomínio.com.br/imagem.jpg" alt=":)"  class="wp-smiley"> ';*/

	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	// Exibe uma mensagem de resultado
	if ($enviado) {
		if ($pag == 'linha_food') {
			echo "
				<SCRIPT language='JavaScript'>
					abreMask(
					'<font color:#e5b35a><b>$nome</b></font>, recebemos o seu contato, fique a vontade para baixar nosso catálogo de produtos.<br><br>'+
					'<input value=\' Ok \' type=\'button\' class=\'but_mask\' onclick=javascript:window.location.href=\'catalogo_food.pdf\';>' );
				</SCRIPT>
			";
		}
		else if ($pag == 'linha_supermercado') {
			echo "
				<SCRIPT language='JavaScript'>
					abreMask(
					'<font color:#e5b35a><b>$nome</b></font>, recebemos o seu contato, fique a vontade para baixar nosso catálogo de produtos.<br><br>'+
					'<input value=\' Ok \' type=\'button\' class=\'but_mask\' onclick=javascript:window.location.href=\'catalogo_supermercado.pdf\';>' );
				</SCRIPT>
			";
		}
		else if ($pag == 'empresa') {
			echo "
			<SCRIPT language='JavaScript'>
				abreMask(
				'<font color:#e5b35a><b>$nome</b></font>, recebemos o seu contato, fique a vontade para baixar nossa apresentação.<br><br>'+
				'<input value=\' Ok \' type=\'button\' class=\'but_mask\' onclick=javascript:window.location.href=\'apresentacao.pdf\';>' );
			</SCRIPT>
			";
		} else {
			echo "
				<SCRIPT language='JavaScript'>
					abreMask(
					'<font color:#e5b35a><b>$nome</b></font>, recebemos o seu contato, em breve responderemos<br><br>'+
					'<input value=\' Ok \' type=\'button\' class=\'but_mask\' onclick=javascript:window.location.href=\'index.php\';>' );
				</SCRIPT>
			";
		}
	} else {
		echo "
			<SCRIPT language='JavaScript'>
				abreMask(
				'Erro ao enviar mensagem. <br>$mail->ErrorInfo.<br><br>'+
				'<input value=\' Ok \' type=\'button\' class=\'but_mask\' onclick=window.history.back();>' );
			</SCRIPT>
		";
	}

	?>
</body>

</html>