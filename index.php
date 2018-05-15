<?php  
	require 'includes/conexao.php';
	require 'classes/classePessoa.php';
	require 'classes/classePessoaF.php';
	require 'classes/classePessoaJ.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>formulario</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		form{
			text-align: right;
		}
		#div-form{
			width: 300px;
			height: 100%;/*empurar info-debug para o rodape da pagina*/
		}
		#info-debug{
			color: red;
			float: right;
			position: fixed;
			bottom: 0;
			background: #bebebe;
			width: 100%;
		}
		.botao{
			display:inline-block;
			font-weight:400;
			text-align:center;
			white-space:nowrap;
			vertical-align:middle;
			-webkit-user-select:none;
			-moz-user-select:none;
			-ms-user-select:none;
			user-select:none;
			border:1px solid transparent;
			padding:.375rem .75rem;
			font-size:1rem;
			line-height:1.5;
			border-radius:.25rem;
			transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out
		}
		.botao:hover{
			background: #69ff71;
		}
		input{
			margin-bottom: 3px;
		}
		#lb-obs{
			margin-top: -50px;
		}
		#div-lista{
			float: right;
			margin-top: -400px;
		}
		table td{
			border: 1px solid #babaca;
		}
		i{
			color: red;
		}
		.ver{
			text-align:left;
		}
		.ver input{
			border: none;
		}
		.ver textarea{
			border: none;
		}
		.ver label{
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	<a href="./"><i class="fa fa-home"></i> inicio / home</a>
	<?php  
		$pessoa = new Pessoa('anonimo', '000', 'indigente');
		if (!isset($_POST['btn'])) {
			if (isset($_GET['update'])) {
				$pessoa->formularioUpdate($conex, $_GET['update']);
			}elseif (isset($_GET['ver'])) {
				$pessoa->ver($conex, $_GET['ver']);
			}else{
				echo "<h2>Cadastrar novo</h2>";
				$pessoa->formulario();
			}
		}else{
			echo "<div id='div-form'><a href='./'>voltar...</a></div>";
		}
		echo "<div id='div-lista'>";
			$pessoa->listarTudo($conex);
		echo "</div>";
	?>
	<div id="info-debug" >
		<?php 
			$debug = '...';
			// PRECIONOU BOTÃO cadastra pessoa...
			if (isset($_POST['btn'])) {
				$debug = "";
				//cadastra pessoa...
				if ($_POST['tipo'] == 'fisica') {
					$pessoa = new PessoaF($_POST['nome'], $_POST['rg'], $_POST['cpf'], $_POST['obs']);
					$pessoa->insere($conex);
					$debug .= "Cod ".$pessoa->cod." : ".$pessoa->getNome()." cadastrado com sucesso!!!";
				}
				if ($_POST['tipo'] == 'juridica') {
					//echo "<script>alert('entrou');</script>";
					$pessoa = new PessoaJ($_POST['nome'], $_POST['rg'], $_POST['cpf'], $_POST['obs']);
					$pessoa->insere($conex);
					$debug .= "Cod ".$pessoa->cod." : ".$pessoa->getNome()." cadastrado com sucesso!!!";
				}
			}
			if (isset($_POST['fisica'])) {
				$pessoa = new Pessoa('anonimo', '000', 'indigente');
				$pessoa->upDate($conex, $_POST['id'], $_POST['nome'], $_POST['rg'], $_POST['cpf'], $_POST['tipo'], $_POST['obs']);
			}
			if (isset($_POST['juridica'])) {
				$pessoa = new Pessoa('anonimo', '000', 'indigente');
				$pessoa->upDate($conex, $_POST['id'], $_POST['nome'], $_POST['rg'], $_POST['cnpj'], $_POST['tipo'], $_POST['obs']);
			}
			if (isset($_GET['excluir'])) {
				$pessoa = new Pessoa('anonimo', '000', 'indigente');
				$pessoa->excluir($conex, $_GET['excluir']);
			}
			echo $debug;
		?>
	</div>
</body>
</html>