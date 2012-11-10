<?php

use Application\Models\Entities\Aluno as Aluno;

class AlunoController extends Zend_Controller_Action{

    public function init(){
        /* Initialize action controller here */
    }

	public function indexAction(){
	  $linkIncluir = $this->view->url(
	      array(
	          'controller'=>'aluno',
	          'action'=>'editar'
	          )
	      );
	  $this->view->assign('linkIncluir', $linkIncluir);
	  
	  $em = $this->getInvokeArg('bootstrap')->getEntityManager();
	
	  $query = $em->createQuery("select a from Application\Models\Entities\Aluno a");
	  
	  $this->view->assign('rows', $query->getResult());        
	}

    public function editarAction(){
		$row = new Aluno();
	  	$this->view->assign('row', $row);      
		$action = $this->view->url(
			array(
          		'controller' => 'aluno', 
        	  	'action' => 'gravar'
	        )
	     );        
		$this->view->assign('action', $action);
    }
	public function gravarAction(){
	  $matricula = $this->_request->getPost('matricula');
	  $nome = $this->_request->getPost('nome');
	  $dataDeNascimento = $this->_request->getPost('data_de_nascimento');      
	  $aluno = new Aluno();
	  $aluno->setMatricula($matricula);
	  $aluno->setNome($nome);
	  $aluno->setDataDeNascimento($dataDeNascimento);
	  $em = $this->getInvokeArg('bootstrap')->getEntityManager();  
	  $em->persist($aluno);
	  $em->flush();
	  $linkIndex = $this->view->url(
	  		array(
	  				'controller'=>'aluno',
	  				'action'=>'index'
	  		), null, true
	  );
	  $this->view->assign('linkIndex', $linkIndex);
	}
}