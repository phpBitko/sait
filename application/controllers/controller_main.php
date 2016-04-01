<?php
require_once('application/models/model_news.php');

class Controller_Main extends Controller{
	function  __construct() {
		//$this->tasks = new Model_Tasks();
		$this->view = new View();
		$this->news = new Model_News();

	}


	function action_index()	{
		$this->view->generate('main/main_view.php', 'template_view.php',$this->news->get_data());
	}

}