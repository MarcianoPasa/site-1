<?php

include_once("./libs/funcoes.php");

// chamando o bootstrap para que valha para o site inteiro
print '<link rel="stylesheet" type="text/css" href="libs/bootstrap/bootstrap.css">';
print '<script src="libs/jquery/jquery-3.2.1.min.js"></script>';
print '<script src="libs/bootstrap/bootstrap.min.js"></script>';

// Forma clássica de programar
/*
if (isset($_GET['modulo'])) {
	$modulo = $_GET['modulo'];
}
else {
	$modulo = '';
}
*/

// forma utilizada para a versão anterior ao php 7
// $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';

// forma para o php 7
$modulo = $_GET['modulo'] ?? '';
$acao = $_GET['acao'] ?? '';
$id = $_GET['id'] ?? '';

switch ($modulo) {
	case "clientes":
		include_once('views/viewModuloClientes.php');
		$viewModuloClientes = new ViewModuloClientes($acao, $id);	
		break;

	default:
		include_once("viewPaginaInicial.php");
		break;
}
