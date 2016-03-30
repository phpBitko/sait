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

	function action_newTask() {
		$data = array();


		if (isset($_POST) && $_POST != null) {
			echo "<pre>"; print_r($_POST); echo "</pre>";

			$_POST['task_text'] = addslashes($_POST['task_text']);
			$data['error'] = $this->tasks->setTask($_POST);
			if ($data['error'] == 'error_num') {
				$data['task'] = $this->tasks->getSelectedTaskNotActual();
			} else {
				$this->execution->addFieldComment($_POST['task_num']);
			}
		}
		$this->view->generate('admin/newTask_view.php', 'template_view.php', $data);

	}

	function action_editTask()	{
		$headers = $_SERVER;
		$data = array();
		//print_r($headers);
		//exit;

		if(isset($_POST) && isset($headers['HTTP_HEAD'])){
			$taskText = $this->tasks->get_data($_POST['task_num']);
			print_r(json_encode($taskText));
			exit();
		} elseif (isset($_POST) && $_POST!= null){
			if(isset($_POST['save'])){
				$_POST['task_text'] = addslashes($_POST['task_text']);
				$data['error_update'] = $this->tasks->updateTask($_POST);
				$this->tasks->setSelected($_POST);
			}elseif(isset($_POST['delete'])){
				$data['error_delete'] = $this->tasks->deleteTask($_POST['task_num']);
				if($data['error_delete']){
					$this->execution->deleteFieldComment($_POST['task_num']);
				}
			}
		}
		$data['task'] = $this->tasks->get_data();
		//print_r($data);
		//print_r($data);
		$this->view->generate('admin/editTask_view.php', 'template_view.php', $data);

	}

}