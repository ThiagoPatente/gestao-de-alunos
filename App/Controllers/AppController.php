<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

			public function sistema(){

				
				session_start();

				if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

						
						$this->render('sistema');


			}else{

					header('Location:/?login=erro');

			}

	}


		public function buscarAluno(){

					
					session_start();

					if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

							$this->render('buscarAluno');


				}else{

						header('Location:/?login=erro');

				}

		}


		public function importarxml(){

					
					session_start();

					if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

							$this->render('importarxml');


				}else{

						header('Location:/?login=erro');

				}

		}




		public function buscarAlunoId(){

					
					session_start();

					if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

						$aluno  = Container::getModel('Aluno');

								
								$aluno->__set('codigo',$_POST['codigo']);
								
								$this->view->editarA = $aluno->getAlunoPorCodigo();

								$this->view->erroEditarA = false ;

								$this->render('alunoEditar');



				}else{

						header('Location:/?login=erro');

				}

		}

	public function curso(){

				
				session_start();

				if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
						

						$curso  = Container::getModel('Curso');

						$this->view->cursos = $curso->getAllCurso();

						$this->render('curso');
						

			}else{

					header('Location:/?login=erro');

			}

	}


	public function aluno(){

				
				session_start();

				if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){


						//variavel de paginacao
						$total_alunos_pagina = 10;

						$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

						$deslocamento = ($pagina - 1) * $total_alunos_pagina;



						//Preparacao pra consultas
						$aluno  = Container::getModel('Aluno');

						$alunos =  $aluno->getPorPagina($total_alunos_pagina,$deslocamento);

						$total_alunos = $aluno->getTotalRegitro();

						$this->view->total_de_paginas = $total_alunos['total'] / $total_alunos_pagina;

						$this->view->alunos = $alunos;

						$this->render('aluno');
						

			}else{

					header('Location:/?login=erro');

			}

	}


	public function alunoCadastro(){

			session_start();

		   if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

		   					
		   				
						// preparacao para editar cursos
						if(isset($_POST['action']) && $_POST['action'] == 'editar' ){

								$aluno  = Container::getModel('Aluno');

								$aluno->__set('nome',$_POST['nome']);
								
								$aluno->__set('codigo',$_POST['codigo']);

								$aluno->__set('cep',$_POST['cep']);

								$aluno->__set('situacao',$_POST['situacao']);

								
								$this->view->editarA = $aluno->getAlunoPorCodigo();

								$this->view->erroEditarA = false ;

								$this->view->cep = $_POST['cep'];



								$this->render('alunoEditar');


						}
							else if( isset($_POST['action']) && $_POST['action'] == 'deletar'){


						
								$aluno  = Container::getModel('Aluno');

								$aluno->__set('nome',$_POST['nome']);
								
								$aluno->__set('codigo',$_POST['codigo']);

								$aluno->deletarAluno();

								header('Location:/aluno');

						}


		   				else{

			   				$this->view->erroCadastroA = false ;

			   				$this->render('alunoCadastro');
			   			}

			}else{

					header('Location:/?login=erro');

			}

	}


	public function cursoCadastro(){

				
				session_start();

				if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){


						// preparacao para editar cursos
						if(isset($_POST['action']) && $_POST['action'] == 'editar' ){

								$curso  = Container::getModel('Curso');

								$curso->__set('nome',$_POST['nome']);
								
								$curso->__set('codigo',$_POST['codigo']);
								
								$this->view->editarC = $curso->getCursoPorCodigo();

								$this->view->erroEditarC = false ;

								$this->render('cursoEditar');


						}
						// preparacao para deletar cursos
						else if( isset($_POST['action']) && $_POST['action'] == 'deletar'){


						
								$curso  = Container::getModel('Curso');

								$curso->__set('nome',$_POST['nome']);
								
								$curso->__set('codigo',$_POST['codigo']);

								$curso->deletarCurso();

								header('Location:/curso');

						}

						else{


						$this->view->erroCadastroC = false ;


						$this->render('cursoCadastro');
					}
						

			}else{

					header('Location:/?login=erro');

			}

	}


				public function cadastrarAluno(){

					$aluno  = Container::getModel('Aluno');

					$aluno->__set('nome',$_POST['nome']);
					
					$aluno->__set('codigo',$_POST['codigo']);

					$aluno->__set('cep',$_POST['cep']);

					$aluno->__set('bairro',$_POST['bairro']);

					$aluno->__set('logradouro',$_POST['logradouro']);

					$aluno->__set('cidade',$_POST['cidade']);

					$aluno->__set('estado',$_POST['estado']);

					$aluno->__set('situacao',$_POST['situacao']);

					$aluno->__set('turma',$_POST['turma']);

					$aluno->__set('curso',$_POST['curso']);

						//preparacao para upload da imagem

						$image = addslashes(file_get_contents($_FILES['img']['tmp_name']));
				        

				        $aluno->__set('img',$image);


					if($aluno->validarCadastro() && count ($aluno->getAlunoPorCodigo()) == 0 ){		

							$aluno->salvar();

							$this->render('cadastroA');
							
				}
				
				else{


						

						$this->view->erroCadastroA = true ;


						$this->render('alunoCadastro');

				}


				}








		public function cadastrarCurso(){

		

			$this->view->erroEditarC = false;

		$curso  = Container::getModel('Curso');

		$curso->__set('nome',$_POST['nome']);
		$curso->__set('codigo',$_POST['codigo']);


		if($curso->validarCadastro() && count ($curso->getCursoPorNomeECodigo()) == 0 ){		

				$curso->salvar();

				$this->render('cadastroC');
				
	}
	
	else{


			
			$this->view->curso = array(
				'nome'  => $_POST['nome'],
				'codigo' => $_POST['codigo']);


			$this->view->erroCadastroC = true ;


			$this->render('cursoCadastro');

	}


	}



		public function editarCurso(){

		

			$this->view->erroEditarC = false;

		$curso  = Container::getModel('Curso');

		$curso->__set('nome',$_POST['nome']);
		$curso->__set('codigo',$_POST['codigo']);
		$curso->__set('idCurso',$_POST['id']);



		if($curso->validarCadastro() && count ($curso->getCursoPorNomeECodigo()) < 2 ){		

				$curso->editar();

				$this->render('editarC');
				
	}
	
	else{


			
			$this->view->editarC = $curso->getCursoPorId();



			$this->view->curso = array(
				'nome'  => $_POST['nome'],
				'codigo' => $_POST['codigo']);


			$this->view->erroEditarC = true ;


			$this->render('cursoEditar');

	}


	}



		public function editarAluno(){

		



		$aluno  = Container::getModel('Aluno');

			$aluno->__set('nome',$_POST['nome']);
			
			$aluno->__set('codigo',$_POST['codigo']);
			
			$aluno->__set('idAluno',$_POST['id']);	
			
			$aluno->__set('cep',$_POST['cep']);

		    $aluno->__set('bairro',$_POST['bairro']);

			$aluno->__set('logradouro',$_POST['logradouro']);

			$aluno->__set('cidade',$_POST['cidade']);

			$aluno->__set('estado',$_POST['estado']);

			$aluno->__set('situacao',$_POST['situacao']);


			$aluno->__set('turma',$_POST['turma']);

			$aluno->__set('curso',$_POST['curso']);

			//preparacao para upload da imagem

			$image = addslashes(file_get_contents($_FILES['img']['tmp_name']));
				        

		    $aluno->__set('img',$image);



		if($aluno->validarCadastro() && count ($aluno->getAlunoPorCodigo()) < 2 ){		

				$aluno->editar();

				$this->render('editarA');
				
	}
	
	else{


			
			$this->view->editarA = $aluno->getAlunoPorId();



			$this->view->aluno = array(
				'nome'  => $_POST['nome'],
				'codigo' => $_POST['codigo']);


			$this->view->erroEditarA = true ;


			$this->render('alunoEditar');

	}


	}

	public function importeXml(){


		$aluno  = Container::getModel('Aluno');

	$upload = (object) $_FILES['xml'];
	$xml = $upload->error ? NULL : simplexml_load_file($upload->tmp_name);

		foreach ($xml->children() as $row) {
							    $nome = $row->nome;
							    $codigo = $row->codigo;
							    $sql = "INSERT INTO cursos(nome,codigo) VALUES ('" . $nome . "','" . $codigo."')";
							    
							   		$return = $aluno->updateXMl($sql);

							    
			}



				$this->render("sistema");


	}

}
?>