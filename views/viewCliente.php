<?php 
	$id_cliente = $_GET['id'] ?? '';
	$acao = $_GET['acao'] ?? '';
	
	include_once("./controllers/controllerCliente.php");

	$controllerCliente = new ControllerCliente();
	$dadosDosCliente = null;
	$retornoAoSalvar = "";

	try {
		$botaoSubmitClicado = get_post_action('salvar', 'cancelar');

		if ($botaoSubmitClicado === 'salvar') {

			$retornoAoSalvar = $controllerCliente->salvarClienteAPartirDoCadastro($acao, $id_cliente);

			if ($retornoAoSalvar === "") {
				irParaListaDeClientes();
				exit;
			}
			else {
				$dadosDosCliente['nome'] = $_POST['nome'];
				$dadosDosCliente['rua'] = $_POST['rua'];
				$dadosDosCliente['numero'] = $_POST['numero'];
				$dadosDosCliente['cep'] = $_POST['cep'];
				$dadosDosCliente['bairro'] = $_POST['bairro'];
				$dadosDosCliente['cidade'] = $_POST['cidade'];
				$dadosDosCliente['uf'] = $_POST['uf'];
				$dadosDosCliente['data_nascimento'] = $_POST['data_nascimento'];				
			}
	    }
	    else if ($botaoSubmitClicado === 'cancelar') {
	    	irParaListaDeClientes();
		    exit;
	    }
	    else {
	    	$dadosDosCliente = $controllerCliente->buscarClientePorID($id_cliente);
	    }
	}
	finally {
		unset($controllerCliente);
	}
?>

<link href="./libs/estilosDoSistema.css" rel="stylesheet" />

<script type="text/javascript" src="./libs/funcoesJavaScript.js"></script>
<!-- <script type="text/javascript" src="./libs/jquery/jquery.mask.min.js"></script> -->
<!-- <script>
    $(document).ready(function(){
        $('.dataNascimento').mask('00/00/0000', {reverse: true});
    });
</script> -->

<!doctype html>
<html lang="pt-BR">
	<head>
    	<meta charset="UTF-8">
    	<title>Cliente</title>
	</head>

	<body>
		<div class="container jumbotron text-left">
			<h1 class="titulo01">Cliente</h1>

			<form method="post">

				<?php if ($retornoAoSalvar !== "") { ?>
					<div class="alert alert-danger"> <?php print $retornoAoSalvar ?> </div>
				<?php } ?>

				<div class="form-group">
					<label class="col-sm-2 control-label">Nome:</label>
					
					<div class="col-sm-10">
						<input
							class="form-control" 
							type="text" 
							id="nome" 
							name="nome" 
							value="<?php print $dadosDosCliente['nome']; ?>" 							
							maxlength="255" 							
						>
					</div>					
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Rua:</label>
					
					<div class="col-sm-10">
						<input 
							class="form-control" 
							type="text" 
							id="rua" 
							name="rua" 
							value="<?php print $dadosDosCliente['rua']; ?>" 							
							maxlength="255"							
						>
					</div>
				</div>
		
				<div class="form-group">
					<label class="col-sm-2 control-label">Número:</label>
						
					<div class="col-sm-10">
						<input 
							class="form-control" 
							type="text" 
							id="numero" 
							name="numero" 
							value="<?php print $dadosDosCliente['numero']; ?>" 							
							style="width:215px;" 
							maxlength="20" 							
						>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">CEP:</label>
						
					<div class="col-sm-10">
						<input 
							class="form-control" 
							type="text" 
							id="cep" 
							name="cep" 
							value="<?php print $dadosDosCliente['cep']; ?>" 
							style="width:110px;" 
							maxlength="8" 
							onkeypress="return event.charCode >= 48 && event.charCode <= 57"							
						>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Bairro:</label>
					
					<div class="col-sm-10">
						<input 
							class="form-control" 
							type="text" 
							id="bairro" 
							name="bairro" 
							value="<?php print $dadosDosCliente['bairro']; ?>" 							
							maxlength="255"
						>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Cidade:</label>
					
					<div class="col-sm-10">
						<input 
							class="form-control" 
							type="text" 
							id="cidade" 
							name="cidade" 
							value="<?php print $dadosDosCliente['cidade']; ?>" 							
							maxlength="255"
						>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">UF:</label>
					
					<?php $estados = arrayComOsEstadosBrasileiros(); ?>

					<div class="col-sm-10">
						<select id="uf" name="uf" class="form-control" style="width:160px;">
							<option value=""> Selecione </option>

							<?php for ($i=0; $i < count($estados); $i++) { ?>
								<option value="<?php print $estados[$i]; ?>"> <?php print $estados[$i]; ?> </option>	
							<?php } ?>

							<?php if ($dadosDosCliente['uf'] != '') { ?>
								<option selected="selected"> <?php print $dadosDosCliente['uf']; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Data de nascimento:</label>

					<div class="col-sm-2">
						<!-- Desta forma -->

						<input
							class="form-control" 
							type="text" 
							id="data_nascimento" 
							name="data_nascimento" 
							value="<?php print $dadosDosCliente['data_nascimento']; ?>" 
							style="width:160px;" 
							maxlength="10"
							onkeypress="mascaraData(this, event)"
						>
						
						<!-- Ou desta outra forma -->

						<!-- <input							
							class="dataNascimento" 
							id="data_nascimento" 
							name="data_nascimento" 
							value="<?php print $dadosDosCliente['data_nascimento']; ?>" 
							style="width:160px;" 
							maxlength="10" 
						> -->
					</div>	
				</div>

				<div class="form-group col-sm-12" style="margin-top: 30px;">
					<div class="col-sm-6">
						<button type="submit" class="col-sm-6 btn btn-success btn-block btn-lg" id="salvar" name="salvar" value="Salvar">							
							Salvar
						</button>
					</div>

					<div class="col-sm-6">
						<button type="submit" class="col-sm-6 btn btn-danger btn-block btn-lg" id="cancelar" name="cancelar" value="Cancelar">							
							Cancelar
						</button>
					</div>
				</div>
				
			</form>
		</div>
	</body>
</html>
