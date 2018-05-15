<?php
	/**
	  * classe principal Pessoa
	  */
	  class Pessoa
	  {
	  	protected $nome;
	  	protected $rg;
	  	protected $tipo;
	  	
	  	function __construct($nome, $rg, $tipo)
	  	{
	  		$this->cod = 0;
	  		$this->nome = $nome;
	  		$this->rg = $rg;
	  		$this->tipo = $tipo;
	  	}
	  	function getCod (){
	  		return $this->cod;
	  	}
	  	function getNome (){
	  		return $this->nome;
	  	}
	  	function insere($conex){
	  		$conex->query("INSERT INTO pessoa(nome, rg, tipo) VALUES('".$this->nome."',  '".$this->rg."',  '".$this->tipo."');")or die("falha no cadastro ::: debug->".mysqli_error($conex));
	  		$this->cod = $conex->insert_id;
	  		echo "<script>alert('cadastro realizado com sucesso...');</script>";
	  	}
	  	function formulario(){
	  		echo "<div id='div-form'>";
	  		?>
				<form method="POST" action="#">
					<label for="nome">nome</label> <input type="text" name="nome" id="nome" placeholder="digite seu nome aqui...."><br>
					<label for="rg">Rg</label> <input type="number" name="rg" id="rg"><br>
					<label for="cpf">CPF / CNPJ</label> <input type="number" name="cpf" id="cpf"><br>
					<label for="fis">Fisica</label><input type="radio" name="tipo" id="fis" value="fisica"> &nbsp;&nbsp;&nbsp; <label for="jur">Juridica</label><input type="radio" name="tipo" id="jur" value="juridica"><br />
					<label for="obs" id="lb-obs">Obs:</label><textarea cols="35" rows="5" name="obs" id="obs"></textarea>
					<input type="submit" name="btn" value="ENVIAR" class="botao">
				</form>
				<div style="width: 100%; height: 20px;"></div><!-- para o debug do rodape ficar por cima, sobreposto a isto.... -->
	  		<?php
	  		echo "</div>";
	  	}
	  	function formularioUpdate($conex, $id){
	  		echo "<h1>Atualizar / upDate...</h1>";
	  		//$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaF ON(pessoa.id = pessoaF.idPes) WHERE idPes = '".$id."'");
	  		$queryTipo = $conex->query("SELECT * FROM pessoa WHERE id = '".$id."'");
	  		$tipo = $queryTipo->fetch_object();
	  		if ($tipo->tipo == 'fisica') {
	  			$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaF ON(pessoa.id = pessoaF.idPes) WHERE idPes = '".$id."'");
	  			$obj = $query->fetch_object();
	  			echo "<div id='div-form'>";
		  		?>
					<form method="POST" action="#">
						<input type="number" name="id" style="display: none;" value="<?= $id; ?>">
						<label for="nome">nome</label> <input type="text" name="nome" id="nome" value="<?= $obj->nome; ?>"><br>
						<label for="rg">Rg</label> <input type="number" name="rg" id="rg" value="<?= $obj->rg; ?>"><br>
						<label for="cpf">CPF</label> <input type="number" name="cpf" id="cpf" value="<?= $obj->cpf; ?>"><br>
						<label for="fis">Fisica</label><input type="radio" name="tipo" id="fis" value="fisica" checked> <!--&nbsp;&nbsp;&nbsp; <label for="jur">Juridica</label><input type="radio" name="tipo" id="jur" value="juridica"--><br />
						<label for="obs" id="lb-obs">Obs:</label><textarea cols="35" rows="5" name="obs" id="obs"><?= $obj->obs; ?></textarea>
						<input type="submit" name="fisica" value="atualizarFisica" class="botao">
					</form>
					<div style="width: 100%; height: 20px;"></div><!-- para o debug do rodape ficar por cima, sobreposto a isto.... -->
		  		<?php
		  		echo "</div>";
	  		}
	  		if ($tipo->tipo == 'juridica') {
	  			$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaJ ON(pessoa.id = pessoaJ.idPes) WHERE idPes = '".$id."'");
	  			$obj = $query->fetch_object();
	  			echo "<div id='div-form'>";
		  		?>
					<form method="POST" action="#">
						<input type="number" name="id" style="display: none;" value="<?= $id; ?>">
						<label for="nome">nome</label> <input type="text" name="nome" id="nome" value="<?= $obj->nome; ?>"><br>
						<label for="rg">Rg</label> <input type="number" name="rg" id="rg" value="<?= $obj->rg; ?>"><br>
						<label for="cnpj">CNPJ</label> <input type="number" name="cnpj" id="cnpj" value="<?= $obj->cnpj; ?>"><br>
						<!--label for="fis">Fisica</label><input type="radio" name="tipo" id="fis" value="fisica" > &nbsp;&nbsp;&nbsp; --><label for="jur">Juridica</label><input type="radio" name="tipo" id="jur" value="juridica" checked><br />
						<label for="obs" id="lb-obs">Obs:</label><textarea cols="35" rows="5" name="obs" id="obs"><?= $obj->obs; ?></textarea>
						<input type="submit" name="juridica" value="atualizarJuridica" class="botao">
					</form>
					<div style="width: 100%; height: 20px;"></div><!-- para o debug do rodape ficar por cima, sobreposto a isto.... -->
		  		<?php
		  		echo "</div>";
	  		}		  		
	  	}
	  	function ver($conex, $id){
	  		echo "<h1>Ver registro...</h1>";
	  		//$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaF ON(pessoa.id = pessoaF.idPes) WHERE idPes = '".$id."'");
	  		$queryTipo = $conex->query("SELECT * FROM pessoa WHERE id = '".$id."'");
	  		$tipo = $queryTipo->fetch_object();
	  		if ($tipo->tipo == 'fisica') {
	  			$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaF ON(pessoa.id = pessoaF.idPes) WHERE idPes = '".$id."'");
	  			$obj = $query->fetch_object();
	  			echo "<div id='div-form'>";
		  		?>
					<form method="POST" action="#" class="ver">
						<input type="number" name="id" style="display: none;" value="<?= $id; ?>">
						<label for="nome">nome</label> <input type="text" name="nome" id="nome" value="<?= $obj->nome; ?>"><br>
						<label for="rg">Rg</label> <input type="number" name="rg" id="rg" value="<?= $obj->rg; ?>"><br>
						<label for="cpf">CPF</label> <input type="number" name="cpf" id="cpf" value="<?= $obj->cpf; ?>"><br>
						<label for="fis">Regime Pessoa Fisica</label><!--input type="radio" name="tipo" id="fis" value="fisica" checked--> <!--&nbsp;&nbsp;&nbsp; <label for="jur">Juridica</label><input type="radio" name="tipo" id="jur" value="juridica"--><br />Obs:<br />
						<!--label for="obs" id="lb-obs">Obs:</label--><textarea cols="35" rows="5" name="obs" id="obs"><?= $obj->obs; ?></textarea>
						<!--input type="submit" name="fisica" value="atualizarFisica" class="botao"-->
					</form>
					<div style="width: 100%; height: 20px;"></div><!-- para o debug do rodape ficar por cima, sobreposto a isto.... -->
		  		<?php
		  		echo "</div>";
	  		}
	  		if ($tipo->tipo == 'juridica') {
	  			$query = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaJ ON(pessoa.id = pessoaJ.idPes) WHERE idPes = '".$id."'");
	  			$obj = $query->fetch_object();
	  			echo "<div id='div-form'>";
		  		?>
					<form method="POST" action="#" class="ver">
						<input type="number" name="id" style="display: none;" value="<?= $id; ?>">
						<label for="nome">nome</label> <input type="text" name="nome" id="nome" value="<?= $obj->nome; ?>"><br>
						<label for="rg">Rg</label> <input type="number" name="rg" id="rg" value="<?= $obj->rg; ?>"><br>
						<label for="cnpj">CNPJ</label> <input type="number" name="cnpj" id="cnpj" value="<?= $obj->cnpj; ?>"><br>Obs:<br />
						<!--label for="fis">Fisica</label><input type="radio" name="tipo" id="fis" value="fisica" > &nbsp;&nbsp;&nbsp; --><label for="jur">pessoa Juridica</label><!--input type="radio" name="tipo" id="jur" value="juridica" checked--><br />
						<!--label for="obs" id="lb-obs">Obs:</label--><textarea cols="35" rows="5" name="obs" id="obs"><?= $obj->obs; ?></textarea>
						<!--input type="submit" name="juridica" value="atualizarJuridica" class="botao"-->
					</form>
					<div style="width: 100%; height: 20px;"></div><!-- para o debug do rodape ficar por cima, sobreposto a isto.... -->
		  		<?php
		  		echo "</div>";
	  		}
	  	}
	  	function upDate($conex, $id, $nome, $rg, $num, $tipo, $obs){
	  		#continuar aqui 
	  		if ($tipo == 'fisica') {	  			
	  			$upPesf = $conex->query("UPDATE pessoaF SET cpf = '".$num."', obs = '".$obs."' WHERE idPes = '".$id."'") or die("ñ foi possivel atualizar tabela pessoaF... ".mysqli_error($conex));
	  			$upPes = $conex->query("UPDATE pessoa SET nome = '".$nome."', rg = '".$rg."' WHERE id = '".$id."'")or die("ñ foi possivel atualizar registro pessoa... ".mysqli_error($conex));
	  			echo "pessoa fisica atualizada com sucesso: <small>".$id." ". $nome." ". $rg." ". $num." ". $tipo." ". $obs."</small>";
	  		}
	  		if ($tipo == 'juridica') {
	  			$upPesj = $conex->query("UPDATE pessoaJ SET cnpj = '".$num."', obs = '".$obs."' WHERE idPes = '".$id."'")or die("ñ foi possivel atualizar tabela pessoaJ...".mysqli_error($conex));
	  			$upPes = $conex->query("UPDATE pessoa SET nome = '".$nome."', rg = '".$rg."' WHERE id = '".$id."'")or die("ñ foi possivel atualizar registro pessoa... ".mysqli_error($conex));
	  			echo "pessoa juridica atualizada com sucesso: <small>".$id." ". $nome." ". $rg." ". $num." ". $tipo." ". $obs."</small>";
	  		}
	  	}
	  	function excluir($conex, $id){
	  		$fis = $conex->query("DELETE FROM pessoaF WHERE idPes = '".$id."'")or die("ñ foi possivel excluir registro...");
	  		//echo " ".mysqli_num_rows($fis);
	  		$conex->query("DELETE FROM pessoaJ WHERE idPes = '".$id."'")or die("ñ foi possivel excluir registro...");
	  		//echo " ".$conex->num_rows;
	  		$conex->query("DELETE FROM pessoa WHERE id = '".$id."'")or die("ñ foi possivel excluir registro...");
	  		//echo " ".$conex->num_rows;
	  		echo "<script>alert('registro deletado com sucesso...');</script>";
	  	}
	  	function listarTudo($conex){
	  		$fisica = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaF ON(pessoa.id = pessoaF.idPes)");
	  		if ($fisica) {
	  			echo "<h3>Registos pessoa fisica...</h3>";
	  			echo "<table>";
	  			echo "<tr><td>id</td><td>id CPF</td><td>nome</td><td>RG</td><td>CPF</td><td>obs</td></tr>";
	  			while ($obj = $fisica->fetch_object()) {
	  				//if ($obj->tipo == 'fisica') {
	  					echo "<tr><td>".$obj->idPes."</td><td>".$obj->id."</td><td>".$obj->nome."</td><td>".$obj->rg."</td><td>".$obj->cpf."</td><td>".substr($obj->obs, 0, 64)."</td><td><button value='".$obj->idPes."' onclick='window.location.href = `./?update=".$obj->idPes."`'>UpDate</button></td><td><a href='./?excluir=".$obj->idPes."'><i class='fa fa-trash'></i></a></td><td><a href='./?ver=".$obj->idPes."'><i class='	fa fa-eye'></i></a></td></tr>";
	  				//}		  				
	  			}
	  			echo "</table>";
	  		}
	  		$juridica = $conex->query("SELECT * FROM pessoa INNER JOIN pessoaJ ON(pessoa.id = pessoaJ.idPes)");
	  		if ($juridica) {
	  			echo "<h3>Registros pessoa juridica...</h3>";
	  			echo "<table>";
	  			echo "<tr><td>id</td><td>id CNPJ</td><td>nome</td><td>RG</td><td>CNPJ</td><td>obs</td></tr>";
	  			while ($jur = $juridica->fetch_object()) {
	  				echo "<tr><td>".$jur->idPes."</td><td>".$jur->id."</td><td>".$jur->nome."</td><td>".$jur->rg."</td><td>".$jur->cnpj."</td><td>".substr($jur->obs, 0, 64)."</td><td><button value='".$jur->idPes."' onclick='window.location.href = `./?update=".$jur->idPes."`'>UpDate</button></td><td><a href='./?excluir=".$jur->idPes."'><i class='fa fa-trash'></i></a></td><td><a href='./?ver=".$jur->idPes."'><i class='	fa fa-eye'></i></a></td></tr>";
	  			}
	  			echo "</table>";
	  		}
	  	}
	  }
?>