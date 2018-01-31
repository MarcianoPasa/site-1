<?php

class ModelClientes {

	private $select = ' 
		SELECT 
			id_cliente, 
			nome, 
			rua, 
			numero, 
			cep, 
			bairro, 
			cidade, 
			uf, 
			data_nascimento 
		FROM 
			clientes
	';
	
	public function buscarTodosOsClientes() {
		$orderBy = ' ORDER BY nome ';
        $stmt = conexao()->prepare($this->select.$orderBy);
        $stmt->execute();
        return $stmt;
    }
}
