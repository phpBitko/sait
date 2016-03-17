<?php
class Controller_Main extends Controller{

	function action_index()	{
		//var_dump($this);
		$this->view->generate('main/main_view.php', 'template_view.php');
	}

}