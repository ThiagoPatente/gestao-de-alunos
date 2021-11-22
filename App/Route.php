<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);


		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);


		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['sistema'] = array(
			'route' => '/sistema',
			'controller' => 'AppController',
			'action' => 'sistema'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['curso'] = array(
			'route' => '/curso',
			'controller' => 'AppController',
			'action' => 'curso'
		);

		$routes['cursoCadastro'] = array(
			'route' => '/cursoCadastro',
			'controller' => 'AppController',
			'action' => 'cursoCadastro'
		);


		$routes['cadastrarCurso'] = array(
			'route' => '/cadastrarCurso',
			'controller' => 'AppController',
			'action' => 'cadastrarCurso'
		);

			$routes['editarCurso'] = array(
			'route' => '/editarCurso',
			'controller' => 'AppController',
			'action' => 'editarCurso'
		);

			$routes['aluno'] = array(
			'route' => '/aluno',
			'controller' => 'AppController',
			'action' => 'aluno'
		);

			$routes['alunoCadastro'] = array(
			'route' => '/alunoCadastro',
			'controller' => 'AppController',
			'action' => 'alunoCadastro'
		);


			$routes['cadastrarAluno'] = array(
			'route' => '/cadastrarAluno',
			'controller' => 'AppController',
			'action' => 'cadastrarAluno'
		);

			$routes['alunoEditar'] = array(
			'route' => '/alunoEditar',
			'controller' => 'AppController',
			'action' => 'alunoEditar'
		);


			$routes['editarAluno'] = array(
			'route' => '/editarAluno',
			'controller' => 'AppController',
			'action' => 'editarAluno'
		);

			$routes['buscarAluno'] = array(
			'route' => '/buscarAluno',
			'controller' => 'AppController',
			'action' => 'buscarAluno'
		);

			$routes['buscarAlunoId'] = array(
			'route' => '/buscarAlunoId',
			'controller' => 'AppController',
			'action' => 'buscarAlunoId'
		);

			$routes['importarxml'] = array(
			'route' => '/importarxml',
			'controller' => 'AppController',
			'action' => 'importarxml'
		);


			$routes['importeXml'] = array(
			'route' => '/importeXml',
			'controller' => 'AppController',
			'action' => 'importeXml'
		);


		$this->setRoutes($routes);
	}

}

?>