<?php 

namespace App\Models;

 use MF\Model\Model;


 class Curso extends Model{

 	private $idCurso;

 	private $nome;

 	private $codigo;


 	public function __get($atributo){
 
      return $this->$atributo;


 	}

 	public function __set($atributo,$valor){

 		$this->$atributo = $valor;

 	}

 	public function salvar (){

 			$query = "insert into cursos(nome,codigo) values (:nome,:codigo)";  
 			$stmt  = $this->db->prepare($query);
 			$stmt->bindValue(':nome', $this->__get('nome'));
 			$stmt->bindValue(':codigo', $this->__get('codigo'));
 			$stmt->execute();

 			return $this;


 	}

 	public function editar (){

 			$query = "UPDATE  cursos SET nome = :nome, codigo =:codigo 
 			where idCurso =:idCurso";  
 			$stmt  = $this->db->prepare($query);
 			$stmt->bindValue(':nome', $this->__get('nome'));
 			$stmt->bindValue(':codigo', $this->__get('codigo'));
 			$stmt->bindValue(':idCurso', $this->__get('idCurso'));
 			$stmt->execute();

 			return $this;


 	}


 	public function validarCadastro(){

 		$valido = true;


 		if( strlen($this->__get('nome')) <3  ||  !is_numeric($this->__get('codigo')) ) {
 		$valido = false;

 		}


 		return $valido;



 	}

 	

 	public function getAllCurso(){

 		$query = "select nome,codigo from cursos";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':nome',$this->__get('nome'));
 		$stmt->bindValue(':codigo',$this->__get('nome'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 	}

 	public function getCursoPorNomeECodigo(){


 		$query = "select nome,codigo from cursos where nome = :nome or codigo =:codigo";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':nome',$this->__get('nome'));
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


 	public function getCursoPorId(){



 		$query = "select nome,codigo,idCurso from cursos where idCurso = :idCurso ";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':idCurso',$this->__get('idCurso'));
 		$stmt->execute();



 		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 	}


 	public function deletarCurso(){


 		$query = "delete from cursos where codigo = :codigo ";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':codigo',$this->__get('codigo'));
 		$stmt->execute();

 		return;



 	}

 }


?>