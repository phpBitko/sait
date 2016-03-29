<div class="content" >
	<div id = 'size'>

	<form action="" method="post" id="addTask">
		<div id = 'formIn'>
			<h4 class="h">Введіть номер завдання</h4>
			<input id='numTaskIn' type="text" name ='task_num' value="<?php echo @($data['task'][0]['task_num'])?>">
			<?php
			if(@($data['error'] == 'error_num')){
				echo "<div style='color: red'>Такий номер існує</div>";
			}else if(@($data['error'] == 'error_none') ){
				echo "<div style='color: red'>Збережено</div>";
			}
			?>
			<div><?php $data?></div>
			<h4 class="h">Введіть текст завдання</h4>
			<textarea id = 'textTaskAdmin' rows="15" cols="35" name = 'task_text'><?php  echo @($data['task'][0]['task_text'])?></textarea></br>
			<input class='submitForm' type="submit" value="Зберегти">
		</div>

		<div class = "textForHtml">
			<h4>Тестове завдання №<span id = 'numTaskOut'><?php echo @($data['task'][0]['task_num'])?></span></h4>

			<div id = 'html'>
				<?php  echo @($data['task'][0]['task_text'])?>

			</div>
		</div>
	</form>


	</div>

</div>