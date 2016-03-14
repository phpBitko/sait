<?php
error_reporting(-1);
header('Content-Type: text/html; charset=UTF-8');

include './view/head.php';
//header( 'Location: view/main.php', true );

include './view/title.php';


if (isset($_GET['page'])) {

	if ($_GET['page'] == 'tasks') {
		include './view/tasks.php';
	}
	if ($_GET['page'] == 'solution') {
		include './view/solution/solution.php';
	}
	if ($_GET['page'] == 'andriyTasks') {
		include './view/solution/andriy/userTasks.php';
	}
	if ($_GET['page'] == 'vitaliyTasks') {
		include './view/solution/vitaliy/userTasks.php';
	}
	if ($_GET['page'] == 'andriyTask1') {
		include './view/solution/andriy/task1/task1.php';
	}
	if ($_GET['page'] == 'vitaliyTask1') {
		include './view/solution/vitaliy/task1/task1.php';
	}



} else {
	include './view/main.php';
}

include './view/footer.php';