<?php
//namespace application\core;
require_once('application/models/model_users.php');
require_once('application/models/model_tasks.php');

//use model_tasks.php;
//use Controller;
//use application\models\Model_Tasks;

class Controller_Execution extends Controller{
	//public $dataModelSolution;
	function __construct(){
		$this->execution = new Model_Execution();
		$this->view = new View();
		$this->users = new Model_Users();
		$this->tasks = new Model_Tasks();
	}


	function action_index()	{
		$headers = $_SERVER;
		//echo "<pre>"; print_r( $headers); echo "</pre>";
		if(isset($_POST) && isset($headers['HTTP_HEAD'])){
			echo json_encode($this->execution->getComments($_POST));
			exit();
		}elseif (isset($_POST) && $_POST !=null){
			$this->execution->setComments($_POST);
			$this->users->setSelected($_POST);
			$this->tasks->setSelected($_POST);

		}
		$dataModelSolution = $this->execution->get_data();
		$dataModelSolution['users'] = $this->users->get_data();
		$dataModelSolution['tasks'] = $this->tasks->get_data();

		$this->view->generate('execution/execution_view.php', 'template_view.php',$dataModelSolution);
	}

}