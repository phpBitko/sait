<?php
class Controller_404 extends Controller{

	function action_index(){

		$this->view->generate('404/404_view.php', 'template_view.php');
	}
}
