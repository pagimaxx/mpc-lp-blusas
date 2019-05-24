<?php
require "conexao.php";
require "PHPMailerAutoload.php";
require "class.phpmailer.php";

// classe
class Site {

	public $oIDRaca;
	public $oRaca;
	public $oValorBase;
	public $oValorTotal;
	public $oTarefa;
	public $oResultado;
	public $oStatusResultado;
	public $oIDRegistros; 

	public function listarRacas($id, $filtro)
	{
		$query = "
		SELECT IDRaca, Raca, ValorBase
		  FROM raca 
		 WHERE Flg = 1
		";

		$p_sql = Conexao::getInstance()->prepare($query);
		$p_sql->execute();
		return $p_sql->fetchAll();
	}

	public function registrarCalculo($nome, $email, $celular, $raca, $porte, $valor)
	{
		$query = "
		call spMPCLP_RegistrarCalculo('".$nome."', '".$email."', '".$celular."', '".$raca."', '".$porte."', '".$valor."', 'inserir');
		";

		$p_sql = Conexao::getInstance()->prepare($query);
		$resultado = $p_sql->execute();

		if ($resultado)
		{
			$id = $p_sql->fetch();
			$this->oResultado = "OK";
			$this->oStatusResultado = "success";
			$this->oIDRegistros = $id;

		}
		else
		{
			$this->oResultado = "NOK";
			$this->oStatusResultado = "danger";
			$this->oIDRegistros = "0";
		}
	}

	public function reqValorBase($id, $porte)
	{
		$query = "
		SELECT ValorBase
		  FROM raca 
		 WHERE Flg = 1
		       AND IDRaca = ".$id."
		";

		$p_sql = Conexao::getInstance()->prepare($query);
		$p_sql->execute();
		$resultado = $p_sql->fetch();

		// valores de acrescimo no porte
		switch ($porte) {
			case '1':
				$acrescimo = '0';
				break;

			case '2':
				$acrescimo = '15';
				break;

			case '3':
				$acrescimo = '25';
				break;
			
			default:
				$acrescimo = '0';
				break;
		}

		$this->oValorBase = $resultado['ValorBase'];
		$this->oValorTotal = $resultado['ValorBase'] + $acrescimo;
	}

	public function listarCores()
	{
		$query = "
		SELECT IDCores, Cor, CSS, Img
		  FROM cores 
		 WHERE Flg = 1
		";

		$p_sql = Conexao::getInstance()->prepare($query);
		$p_sql->execute();
		return $p_sql->fetchAll();
	}

	public function registrarIntencao($nomeAnimal, $corCorpo, $corDetalhes, $corBordado, $cep, $numero, $complemento, $valorFrete, $pescoco, $torax, $comprimento, $idRegistros)
	{
		$query = "
		call spMPCLP_RegistrarIntencao(".$idRegistros.", '".$nomeAnimal."', '".$corCorpo."', '".$corDetalhes."', '".$corBordado."', '".$cep."', '".$numero."', '".$complemento."', '".$valorFrete."', '".$pescoco."', '".$torax."', '".$comprimento."', 'inserir');
		";

		$p_sql = Conexao::getInstance()->prepare($query);
		$resultado = $p_sql->execute();

		if ($resultado)
		{
			//$id = $p_sql->fetch();
			$this->oResultado = "Registrado com sucesso, aguarde que em breve nossos representantes irão falar com você.";
			$this->oStatusResultado = "success";
			$this->oTitulo = "Parabéns, agora falta pouco";
			//$this->oIDRegistros = $id;

			$ConteudoDoEmail = '
			Foi registrada nova intenção de compra, verifique o sistema.			
			';

			$mail = new PHPMailer();
			$mail->SetLanguage("br"); // idioma português Brasil
			$mail->IsSMTP(); // Define que a mensagem será SMTP
			$mail->Host = "smtp.meupetcharmoso.com.br"; // Seu endereço de host SMTP
			$mail->SMTPAuth = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
			$mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
			$mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
			$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
			$mail->Username = 'enviar@meupetcharmoso.com.br'; // Conta de email existente e ativa em seu domínio
			$mail->Password = 'm3up3tcharmoso'; // Senha da sua conta de email
			
			$mail->Sender = "enviar@meupetcharmoso.com.br"; // Conta de email existente e ativa em seu domínio
			$mail->From = "contato@meupetcharmoso.com.br"; // Sua conta de email que será remetente da mensagem
			$mail->FromName = "Meu Pet Charmoso"; // Nome da conta de email
			
			# Para confirmar que o email será enviado como HTML
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';
					
			# Assunto a ser abordado
			$mail->Subject = "Intenção de compra";
					
			# Corpo do E-mail
			$mail->Body = $ConteudoDoEmail;
					
			# Enviado para email padrao			
			$mail->AddAddress("diego.oliveira@gmail.com", 'Diego Oliveira');
			
			# Email do usuario que criou
			//$mail->AddAddress($email);
			
			// verifica se o e-mail foi enviado
			if(!$mail->Send())					
				$this->oMsgEmail = 'OK';
			else
				$this->oMsgEmail = 'NOK';

			$mail->ClearAllRecipients();
		}
		else
		{
			$this->oResultado = "Houve um erro ao realizar seu cadastro, por favor, poderia refazer?";
			$this->oStatusResultado = "danger";
			$this->oTitulo = "Ops";
		}
	}


}