<?php
require_once('application/models/model_tasks.php');


class Controller_Admin extends Controller {
	function  __construct() {
		$this->tasks = new Model_Tasks();
		$this->view = new View();

	}

	function action_index()	{
		$this->view->generate('admin/admin_view.php', 'template_view.php');
	}

	function action_newTask()	{
		$data = null;
		if(isset($_POST) && $_POST!= null){
			//echo "<pre>"; print_r($_POST); echo "</pre>";
			$data = $this->tasks->setTask($_POST);
		}
		$this->view->generate('admin/newTask_view.php', 'template_view.php', $data);

	}

}