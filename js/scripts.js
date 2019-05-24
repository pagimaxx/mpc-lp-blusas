$(function() {
	
	$('.resultadoCalculo').hide();

	function formataDinheiro(n)
	{
		return "R$ " + n.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
	}

	function rolar_para(elemento) { 
		$('html, body').animate({ scrollTop: $(elemento).offset().top }, 2000); 
	}

	// scroll smooth
	$('a[href*="#"]:not([href="#"])').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	  	var target = $(this.hash);
	  	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	  	if (target.length) {
		    $('html, body').animate({
		      scrollTop: target.offset().top
		    }, 1000);
	    	return false;
	  	}
		}
	});

	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('#celular').mask(SPMaskBehavior, spOptions);

	$('#calcularPreco').click(function() 
	{	
		var nome = $('#nome').val();
		var email = $('#email').val();
		var celular = $('#celular').val();
		var raca = $('#raca').val();
		var porte = $('#porte').val();

		var celularLimpo = celular.replace("(", "").replace(")", "").replace("-", "").replace(" ", "").trim();
		console.log(celularLimpo);

		$.post("includes/site.controller.php", 
		{
			nome: nome, email: email, celular: celular,
			raca: raca, porte: porte, 
			acao: 'calcular'  
		}, 
			function(resposta) {					
				var resultado = JSON.parse(resposta);
				//console.log(resultado);
				sessionStorage.setItem("resultado", resultado);
				sessionStorage.setItem("IDRegistros", resultado.id[0]);
				sessionStorage.setItem("valorBase", resultado.valorBase[0]);
				sessionStorage.setItem("valorTotal", resultado.valorTotal[0]);
				sessionStorage.setItem("nome", nome);
				sessionStorage.setItem("email", email);				
				sessionStorage.setItem("ddd", celularLimpo.substring(0, 2));
				sessionStorage.setItem("telefone", celularLimpo.substring(2, 9));
				$('.resultadoCalculo').show();
				$('#resCalculo').html('<h1 class="text-center">O valor da blusa é ' + formataDinheiro(resultado.valorTotal) + '</h1>');
	    		rolar_para($('#exibeResultado'));
	    	}
	    );
	});

	$('#comprar').click(function() 
	{
		$('#myModal').modal();
		$('#nomeCliente').html($('#nome').val());
		$('#nomeAnimal').focus();
	});

	$('#finalizar').click(function() {

		// resgatar os dados do formulário
		var IDRegistros = sessionStorage.getItem('IDRegistros'); //console.log(IDRegistros);
		var nome = sessionStorage.getItem("nome"); //console.log(nome);
		var email = sessionStorage.getItem("email"); //console.log(email);
		var ddd = sessionStorage.getItem("ddd"); //console.log(ddd);
		var telefone = sessionStorage.getItem("telefone"); //console.log(telefone);
		var nomeAnimal = $('#nomeAnimal').val(); //console.log(nomeAnimal);
		var corCorpo = $('#ddlCorCorpo').val(); //console.log(corCorpo);
		var corDetalhes = $('#ddlCorDetalhes').val(); //console.log(corDetalhes);
		var corBordado = $('#ddlCorBordado').val(); //console.log(corBordado);
		var tamPescoco = $('#tamPescoco').val(); //console.log(tamPescoco);
		var tamTorax = $('#tamTorax').val(); //console.log(tamTorax);
		var tamComprimento = $('#tamComprimento').val(); //console.log(tamComprimento);
		var cep = $('#cep').val(); //console.log(cep);
		var numero = $('#numero').val(); //console.log(numero);
		var endereco = sessionStorage.getItem("endereco"); //console.log(endereco);		
		var complemento = $('#complemento').val(); //console.log(complemento);
		var bairro = sessionStorage.getItem("bairro"); //console.log(bairro);
		var cidade = sessionStorage.getItem("cidade"); //console.log(cidade);
		var estado = sessionStorage.getItem("estado"); //console.log(estado);
		var valorFrete = sessionStorage.getItem("valorFrete"); //console.log(valorFrete);
		var valorBase = sessionStorage.getItem("valorBase"); //console.log(valorBase);
		var valorTotal = sessionStorage.getItem("valorTotal"); //console.log(valorTotal);
		var acao = "fecharPedido";

		// enviar via post ao método
		$.post("includes/site.controller.php", 
		{
			IDRegistros: IDRegistros, nomeAnimal: nomeAnimal, 
			nome: nome, email: email, ddd: ddd, telefone: telefone, 
			corCorpo: corCorpo, corDetalhes: corDetalhes, corBordado: corBordado, 
			tamPescoco: tamPescoco, tamTorax: tamTorax, tamComprimento: tamComprimento,
			cep: cep, numero: numero, complemento: complemento, 
			endereco: endereco, bairro: bairro, cidade: cidade, estado: estado, 
			valorFrete: valorFrete, valorBase: valorBase, valorTotal: valorTotal, 
			acao: acao
		},
			function(resposta) {
				var resultado = JSON.parse(resposta);
				$('#myModal').modal('hide');
				swal(resultado.titulo, resultado.msg, resultado.tipo);
			}
		);

	});

	$('.thumbnail').click(function(){
	  	$('.modal-body').empty();
	  	var title = $(this).parent('a').attr("title");
	  	$('.modal-title').html(title);
	  	$($(this).parents('div').html()).appendTo('.modal-body');
	  	$('#myModal').modal({show:true});
	});

	$('#cep').change(function() {
		getEndereco($('#cep').val());
	});

	function getEndereco(cep) {
		console.log(cep);
	    if($.trim(cep) != ""){
	        $("#loading").show();
	        $.getScript("https://webservice.kinghost.net/web_cep.php?auth=34bf15ad429be1770ceeb120514d0707&formato=javascript&cep="+cep, function(){            
	            if (resultadoCEP["resultado"] != 0) {					
					
					$('#enderecoCompleto').html(unescape(resultadoCEP.logradouro)+"<br>" + unescape(resultadoCEP.bairro) + " - " + unescape(resultadoCEP.cidade) + " - " + unescape(resultadoCEP.uf));

					// sesison do endereco completo
					sessionStorage.setItem("endereco", unescape(resultadoCEP.logradouro));
					sessionStorage.setItem("bairro", unescape(resultadoCEP.bairro));
					sessionStorage.setItem("cidade", unescape(resultadoCEP.cidade));
					sessionStorage.setItem("estado", unescape(resultadoCEP.uf));

	            }else{
	                $("#loadingCep").html(unescape(resultadoCEP["resultado_txt"]));                
	            }            
	        });
			
			$.getScript("https://webservice.kinghost.net/web_frete.php?auth=34bf15ad429be1770ceeb120514d0707&tipo=sedex&formato=javascript&cep_origem=09403-380&cm_altura=10&cm_largura=30&cm_comprimento=15&cep_destino=" + cep + "&peso=386", function()
			{	
				//console.log(resultado);	
				
				if(resultado["resultado"] && resultado["valor"] != "")
				{
					var valor = resultado["valor"];
					var valor70perc = (valor / 10) * 7;
					//console.log(valor70perc);
					$('#valor_frete').val(valor70perc);
					sessionStorage.setItem("valorFrete", valor70perc);
					/*$("#txt_SEDEX").html("<b>R$ " + float2moeda(ValorCompartilhado) + "</b>");
					$("#valor_frete").val(unescape(ValorCompartilhado));	
					$('#texto_valor_frete').html("+ <b>R$ " + float2moeda(ValorCompartilhado) + "</b>");
					$('#texto_valor_frete_finalizacao').html("R$ " + float2moeda(ValorCompartilhado));*/

				}
				else {
					alert("Frete não calculado");
					return false;
				}
				
			});
			
	    }
	    else{
	        $("#loadingCep").html('Informe o CEP');
	    }
	}

});

