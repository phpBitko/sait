<?php
class Controller_Execution extends Controller{
	public $dataModelSolution;
	function __construct(){
		$this->model = new Model_Execution();
		$this->view = new View();
	}


	function action_index()	{
		//var_dump($this);
		$dataModelSolution = $this->model->get_data();
		//echo "<pre>"; print_r( $dataModelSolution); echo "</pre>";




		//echo $dataModelSolution;

		//var_dump($this);
		$this->view->generate('execution/execution_view.php', 'template_view.php',$dataModelSolution);
	}

}