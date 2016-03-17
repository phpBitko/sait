<?php
class Controller_Execution extends Controller{

	function action_index()	{
		//var_dump($this);
		$this->view->generate('execution/execution_view.php', 'template_view.php');
	}

}