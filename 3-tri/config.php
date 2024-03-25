<?php 
	function conectar(): object{
		$usuario = "root";
		$senha = "";
		$conexao = new PDO("mysql:host=localhost; dbname=usuarios",$usuario,$senha);
		return $conexao;
	}