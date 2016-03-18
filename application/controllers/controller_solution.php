<?php
class Controller_Solution extends Controller{

/*	function __construct(){
		$this->model = new Model_Solution();
		$this->view = new View();
	}*/


	function action_index()	{
		//var_dump($this);
		//$dataModelSolution = $this->model->get_data();
		//echo $dataModelSolution;



		$this->view->generate('solution/solution_view.php', 'template_view.php');





	}
	function action_andriy($data)	{
		//var_dump($this);
		if($data == null){
			$this->view->generate('solution/andriy/andriy_view.php', 'template_view.php');
		}else{
			if(file_exists('application/views/solution/andriy/'.$data.'_view.php')){
				$this->view->generate('solution/andriy/'.$data.'_view.php', 'template_view.php');
			}else{
				Route::ErrorPage404();
			}

		}
	}
	function action_vitaliy($data=0)	{
		if($data == null){
			$this->view->generate('solution/vitaliy/vitaliy_view.php', 'template_view.php');
		}else{
			if(file_exists('application/views/solution/vitaliy/'.$data.'_view.php')){
				$this->view->generate('solution/vitaliy/'.$data.'_view.php', 'template_view.php');
			}else{
				Route::ErrorPage404();
			}
		}
	}
	function action_yuriy($data=0)	{
		if($data == null){
			$this->view->generate('solution/yuriy/yuriy_view.php', 'template_view.php');
		}else{
			if(file_exists('application/views/solution/yuriy/'.$data.'_view.php')){
				$this->view->generate('solution/yuriy/'.$data.'_view.php', 'template_view.php');
			}else{
				Route::ErrorPage404();
			}
		}
	}
}