<?php 

namespace App\Models;

 use MF\Model\Model;


 class Aluno extends Model{

 	private $idAluno;

 	private $nome;

 	private $codigo;

 	private $situacao;

 	private $cep;

 	private $bairro;
 	
 	private $logradouro;
 	
 	private $cidade;

 	private $estado;

 	private $dataMatricula;

 	private $turma;

 	private $curso;

 	private $img;



 	public function __get($atributo){
 
      return $this->$atributo;


 	}

 	public function __set($atributo,$valor){

 		$this->$atributo = $valor;

 	}

 	public function salvar (){

 			$query = "insert into alunos(nome,codigo,situacao,cep,bairro,logradouro,cidade,estado,turma,curso,img,dataMatricula) values (:nome,:codigo,:situacao,:cep,:bairro,:logradouro,:cidade,:estado,:turma,:curso,:img,now())";  
 			$stmt  = $this->db->prepare($query);
 			$stmt->bindValue(':nome', $this->__get('nome'));
 			$stmt->bindValue(':codigo', $this->__get('codigo'));
 			$stmt->bindValue(':situacao', $this->__get('situacao'));
 			$stmt->bindValue(':cep', $this->__get('cep'));
 			$stmt->bindValue(':bairro', $this->__get('bairro'));
 			$stmt->bindValue(':logradouro', $this->__get('logradouro'));
 			$stmt->bindValue(':cidade', $this->__get('cidade'));
 			$stmt->bindValue(':estado', $this->__get('estado'));
 			$stmt->bindValue(':turma', $this->__get('turma'));
 			$stmt->bindValue(':curso', $this->__get('curso'));
 			$stmt->bindValue(':img', $this->__get('img'));

 			$stmt->execute();

 			return $this;


 	}

 	public function editar (){

 			$query = "UPDATE  alunos 
 			SET nome       =:nome, 
 				codigo     =:codigo,
 				situacao   =:situacao,
 				cep        =:cep,
 				bairro     =:bairro,
 				logradouro =:logradouro,
 				cidade     =:cidade,
 				estado     =:estado,
 				turma      =:turma,
 				curso      =:curso,
 				img        =:img
 			where idAluno  =:idAluno";  
 			$stmt  = $this->db->prepare($query);
 			$stmt->bindValue(':nome', $this->__get('nome'));
 			$stmt->bindValue(':codigo', $this->__get('codigo'));
 			$stmt->bindValue(':situacao', $this->__get('situacao'));
 			$stmt->bindValue(':cep', $this->__get('cep'));
 			$stmt->bindValue(':bairro', $this->__get('bairro'));
 			$stmt->bindValue(':logradouro', $this->__get('logradouro'));
 			$stmt->bindValue(':cidade', $this->__get('cidade'));
 			$stmt->bindValue(':estado', $this->__get('estado'));
 			$stmt->bindValue(':turma', $this->__get('turma'));
 			$stmt->bindValue(':curso', $this->__get('curso'));
 			$stmt->bindValue(':img', $this->__get('img'));
 			$stmt->bindValue(':idAluno', $this->__get('idAluno'));
 			$stmt->execute();

 			return $this;


 	}


 	public function validarCadastro(){

 		$valido = true;


 		if( strlen($this->__get('nome')) <3  ||   !is_numeric($this->__get('codigo'))
 	       ||   strlen($this->__get('situacao')) <3 ) {
 		$valido = false;

 		}


 		return $valido;



 	}

 	

 	public function getAllAluno(){

 		$query = "select nome,codigo from alunos";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':nome',$this->__get('nome'));
 		$stmt->bindValue(':codigo',$this->__get('nome'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 	}


 	public function getPorPagina($limit,$offset){

 		$query = "select nome,codigo from alunos
 		order by nome
 		limit
 			 $limit
 		offset
 			  $offset		 

 		";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':nome',$this->__get('nome'));
 		$stmt->bindValue(':codigo',$this->__get('nome'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 	}


 	public function getTotalRegitro(){

 		$query = "select count(*) as total from alunos
	 

 		";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':nome',$this->__get('nome'));
 		$stmt->bindValue(':codigo',$this->__get('nome'));
 		$stmt->execute();



 		return $stmt->fetch(\PDO::FETCH_ASSOC);


 	}

 	public function getAlunoPorCodigo(){


 		$query = "select * from alunos where  codigo =:codigo";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':codigo',$this->__get('codigo'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);



 	}


 	public function getCursoPorCodigo(){


 		$query = "select nome,codigo,idCurso from cursos where codigo = :codigo ";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':codigo',$this->__get('codigo'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);



 	}


 	public function getAlunoPorId(){



 		$query = "select* from alunos where idAluno = :idAluno ";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':idAluno',$this->__get('idAluno'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 	}


 	public function deletarAluno(){


 		$query = "delete from alunos where codigo = :codigo ";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':codigo',$this->__get('codigo'));
 		$stmt->execute();

 		return;



 	}

 		function updateXMl($query){


		 		$stmt  = $this->db->prepare($query);
		 		$stmt->execute();

		 		return;

		 }

 }


?>