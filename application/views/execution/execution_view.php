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
			foreach ($data as $row){
			echo"<tr>
				<th width='12%'>{$row['task_num']}</th>
				<th width='25%'>{$row['user_id']}</th>
				<th width='5%'><input type='checkbox' disabled name='result' {$row['result']}></th>
				<th width='55%'></th>
			</tr>";
			}
			?>


		</table>
		<select class="selectMenu" >
			<option>Андрій</option>
			<option>Віталій</option>
		</select>
		<select class="selectMenu">
			<option>Завдання №1</option>
			<option>Завдання №2</option>
		</select>
		<p><b>Коментар до рішення завдання</b></p>
		<p><textarea rows="10" cols="45" name="text"></textarea></p>
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



<?php
