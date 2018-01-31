<?php

/*
	Arquivo de funções para uso geral na aplicação	
*/

function conexao() {
	require_once("./controllers/controllerConexaoMySQL.php");
	$controllerConexaoMySQL = new ControllerConexaoMySQL();
	return $controllerConexaoMySQL->getConnection();
}

function get_post_action($name) {
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}

function voltarUmaPagiana() {
    echo "<script> history.go(-1); </script>";
}

function irParaListaDeClientes() {
    header("Location: /site-1/index.php?modulo=clientes");
}

function validarCampoData($data){    
    if (strlen($data) !== 10) {
        return false;
        exit;
    }

    $data = explode("/", "$data"); //fatia a string $data em pedaços, usando / como referência

    $dia = $data[0];
    $mes = $data[1];
    $ano = $data[2];

    if ( (!is_numeric($dia)) || (!is_numeric($mes)) || (!is_numeric($ano))) {
        return false;
        exit;
    }

    if ( (strlen($data[0]) !== 2) || (strlen($data[1]) !== 2) || (strlen($data[2]) !== 4)) {    
        return false;
        exit;
    }

    return checkdate($mes, $dia, $ano);
}

function converterDataDaTelaParaBancoDeDados($data) {
    if ($data === '') {
        return null;
    }
    else {
        $data = explode("/", "$data"); //fatia a string $data em pedaços, usando / como referência

        $dia = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
        $mes = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
        $ano = filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);

        if (strlen($dia) === 1) {
            $dia = str_pad($dia, 1, '0', STR_PAD_LEFT);
        }

        if (strlen($mes) === 1) {
            $mes = str_pad($mes, 1, '0', STR_PAD_LEFT);
        }    
        
        return $ano.'-'.$mes.'-'.$dia;
    }
}

function converterDataDoBancoDeDadosParaTela($data) {
    if ($data === null) {
        return '';
    }
    else {
        $data = explode("-", "$data"); //fatia a string $data em pedaços, usando / como referência 

        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        
        return $dia.'/'.$mes.'/'.$ano;
    }
}

function arrayComOsEstadosBrasileiros() {
    return array(
        'AC',
        'AL',
        'AP',
        'AM',
        'BA',
        'CE',
        'DF',
        'ES',
        'GO',
        'MA',
        'MT',
        'MS',
        'MG',
        'PA',
        'PB',
        'PR',
        'PE',
        'PI',
        'RJ',
        'RN',
        'RS',
        'RO',
        'RR',
        'SC',
        'SP',
        'SE',
        'TO'
    );
}