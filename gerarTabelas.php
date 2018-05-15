<?php  
	require 'includes/conexao.php';
	$conex->query("CREATE table IF NOT EXISTS pessoa(
		id bigint not null primary key auto_increment,
		nome varchar(64),
		rg varchar(32),
		tipo varchar(32)
		);")or die("ñ foi possivel gerar a tabela pessoa... ".mysqli_error($conex));

	$conex->query("CREATE table IF NOT EXISTS pessoaF(
		id bigint not null primary key auto_increment,		
		idPes bigint,
		foreign key(idPes) references pessoa(id),
		cpf int,
		obs varchar(1024)
		);")or die("ñ foi possivel gerar a tabela pessoaF... ".mysqli_error($conex));

	$conex->query("CREATE table IF NOT EXISTS pessoaJ(
		id bigint not null primary key auto_increment,		
		idPes bigint,
		foreign key(idPes) references pessoa(id),
		cnpj varchar(32),
		obs varchar(1024)
		);")or die("ñ foi possivel gerar a tabela pessoaJ... ".mysqli_error($conex));
	echo "<br />tabelas geradas com sucesso...<br />";
?>