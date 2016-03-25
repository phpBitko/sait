<div class="content">
	<p>
	<h4>Тестове завдання №<?php if(isset($data[0]['task_num'])) echo $data[0]['task_num'];?></h4>
	<div>
		<ul>
			<?php if(isset($data[0]['task_text'])) echo $data[0]['task_text'];?>
		</ul>
	</div>
	<?php if(isset($data[0]['is_actual']) && $data[0]['is_actual'] == 1){
	 echo '<p class="time">До завершення виконання завдання залишилось: </br></p>
			<span id="my_timer" > </span>
			</p>';
	}
	?>

</div>
