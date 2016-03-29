<!DOCTYPE html>
<!--Шаблон сторінки -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Title</title>
	<link rel="stylesheet" href="/css/index.css">
	<link rel="stylesheet" href="/css/buttons.css">
	<script src="/js/jquery-1.11.2.min.js"></script>
	<script src="/js/timer.js"></script>
	<script src="/js/selector.js"></script>
	<script src="/js/addTask.js"></script>

</head>
<body onload="startTimer()">
<div id="body">
	<div id="header">
		<a href="/">
			<h2>ВИВЧАЄМО PHP</h2>
		</a>
	</div>
	<div id = "menu">
		<ul class="ul-menu">
			<li class = "main-menu">
				<a href="/">Головна</a></li>
			<li class = "main-menu">
				<a href="/tasks">Тестові завдання</a></li>
			<li class = "main-menu">
				<a href="/execution">Статистика виконання</a></li>
			<li class = "main-menu">
				<a href="/solution">Тут виконувати завдання)</a>
			</li>
			<li class = "main-menu">
				<a href="/admin">Адмінка</a>
			</li>
		</ul>
	</div>

	<?php

	//echo $model_name."   Имя контроллера:".$controller_name.",".$action_name.",".$model_file.",".$model_path;
	include 'application/views/'.$content_view;
	?>

	<div id="footer">
		3Б © 2016. Всі права захищені.
	</div>

</div>
</body>
</html>