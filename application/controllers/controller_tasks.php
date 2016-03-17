<?php
class Controller_Tasks extends Controller{

	function action_index()	{
		//var_dump($this);
		$this->view->generate('tasks/tasks_view.php', 'template_view.php');
	}

	function action_task($data)	{
		if(file_exists('application/views/tasks/task'.$data.'_view.php')){
			$this->view->generate('tasks/task'.$data.'_view.php', 'template_view.php');
		}else{
			Route::ErrorPage404();
		}



	}

}