<?php
/**
 * 
 * @author fabricio
 * @since Sep 26, 2012
 * 
 */
class IndexController extends Zend_Controller_Action{
	/*
	 **/
	public function init(){
		/* Initialize action controller here */
	}
	/*
	 **/
	public function indexAction(){
		
		$linkAlunos = $this->view->url(array(
						'controller'=>'aluno',
						'action'=>'index'
				)
		);
		$this->view->assign('linkAlunos', $linkAlunos);
	}
}