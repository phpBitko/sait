<div class="content" >
	<div id = 'size'>

	<form action="" method="post" id="addTask">
		<div id = 'formIn'>
			<h4 class="h">Введіть номер завдання</h4>
			<input id='numTaskIn' type="text" name ='task_num'>
			<?php
			if($data == 'error_num'){
			echo "<div style='color: red'>Такий номер існує</div>";
			}
			?>
			<div><?php $data?></div>
			<h4 class="h">Введіть текст завдання</h4>
			<textarea id = 'textTaskAdmin' rows="15" cols="35" name = 'task_text'></textarea></br>
			<input class='submitForm' type="submit" value="Зберегти">
		</div>

		<div class = "textForHtml">
			<h4>Тестове завдання №<span id = 'numTaskOut'></span></h4>

			<div id = 'html'>


			</div>
		</div>
	</form>


	</div>

</div>