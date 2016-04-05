<div class="content" >
	<div id = 'size'>

		<form action="" method="post" class="formAdmin">
			<div id = 'formIn'>
				<h4 class="h">Введіть заголовок</h4>
				<input id='headNewsIn' type="text" name ='news_head' value="">
				<!--Добавити попередження -->
				<?php
				if(@($data['error_head'] === false)){
					echo "<div style='color: red'>Введіть заголовок</div>";
				}?>
				<h4 class="h">Текст повідомлення</h4>
				<textarea id = 'textNewsAdmin' rows="15" cols="35" name = 'news_text'></textarea></br>
				<?php
				if(@($data['error_add'] == true)){
					echo "<div style='color: red'>Збережено</div>";
				}?>
				<input class='submitForm' type="submit" value="Зберегти">
			</div>

			<div class = "textForHtml">
				<h4><span id = 'headNewsOut'></span></h4>

				<div id = 'html'>


				</div>
			</div>
		</form>


	</div>

</div>