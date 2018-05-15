<?php  
	/**
	* 
	*/
	class PessoaF extends Pessoa
	{
		protected $idPes; //chave estrangeira
		protected $obs;
		protected $cpf;
		
		public function __construct($nome, $rg, $cpf, $obs)
		{
			parent::__construct($nome, $rg, 'fisica');
			$this->cpf = $cpf;
			$this->obs = $obs;
		}
		public function insere($conex){
			parent::insere($conex);
			$conex->query("INSERT INTO pessoaF(idPes, cpf, obs) VALUES('".$this->cod."', '".$this->cpf."', '".$this->obs."');")or die("falha no cadastro ::: debug->".mysqli_error($conex));
			$this->idPes = $this->cod;
		}
	}
?>