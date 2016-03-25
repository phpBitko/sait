<?php
class Controller {

	protected $model;
	protected $view;
	protected $tasks;
	protected $users;
	protected $execution;


	function __construct(){
		$this->view = new View();
	}

	function action_index(){
	}
}