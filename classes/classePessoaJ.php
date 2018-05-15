<?php  
	/**
	* 
	*/
	class PessoaJ extends Pessoa
	{
		protected $idPes; //chave estrangeira
		protected $obs;
		protected $cnpj;
		
		public function __construct($nome, $rg, $cnpj, $obs)
		{
			parent::__construct($nome, $rg, 'juridica');
			$this->cnpj = $cnpj;
			$this->obs = $obs;
		}
		public function insere($conex){
			parent::insere($conex);
			$conex->query("INSERT INTO pessoaJ(idPes, cnpj, obs) VALUES('".$this->cod."', '".$this->cnpj."', '".$this->obs."');")or die("falha no cadastro ::: debug->".mysqli_error($conex));
			$this->idPes = $this->cod;
		}
	}
?>