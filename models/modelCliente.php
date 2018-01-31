<?php

class ModelCliente {

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
	
	public function buscarNoBancoClientePorID($id_cliente) {
		try {
			$sql = $this->select . ' 
				WHERE 
					id_cliente = :id_cliente 
			';

			$stmt = conexao()->prepare($sql);
    		
    		// desta forma
    		/*
			$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
			$stmt->execute();
			*/
			// ou destra outra forma
    		$stmt->execute(array(
    			':id_cliente' => $id_cliente
    		));
			
			return $stmt->fetchAll();
		}
		catch (PDOException $e) {
		    echo 'Erro: ' . $e->getMessage();
		}	
    }

    public function inserirCliente($parametros) {
    	$sql = ' 
    		INSERT INTO 
    			clientes (    				
					nome, 
					rua, 
					numero, 
					cep, 
					bairro, 
					cidade, 
					uf, 
					data_nascimento 
    			) 
    		VALUES 
    			(    				
					:nome, 
					:rua, 
					:numero, 
					:cep, 
					:bairro, 
					:cidade, 
					:uf, 
					:data_nascimento 
    			) 
    	';

    	try {
			$stmt = conexao()->prepare($sql);

			// desta forma
			/*
			$stmt->bindParam(':nome', $parametros['nome'], PDO::PARAM_STR);
			$stmt->bindParam(':rua', $parametros['rua'], PDO::PARAM_STR);
			$stmt->bindParam(':numero', $parametros['numero'], PDO::PARAM_STR);
			$stmt->bindParam(':cep', $parametros['cep'], PDO::PARAM_INT);
			$stmt->bindParam(':bairro', $parametros['bairro'], PDO::PARAM_STR);
			$stmt->bindParam(':cidade', $parametros['cidade'], PDO::PARAM_STR);
			$stmt->bindParam(':uf', $parametros['uf'], PDO::PARAM_STR);
			$stmt->bindParam(':data_nascimento', converterDataDaTelaParaBancoDeDados($parametros['data_nascimento']), PDO::PARAM_STR);
			$stmt->execute();
			*/
			// ou destra outra forma
			$stmt->execute(array(
				':nome' => $parametros['nome'], 
				':rua' => $parametros['rua'], 
				':numero' => $parametros['numero'], 
				':cep' => trim($parametros['cep']) == '' ? null : $parametros['cep'], 
				':bairro' => $parametros['bairro'], 
				':cidade' => $parametros['cidade'], 
				':uf' => $parametros['uf'], 
				':data_nascimento' => converterDataDaTelaParaBancoDeDados($parametros['data_nascimento']) 
			));
    	}
    	catch (PDOException $e) {
			echo 'Erro: ' . $e->getMessage();
		}
    }

    public function atualizarCliente($parametros) {
    	$sql = ' 
    		UPDATE 
    			clientes  
    		SET 
    			nome = :nome, 
    			rua = :rua, 
				numero = :numero, 
				cep = :cep, 
				bairro = :bairro, 
				cidade = :cidade, 
				uf = :uf, 
				data_nascimento = :data_nascimento 
    		WHERE 
    			id_cliente = :id_cliente 
    	';

    	try {
			$stmt = conexao()->prepare($sql);

			// desta forma
			/*
			$stmt->bindParam(':id_cliente', $parametros['id_cliente'], PDO::PARAM_INT);
			$stmt->bindParam(':nome', $parametros['nome'], PDO::PARAM_STR);
			$stmt->bindParam(':rua', $parametros['rua'], PDO::PARAM_STR);
			$stmt->bindParam(':numero', $parametros['numero'], PDO::PARAM_STR);
			$stmt->bindParam(':cep', $parametros['cep'], PDO::PARAM_INT);
			$stmt->bindParam(':bairro', $parametros['bairro'], PDO::PARAM_STR);
			$stmt->bindParam(':cidade', $parametros['cidade'], PDO::PARAM_STR);
			$stmt->bindParam(':uf', $parametros['uf'], PDO::PARAM_STR);
			$stmt->bindParam(':data_nascimento', converterDataDaTelaParaBancoDeDados($parametros['data_nascimento']), PDO::PARAM_STR);
			$stmt->execute();
			*/
			// ou destra outra forma			
			$stmt->execute(array(
				':id_cliente' => $parametros['id_cliente'],
				':nome' => $parametros['nome'], 
				':rua' => $parametros['rua'], 
				':numero' => $parametros['numero'], 
				':cep' => trim($parametros['cep']) == '' ? null : $parametros['cep'], 
				':bairro' => $parametros['bairro'], 
				':cidade' => $parametros['cidade'], 
				':uf' => $parametros['uf'], 
				':data_nascimento' => converterDataDaTelaParaBancoDeDados($parametros['data_nascimento']) 
			));
    	}
    	catch (PDOException $e) {
			echo 'Erro: ' . $e->getMessage();
		}
    }

    public function excluirCliente($id_cliente) {
    	$sql = ' 
    		DELETE FROM 
    			clientes 
    		WHERE  
    			id_cliente = :id_cliente 
    	';

    	try {
			$stmt = conexao()->prepare($sql);

			// desta forma
			/*
			$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
			$stmt->execute();
			*/
			// ou destra outra forma
			$stmt->execute(array(
				':id_cliente' => $id_cliente
			));
    	}
    	catch (PDOException $e) {
			echo 'Erro: ' . $e->getMessage();
		}
    }
}
