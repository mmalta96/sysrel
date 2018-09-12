<?php 
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "bd_sysrel";

	// Criar conexao
	$conexao = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conexao->connect_error) {
	    die("Connection failed: " . $conexao->connect_error);
	} 

	/* change character set to utf8 */
	if (!$conexao->set_charset("utf8")) {
	    printf("Error loading character set utf8: %s\n", $conexao->error);
	    exit();
	} 

?>