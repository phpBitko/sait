<div class="content">
	<div id='size'>

		<form action="" method="post" id="addTask">
			<div id='formIn'>
				<h4 class="h">Виберіть номер завдання</h4>
				<select id='selectTaskEdit' class="selectMenu"
				        style="margin-top: 0" name="task_num">
					<!--   Добавити список задач    -->
					<?php
					$i = 0;
					$j = null;
					$act = 0;

					foreach ($data['task'] as $row) {
						$sel = '';
						if ($row['selected'] == 1) {
							$j = $i;
							$sel = "selected = 'selected'";
							$act = $row['is_actual'];
						}
						echo "<option value='{$row['task_num']}'{$sel}>Завдання №{$row['task_num']}</option>";
						$i++;
					}

					?>
					<!--   Добавити список задач    -->

				</select>
				<h4 class="h" style="margin: 0">Відмітити як актуальне</h4>
				<input id = 'actualCheckBox' type='checkbox' name='actualCheckBox' <?php if(@($act == 1)) echo ' checked="checked"'?> >
				<h4 class="h">Текст завдання</h4>
				<textarea id='textTaskEdit' rows="15" cols="35"
				          name='task_text'><?php echo @($data['task'][$j]['task_text']) ?></textarea></br>
				<?php
				if (@($data['error_update'] === true)) {
					echo "<div class = 'save' style='color: red'>Збережено</div>";
				} else if(@($data['error_update'] === false)) {
					echo "<div class = 'save' style='color: red'>Помилка збереження</div>";
				}else if(@($data['error_delete'] === true)) {
					echo "<div class = 'save' style='color: red'>Видалено</div>";
				}else if(@($data['error_delete'] === false)) {
					echo "<div class = 'save' style='color: red'>Помилка видалення</div>";
				}
				?>
				<input class='submitForm' type="submit" name = "save" value="Зберегти"><br>
				<input id = 'deleteTaskButton' class='submitForm' type="submit" name = "delete" value="Видалити">
			</div>

			<div id='textTaskView' class="textForHtml">
				<h4>Тестове завдання №<span
						id='numTaskOut'><?php echo @($data['task'][$j]['task_num']) ?></span>
				</h4>

				<div id='html'>

					<?php echo @($data['task'][$j]['task_text']) ?>
				</div>
			</div>
		</form>


	</div>

</div>