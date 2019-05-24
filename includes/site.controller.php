<?php
require 'site.model.php';

// iniciar classes
$cSite = new Site();

// resgate de variaveis
$acao = isset($_POST['acao']) ? $_POST['acao'] : 'none';

if ($acao == 'calcular')
{
	// retorna o valor base para calculo
	$cSite->reqValorBase($_POST['raca'], $_POST['porte']);
	$valorBase = $cSite->oValorBase;
	$valorTotal = $cSite->oValorTotal;

	if ($valorTotal != "")
	{	
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$celular = $_POST['celular'];
		$raca = $_POST['raca'];
		$porte = $_POST['porte'];

		$cSite->registrarCalculo($nome, $email, $celular, $raca, $porte, $valorTotal);
		$resultado = $cSite->oResultado;
		$status = $cSite->oStatusResultado;
		$IDRegistros = $cSite->oIDRegistros;
	}

	// retorno dos dados
	$retorno = array(
		"id"=>$IDRegistros,
		"resultado"=>$resultado,
		"status"=>$status,
		"valorBase"=>$valorBase,
		"valorTotal"=>$valorTotal
	);
	echo json_encode($retorno);

}

if ($acao == 'listarRacas')
{
	$retorno = $cSite->listarRacas("", "");
	echo json_encode($retorno);
}

if ($acao == 'fecharPedido')
{
	// resgatar os dados do formulário
	$nome = isset($_POST['nome']) ? $_POST['nome'] : "Não informado";
	$email = isset($_POST['email']) ? $_POST['email'] : "Não informado";
	$ddd = isset($_POST['ddd']) ? $_POST['ddd'] : "55";
	$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "Não informado";
	$IDRegistros = isset($_POST['IDRegistros']) ? $_POST['IDRegistros'] : "0";
	$nomeAnimal = isset($_POST['nomeAnimal']) ? $_POST['nomeAnimal'] : "Não informado";
	$corCorpo = isset($_POST['corCorpo']) ? $_POST['corCorpo'] : "0";
	$corDetalhes = isset($_POST['corDetalhes']) ? $_POST['corDetalhes'] : "0";
	$corBordado = isset($_POST['corBordado']) ? $_POST['corBordado'] : "0";
	$tamPescoco = isset($_POST['tamPescoco']) ? $_POST['tamPescoco'] : "0";
	$tamTorax = isset($_POST['tamTorax']) ? $_POST['tamTorax'] : "0";
	$tamComprimento = isset($_POST['tamComprimento']) ? $_POST['tamComprimento'] : "0";
	$cep = isset($_POST['cep']) ? $_POST['cep'] : "00000000";
	$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : "Não informado";
	$numero = isset($_POST['numero']) ? $_POST['numero'] : "Não informado";
	$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : "Não informado";
	$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : "Não informado";
	$estado = isset($_POST['estado']) ? $_POST['estado'] : "BR";
	$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : "Não informado";
	$valorFrete = isset($_POST['valorFrete']) ? $_POST['valorFrete'] : "0.0";
	$valorBase = isset($_POST['valorBase']) ? $_POST['valorBase'] : "0.0";
	$valorTotal = isset($_POST['valorTotal']) ? $_POST['valorTotal'] : "0.0";

	// registrar intenção
	$cSite->registrarIntencao($nomeAnimal, $corCorpo, $corDetalhes, $corBordado, $cep, $numero, $complemento, $valorFrete, $tamPescoco, $tamTorax, $tamComprimento, $IDRegistros);

	// retorno dos dados
	$retorno = array(
		"tipo"=>$cSite->oStatusResultado,
		"msg"=>$cSite->oResultado,
		"titulo"=>$cSite->oTitulo,
		"statusMsgEmail"=>$cSite->oMsgEmail
	);
	echo json_encode($retorno);

	/*require_once "../PagSeguroLibrary/PagSeguroLibrary.php";
	
	$pagseguro = new PagSeguroPaymentRequest();	

	// produto
	$pagseguro->addItem("1", "Blusa de moletom para Pet - ".$nomeAnimal, 1, $valorTotal, "300");
	
	// frete
	$pagseguro->addItem("0", "Frete", 1, $valorFrete, "0");

	// Itens PagSeguro
	$pagseguro->setCurrency('BRL');	
	$pagseguro->setReference(uniqid(true));	
	$pagseguro->setSender($nome, $email, $ddd, $telefone);
	$pagseguro->setShippingAddress($cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado, 'BRA');
	$pagseguro->setShippingType(3);*/

	/**
	 * Utilizar a classe AccountCredentials para adicionar as credencias
	 * Email cadastrado no pagseguro, e TOKEN gerado no pagseguro
	 */
	//$credenciais = new PagSeguroAccountCredentials('diego.oliveira@gmail.com', '719104C385974B2F903E36C1E75F257C');
	
	/**
	 * Adicionar as credenciais informada na classe AccountCredentials
	 * Com isso será gerado uma URL para o pagseguro
	 *
	 */
	//$url = $pagseguro->register($credenciais);
	
	//Agora vamos redirecionar para o PagSeguro
	/*header('Content-Type: text/html; charset=ISO-8859-1');
	header("Location: $url");*/
	//echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$url."'>";
	//$_SESSION['url_pagseguro'] = $url;
	//exit(0); 
}