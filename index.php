<?php
ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

// includes
require 'includes/site.model.php';

// variaveis
$fecharPedido = isset($_POST['fecharPedido']) ? $_POST['fecharPedido'] : '0';

// iniciar as classes
$cSite = new Site();

// verificar quem é a página

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Quer ter a certeza de comprar uma roupa ideal para o seu animal de estimação?">
	<meta name="keywords" content="">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<title>Roupas para Pet Sob Medida | Meu Pet Charmoso</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/sweetalert.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet">
	<link href="css/mpc.min.css" rel="stylesheet">
	<link href="css/aos.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<meta property="og:locale" content="pt_BR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Roupas para Pet Sob Medida | Meu Pet Charmoso" />
	<meta property="og:description" content="Quer ter a certeza de comprar uma roupa ideal para o seu animal de estimação?" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="Meu Pet Charmoso" />
	<meta property="article:section" content="" />
	<meta property="article:published_time" content="" />
	<meta property="article:modified_time" content="" />
	<meta property="og:updated_time" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:width" content="1255" />
	<meta property="og:image:height" content="500" />

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-custom" id="topo">
		<div class="container">

			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					Menu <i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" href=""><img src="img/logotipo.png" alt="Meu Pet"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="menu">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#comosaoasblusas">Como são as blusas</a>
						</li>
						<li>
							<a href="#depoimentos">Depoimentos</a>
						</li>
						<li>
							<a href="#faleconosco">Fale conosco</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>

	<section class="cabecalho">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 data-aos="fade-left">Cansado de comprar roupa errada para seu cão?</h1>
					<h2 data-aos="fade-left">Nós temos a solução ideal para você</h2>
				</div>
			</div>

		</div>

	</section>

	<section class="textoinicial">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<p>
						Quer ter a certeza de comprar uma <b>roupa ideal para o seu animal de estimação</b>?
					</p>
					<p>
						Geralmente ao <b>comprar uma roupa nova</b>, um dos principais problemas é o tamanho, podendo ficar muito grande ou muito pequeno.
						<b>Conheço várias pessoas</b> que me falaram sobre isso, e no fim a roupa acaba ficando de lado e seu dinheiro perdido.
					</p>
					<p>
						Já são <b>mais de 312 animais usando uma roupa perfeita</b>, e o principal <b>super confortáveis</b>.
						E agora você pode comprar, sem medo e sem dúvidas, pois nossa confecção é sob medida assim o seu animalzinho terá uma blusa exclusiva para ele.
					</p>
					<p>
						<b>Cada blusa como única para nós</b>, e os preços também, e tudo depende do tamanho, para ter uma ideia do valor <b>preencha o formulário e saiba o valor estimado</b>.
					</p>
				</div>
				<div class="col-md-6">
					<p>
						<form id="fQuantoCusta" method="post">
							<div class="form-group">
								<label>Seu nome</label>
								<input type="text" name="nome" id="nome" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Seu e-mail</label>
								<input type="email" name="email" id="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Celular (com DDD)</label>
								<input type="phone" name="celular" id="celular" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Raça</label>
								<select name="raca" id="raca" class="form-control">
									<option value="0">Escolha a raça</option>
									<?php
									foreach ($cSite->listarRacas("", "") as $row) {
										echo '<option value="' . $row['IDRaca'] . '">' . $row['Raca'] . '</option>\n';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Porte</label>
								<select name="porte" id="porte" class="form-control">
									<option value="0">Qual é o porte dele?</option>
									<option value="1">Pequeno</option>
									<option value="2">Médio</option>
									<option value="3">Grande</option>
								</select>
							</div>
							<div class="form-group">
								<button id="calcularPreco" onclick="return false;" class="btnpersonalizado">Calcular Preço</button>
							</div>
						</form>
						<p class="text-center">
							Ambiente 100% seguro, livre de SPAM
						</p>
					</p>
				</div>
			</div>

			<div class="row" id="exibeResultado">
				<div class="col-md-2">
				</div>

				<div class="col-md-8">
					<div class="resultadoCalculo">
						<span id="resCalculo"></span>
						<p class="text-center">Deseja comprar uma blusa perfeita para seu animal?</p>
						<form name="fDesejaComprar" id="fDesejaComprar" method="post">
							<div class="form-group">
								<button id="comprar" onclick="return false;" class="btnVerde">Sim, eu desejo comprar!</button>
							</div>
						</form>
					</div>
				</div>

				<div class="col-md-2">
				</div>

				<!-- Modal -->
				<div class="modal fade w800" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><img src="img/icone.png" alt="Icone">&nbsp;&nbsp;Comprar a blusa</h4>
							</div>
							<div class="modal-body">
								<p>Olá, <b><span id="nomeCliente"></span></b>! Fico feliz pelo seu interesse, e por isso tenho uma notícia para você, se comprar agora daremos <b>5% de desconto</b> na compra, o que acha?</p>
								<p>E para comprar é simples, é só preencha o formulário! E não se preocupe se não tem todas as informações, pois antes de fazer entraremos em contato para últimos ajustes. ;)</p>
								<form name="fEnviar" id="fEnviar" method="post">
									<fieldset>
										<legend>Formulário de compra</legend>
										<div class="form-group">
											<label>Nome do animal <small>(Esse é o nome que iremos bordar :))</small></label>
											<input type="text" name="nomeAnimal" id="nomeAnimal" class="form-control" required>
										</div>
										<div class="form-group">
											<p>
												<label>Cor do corpo</label><br>
												<select name="ddlCorCorpo" id="ddlCorCorpo" class="form-control">
													<option value="0">Escolha a cor</option>
													<?php
													foreach ($cSite->listarCores() as $row) {
														echo '<option value="' . $row['IDCores'] . '">' . $row['Cor'] . '</option>\n';
													}
													?>
												</select>
											</p>
											<p>
												<label>Cor dos detalhes <small>(Capuz, mangas e bolso)</small></label><br>
												<select name="ddlCorDetalhes" id="ddlCorDetalhes" class="form-control">
													<option value="0">Escolha a cor</option>
													<?php
													foreach ($cSite->listarCores() as $row) {
														echo '<option value="' . $row['IDCores'] . '">' . $row['Cor'] . '</option>\n';
													}
													?>
												</select>
											</p>
											<p>
												<label>Cor do bordado</label><br>
												<select name="ddlCorBordado" id="ddlCorBordado" class="form-control">
													<option value="0">Escolha a cor</option>
													<?php
													foreach ($cSite->listarCores() as $row) {
														echo '<option value="' . $row['IDCores'] . '">' . $row['Cor'] . '</option>\n';
													}
													?>
												</select>
											</p>
										</div>
										<div class="form-group">
											<label>Medidas <small>(Se não souber, não tem problema, após fechar o pedido, explico como tirar)</small></label><br>
											<div class="row">
												<div class="col-md-4">
													<input type="number" name="tamPescoco" id="tamPescoco" class="form-control" placeholder="Pescoço">
												</div>
												<div class="col-md-4">
													<input type="number" name="tamTorax" id="tamTorax" class="form-control" placeholder="Tórax">
												</div>
												<div class="col-md-4">
													<input type="number" name="tamComprimento" id="tamComprimento" class="form-control" placeholder="Do pescoço até o rabo">
												</div>
											</div>
										</div>

									</fieldset>

									<fieldset>
										<legend>Dados de entrega</legend>
										<div class="form-group col-md-4">
											<label>CEP</small></label>
											<input type="number" name="cep" id="cep" class="form-control" required>
										</div>
										<div class="form-group col-sm-12">
											<span id="enderecoCompleto"></span>
										</div>
										<div class="form-group col-sm-4">
											<label>Número</small></label>
											<input type="text" name="numero" id="numero" class="form-control" required>
										</div>
										<div class="form-group col-sm-12">
											<label>Complemento</small></label>
											<input type="text" name="complemento" id="complemento" class="form-control" required>
										</div>
									</fieldset>

									<div class="form-group">
										<input type="hidden" name="fecharPedido" id="fecharPedido" value="1">
										<p><button id="finalizar" class="btnVerde" onclick="return false;">Fechar pedido</button></p>
										<p class="text-center">
											<img src="img/lock.gif" alt="Seguro" />&nbsp;&nbsp;
											Você será direcionado para um ambiente 100% seguro
										</p>
									</div>

								</form>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="informacoes" id="comosaoasblusas">

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<hr class="small">
				</div>
				<div class="col-md-12">
					<h3 data-aos="fade-right">Como são as blusas?</h3>
				</div>

				<!--textos-->
				<div class="col-md-6">
					<p>Para que as roupas saiam perfeitas, nosso processo é semelhante à uma alfaitaria, toda a roupa é confeccionada à partir das medidas do animal, as medidas são pescoço, tórax e comprimento das costas.</p>
					<p class="text-center"><img src="img/medidas.png" alt="Medidas do corpo"></p>
					<p>Viu é super simples tirar as medidas e com elas as roupas são feitas.</p>
					<p>Temos diversas cores e você escolhe a combinação que mais gostar, a escolha da cor é feita durante o processo da compra.</p>
				</div>

				<!--imagens-->
				<div class="col-md-6">

					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<a href="img/blusa-azul.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-6">
									<img src="img/blusa-azul-peq.jpg" class="img-fluid">
								</a>
								<a href="img/blusa-verde.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-6">
									<img src="img/blusa-verde-peq.jpg" class="img-fluid">
								</a>
							</div>
							<div class="row">
								<a href="img/blusa-vermelha-01.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-6">
									<img src="img/blusa-vermelha-01-peq.jpg" class="img-fluid">
								</a>
								<a href="img/blusa-pink.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-6">
									<img src="img/blusa-pink-peq.jpg" class="img-fluid">
								</a>
							</div>

						</div>
					</div>

				</div>

				<div class="col-md-12 text-center">
					<hr class="small">
				</div>
			</div>
		</div>

	</section>

	<section class="dizemporai" id="depoimentos">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 data-aos="fade-right">Olha o que dizem sobre a Meu Pet Charmoso e seus produtos</h3>
				</div>
			</div>
			<div class="row text-center">
				<p>Quem comprou gostou, veja alguns depoimentos que o pessoal fez sobre nós.</p>
			</div>
			<div class="row">
				<div class="col-md-4" data-aos="fade-up">
					<iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fgabriela.azevedo.94043%2Fposts%2F888832197866609%3A0&width=100%" width="100%" height="354" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
				<div class="col-md-4" data-aos="fade-down">
					<iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fliliane.medeiros.54%2Fposts%2F1083775561668648%3A0&width=100%" width="100%" height="411" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
				<div class="col-md-4" data-aos="fade-up">
					<iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fpaloma.torres.9862%2Fposts%2F1055807987831198%3A0&width=100%" width="100%" height="373" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
				<div class="col-md-12 text-center">
					<p><small>Estes depoimentos, são avaliações feitas por nossos clientes em nossa página do <a href="https://facebook.com/meupetcharmoso">Facebook</a></small></p>
				</div>
				<div class="col-md-12 text-center">
					<hr class="small">
				</div>
			</div>
		</div>

	</section>

	<footer class="footer" id="faleconosco">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="col-md-2">
					</div>
					<div class="col-md-8">

						<h3 data-aos="fade-right">Deixe seu comentário</h3>

						<div id="disqus_thread"></div>
						<script>
							/**
							 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
							 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
							/*
							var disqus_config = function () {
							this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
							this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
							};
							*/
							(function() { // DON'T EDIT BELOW THIS LINE
								var d = document,
									s = d.createElement('script');
								s.src = 'https://meupetcharmoso.disqus.com/embed.js';
								s.setAttribute('data-timestamp', +new Date());
								(d.head || d.body).appendChild(s);
							})();
						</script>
						<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
					</div>
					<div class="col-md-2">
					</div>

				</div>

				<div class="col-md-12 text-center">
					<hr class="small">
				</div>

				<div class="col-md-12">
					<h3 data-aos="fade-right">Quer falar conosco?</h3>
				</div>
				<div class="col-md-6 text-center">
					<p>
						Por e-mail <a href="mailto:contato@meupetcharmoso.com.br"><b>contato@meupetcharmoso.com.br</b></a>
					</p>
				</div>
				<div class="col-md-6 text-center">
					<p>Por WhatsApp <b>11 99130-6333</b> &nbsp; <img src="img/whatsapp.png" alt="WhatsApp"></p>
				</div>
				<div class="col-md-12 text-center">
					<hr class="small">
					<p class="text-center">
						Todos os direitos reservados - <?php echo date('Y'); ?> - Site by <a href="http://pagimaxx.com" target="_blank">PAGIMAXX&reg;</a>
					</p>
				</div>
			</div>

		</div>

	</footer>

	<script src='js/jquery-1.11.0.min.js'></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.mask.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/scripts.js"></script>

	<script>
		AOS.init({
			easing: 'ease-out-back',
			duration: 1000
		});

		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox();
		});
	</script>

</body>

</html>