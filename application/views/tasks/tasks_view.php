	<div class="content">
		<h4>Тестове завдання №2</h4>

		<ul>
				<?php if(isset($data[0]['task_text'])) echo $data[0]['task_text'];?>
		</ul>


		</p>
		<h3><a href="/tasks/task/1">Тестове завдання №1</a></br></h3>
		<h3><a href="/tasks/task/2">Тестове завдання №2</a></h3>
		<h3><a href="/tasks/task/3">Тестове завдання №3</a></h3>


		<p class="time">До завершення виконання завдання залишилось: </br></p>
		<span id="my_timer" > </span>

	</div>

