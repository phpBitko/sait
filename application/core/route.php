<?php


class Route{

	static function start()	{
		//print_r($_POST);
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) ){
			$controller_name = $routes[1];
		}

		// получаем имя экшена
		if ( !empty($routes[2]) ){
			$action_name = $routes[2];
		}

		$param = null;
		if(count($routes)>3){
			$param = $routes[3];
		}

		if($controller_name == ('index.php')){
			$controller_name = 'Main';
			$action_name = 'index';
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';

		$model_path = "application/models/".$model_file;

		//echo $model_name."   Имя контроллера:".$controller_name.",".$action_name.",".$model_file.",".$model_path;
		if (file_exists($model_path)){
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		//echo $controller_name."sss". $action_name;

		if(file_exists($controller_path)){
			include "application/controllers/".$controller_file;
		}else{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}

		// создаем контроллер
		$controller = new $controller_name;

		$action = $action_name;
		//echo $action."sdds".$param;
		//xit();
		if(method_exists($controller, $action)){
			// вызываем действие контроллера
				$controller->$action($param);
		}else{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}

	}

	static function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		//echo '<br>'.'Location:'.$host.'404';

		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
}