	<div class="content">
		<?php if(isset($data)){
			foreach ($data as $el){
				if($el['is_actual'] == 1){?>
		<h4>Тестове завдання №<?php echo $el['task_num']?></h4>
		<ul>
			<?php echo $el['task_text'];}}};?>

		</ul>
		</p>
		<?php if(isset($data)){
			foreach ($data as $el){
		        echo "<h3><a href='/tasks/task/{$el['task_num']}'>Тестове завдання №{$el['task_num']}</a></br></h3>";
			}} ?>
		<p class="time">До завершення виконання завдання залишилось: </br></p>
		<span id="my_timer" > </span>

	</div>

