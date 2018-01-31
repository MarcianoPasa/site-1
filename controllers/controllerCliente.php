<?php  
	
include_once('./models/modelCliente.php');

class ControllerCliente {

	public function buscarClientePorID($id_cliente) {
        $modelCliente = new ModelCliente();
        $cliente = array();

        try {
	        $retorno = $modelCliente->buscarNoBancoClientePorID($id_cliente);
	        
			if (count($retorno)) {
				foreach($retorno as $linha) {
			    	$cliente = [ 
			    		'id_cliente' => $linha['id_cliente'], 
			    		'nome' => $linha['nome'], 
			    		'rua' => $linha['rua'], 
						'numero' => $linha['numero'], 
						'cep' => $linha['cep'], 
						'bairro' => $linha['bairro'], 
						'cidade' => $linha['cidade'], 
						'uf' => $linha['uf'], 
						'data_nascimento' => converterDataDoBancoDeDadosParaTela($linha['data_nascimento'])
			    	];
			    }		   
			} 
			else {
				$cliente = null;
			}
		}
		finally {
			unset($modelCliente);
			unset($retorno);
		}

		return $cliente;
    }

    public function salvarClienteAPartirDoCadastro($acao, $id_cliente) {

		$modelCliente = new ModelCliente();		

		try {
			$parametros = array(
				'id_cliente' => trim($id_cliente), 
	    		'nome' => trim($_POST['nome']), 
	    		'rua' => trim($_POST['rua']), 
				'numero' => trim($_POST['numero']), 
				'cep' => trim($_POST['cep']), 
				'bairro' => trim($_POST['bairro']), 
				'cidade' => trim($_POST['cidade']), 
				'uf' => $_POST['uf'], 
				'data_nascimento' => trim($_POST['data_nascimento']) 
	    	);

	    	$mensagemDeValidacao = $this->validarCamposDoCadastroDeCliente($parametros);

			if ($mensagemDeValidacao === "") {
				if ($acao == 'novo') {
					$modelCliente->inserirCliente($parametros);
				}
				else {
					$modelCliente->atualizarCliente($parametros);	
				}

				return "";
			}
			else {
				return $mensagemDeValidacao;
			}
		}
		finally {
			unset($parametros);
			unset($modelCliente);
		}
    }

    private function validarCamposDoCadastroDeCliente($parametros) {
    	$retorno = "";

    	if ($parametros['nome'] === '') {
    		$retorno = 'o nome';    		
    	}
    	else if ($parametros['rua'] === '') {
    		$retorno = 'a rua';    		
    	}
    	else if ($parametros['cep'] === '') {
    		$retorno = 'o CEP';    		
    	}
    	else if ($parametros['bairro'] === '') {
    		$retorno = 'o bairro';
    	}
    	else if ($parametros['cidade'] === '') {
    		$retorno = 'a cidade';    		
    	}
    	else if ($parametros['uf'] === '') {
    		$retorno = 'a UF';    		
    	}
    	else if ($parametros['data_nascimento'] === '') {
    		$retorno = 'a data de nascimento';    		
    	}
    	

    	if ($retorno !== '') {
    		$retorno = 'É necessário informar ' . $retorno . ' do cliente.';    	
    	}
    	else if (!validarCampoData($parametros['data_nascimento'])) {
    		$retorno = 'A data de nascimento informada é inválida';    		
    	}

    	return $retorno;    
    }
}
