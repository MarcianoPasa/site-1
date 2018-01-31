<?php

class ViewModuloClientes {
	
	function __construct($acao, $id = '') {
		switch ($acao) {
			case 'novo':
				include_once("viewCliente.php");
				break;

			case 'editar':
				include_once("viewCliente.php");
				break;

			case 'excluir':
				$this->excluirCliente($id);
				break;

			default:
				include_once("viewClientes.php");
				break;
		}
	}

	private function excluirCliente($id = '') {
	
		include_once('./models/modelCliente.php');

		$modelCliente = new ModelCliente();
		try {
			$modelCliente->excluirCliente($id);
		}
		finally {
			unset($modelCliente);			
		}
	}
}
