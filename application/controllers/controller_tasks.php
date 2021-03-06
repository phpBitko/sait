<?php
require_once('application/models/model_tasks.php');

class Controller_Tasks extends Controller{
	function __construct(){
		$this->view = new View();
		$this->tasks = new Model_Tasks();
	}


	function action_index()	{

		$data = $this->tasks->get_data();
		$this->view->generate('tasks/tasks_view.php', 'template_view.php', $data);

	}

	function action_task($data)	{

		if(file_exists('application/views/tasks/task_view.php')){
			$this->view->generate('tasks/task_view.php', 'template_view.php', $this->tasks->get_data($data));
		}else{
			Route::ErrorPage404();
		}



	}

}