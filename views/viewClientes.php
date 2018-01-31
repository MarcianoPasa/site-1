<?php
	include_once("./models/modelClientes.php");

	$modelClientes = new ModelClientes();
	$dadosDosClientes = null;

	try {
		$dadosDosClientes = $modelClientes->buscarTodosOsClientes();
	}
	finally {
		unset($modelClientes);
	}
?>

<link href="./libs/estilosDoSistema.css" rel="stylesheet" />

<script type="text/javascript">
	$(document).ready(function() {
		$('input[type=button]').click(function() {
		   	var idDoBotao = this.id;
		
			if (idDoBotao === "exlcuirCliente") {
				var idDaLinha = $(this).closest('tr').attr('id');

				$('#excluir01').modal('show');
				
				$('input[type=button]').click(function() {
					idDoBotao = this.id;

					if (idDoBotao === "excluirSim") {
						$.ajax({
							url: 'index.php?modulo=clientes&acao=excluir&id=' + idDaLinha,
							type: 'POST',
							data: { id: idDaLinha },
							dataType: 'html',
							error: function() {
								$('#erro01').modal('show');
							},
							success: function(data) {
								$("#" + idDaLinha).remove();
							}
						});

						$('#excluir01').modal('hide');
					}
				});
		   	}
	   });
	});
</script>

<!doctype html>
<html lang="pt-BR">
	<head>
    	<meta charset="UTF-8">
    	<title>Clientes</title>    	
	</head>

	<body>
		<form method="post">
			<div class="container jumbotron text-center">
				<h1 class="titulo01">Lista de clientes</h1>

				<p>
					<a href="index.php?modulo=clientes&acao=novo">						
						<input type="button" class="btn btn-primary btn-block btn-lg" value="Novo">						
						</input>
					</a>
				</p>

				<div class="table-responsive">
					<table class="table table-striped">
						<tr class="tr01">
					        <th class="col-sm-2"> ID </th>
					        <th class="col-sm-4"> Nome </th>
					        <th class="col-sm-3"> Cidade </th>
					        <th class="col-sm-1"> UF </th>
					        <th class="col-sm-1"> </th>
					        <th class="col-sm-1"> </th>
					    </tr>

					    <?php foreach ($dadosDosClientes as $linha) { ?>
						    <tr id="<?php print $linha['id_cliente']; ?>">
						        <td class="col-sm-2"> <?php print $linha['id_cliente']; ?> </td>
						        <td class="col-sm-4"> <?php print $linha['nome']; ?> </td>
						        <td class="col-sm-3"> <?php print $linha['cidade']; ?> </td>
						        <td class="col-sm-1"> <?php print $linha['uf']; ?> </td>

								<td class="col-sm-1">
									<a href="index.php?modulo=clientes&acao=editar&id=<?=$linha['id_cliente']?>">
										<input value="Editar" type="button" class="col-sm-6 btn btn-primary btn-block btn-lg">
										</input>
									</a>
								</td>

								<td class="col-sm-1">								
									<input id="exlcuirCliente" value="Excluir" type="button" class="col-sm-6 btn btn-danger btn-block btn-lg">
									</input>
								</td>

								<form method="post">
									<div class="modal fade" id="excluir01">
										<div class="modal-dialog">
									        <div class="modal-content">
											    <div class="modal-header">
													<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
													<h2 class="modal-title">Atenção</h2>
											    </div>
											    <div class="modal-body alinhaParaEsquerda">
													<p>Deseja excluir este registro?</p>
											    </div>
											    <div class="modal-footer">											    	
											    	<a>
														<input id="excluirSim" value="Sim" type="button" class="btn btn-danger"></input>
													</a>

													<a data-dismiss="modal">
														<input id="excluirNao" value="Não" type="button" class="btn btn-primary"></input>
													</a>
												</div>
											</div>
									    </div>
									</div>
								</form>

								<form method="post">
									<div class="modal fade" id="erro01">
										<div class="modal-dialog">
									        <div class="modal-content">
											    <div class="modal-header">
													<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
													<h2 class="modal-title">Atenção</h2>
											    </div>
											    <div class="modal-body alinhaParaEsquerda">
													<p>Erro ao excluir este registro!</p>
											    </div>
											    <div class="modal-footer">											    	
											    	<a data-dismiss="modal">
														<input id="erroAoExcluir" value="Ok" type="button" class="btn btn-primary"></input>
													</a>
												</div>
											</div>
									    </div>
									</div>
								</form>
						    </tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</form>
	</body>	
</html>
