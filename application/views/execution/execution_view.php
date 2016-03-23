
<div class="content">
	<form action="" method = "post" >
		<table class="tableTasks">
			<tr>
				<th width="12%">№ завдання</th>
				<th width="25%">Виконавець</th>
				<th width="8%">Стан</th>
				<th width="55%">Коментар</th>

			</tr>

			<?php
			$i = 0;
			$taskSelIndex = null;
			foreach ($data as $row){
				//echo "<pre>"; print_r($row['selected_task']); echo "</pre>";
				//exit();
				if( isset($row['selected_task']) && $row['selected_task'] == 1){
					$taskSelIndex = $i;
				}
				if (isset($row['task_num'], $row['user_id'], $row['result'], $row['comment'])) {
					echo '<tr>';
					echo "<th width='12%'>{$row['task_num']}</th>
					 	  <th width='25%'>{$row['user_id']}</th>
					 	  <th width='5%'><input type='checkbox' disabled name='result' {$row['result']}></th>
					 	  <th width='55%'>{$row['comment']}</th>";
					echo '</tr>';
				}
				$i++;
			}
			?>


		</table>
		<select  id = 'selectName'class="selectMenu" name="user_id" >
			<?php

			foreach ($data['users'] as $row){
				$sel = '';
				if ($row['selected'] == 1){
					$sel = "selected = 'selected'";
				}
				echo "<option value='{$row['id']}'{$sel}>{$row['name']}</option>";
			}
			?>
		</select>
		<select id = 'selectTask' class="selectMenu" name="task_num">
			<?php
			foreach ($data['tasks'] as $row){
				$sel = '';
				if ($row['selected'] == 1){
					$sel = "selected = 'selected'";
				}
				echo "<option value='{$row['task_num']}'{$sel}>Завдання №{$row['task_num']}</option>";
			}
			?>


		</select>
		<p><b>Коментар до рішення завдання</b></p>


		<p><textarea id = 'commentText'rows="10" cols="45" name="comment"><?php echo $data[$taskSelIndex]['comment']?></textarea></p>
		<p><input type="submit" class="submitForm" value="Зберегти"></p>

	</form>

</div>
<!--<tr>
	<th rowspan="2" width="12%">№ завдання</th>
	<th colspan="2" width="44%">Андрій</th>
	<th colspan="2" width="44%">Віталій</th>
</tr>
<tr>
	<th width="5%">Стан</th>
	<th width="39%">Коментар</th>
	<th width="5%">Стан</th>
	<th width="39%">Коментар</th>

</tr>-->




