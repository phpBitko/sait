<?php
require_once('application/models/model_tasks.php');
require_once('application/models/model_execution.php');


class Controller_Admin extends Controller {
	function  __construct() {
		$this->tasks = new Model_Tasks();
		$this->view = new View();
		$this->execution = new Model_Execution();

	}

	function action_index()	{
		$this->view->generate('admin/admin_view.php', 'template_view.php');
	}

	function action_newTask()	{
		$data = array();
		if(isset($_POST) && $_POST!= null){
			//echo "<pre>"; print_r($_POST); echo "</pre>";
			$data['error'] = $this->tasks->setTask($_POST);
			if($data['error'] == 'error_num'){
				$data['task'] = $this->tasks->getSelectedTaskNotActual();
			}else{
				$this->execution->addFieldComment($_POST['task_num']);
			}
		}
		$this->view->generate('admin/newTask_view.php', 'template_view.php', $data);

	}

}