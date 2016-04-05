<div class="content" >
	<div id = 'size'>

		<form action="" method="post" class="formAdmin">
			<div id = 'formIn'>
				<h4 class="h">Виберіть повідомлення</h4>
				<select id='selectNewsEdit' class="selectMenuNews"
				        style="margin-top: 0" name="news_id">
					<!--   Добавити список новин    -->
					<?php
					$i = 0;
					$j = null;
					foreach ($data['news'] as $el){
						$sel = 0;
						if ($el['selected'] == 1){
							$sel = "selected = 'selected'";
							$j = $i;
						}
						echo "<option value='{$el['id']}' {$sel}>{$el['news_head']}</option>";
						$i++;
					}
					?>
					<!--   Добавити список новин    -->
				</select>

				<h4 class="h">Введіть новий заголовок</h4>
				<input id='headNewsIn' type="text" name ='news_head' value="<?php echo @($data['news'][$j]['news_head'])?>">

				<!--Добавити попередження -->
				<?php

				if(@($data['error_head'] === false)){
					echo "<div style='color: red'>Введіть заголовок</div>";
				}?>

				<h4 class="h">Текст повідомлення</h4>
				<textarea id = 'textNewsAdmin' rows="15" cols="35" name = 'news_text'><?php echo @($data['news'][$j]['news_text']) ?></textarea></br>

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

				<input class='submitForm' type="submit" name="save" value="Зберегти"><br>
				<input class='submitForm' type="submit" name = "delete" value="Видалити">
			</div>

			<div class = "textForHtml">
				<h4><span id = 'headNewsOut'> <?php echo @($data['news'][$j]['news_head'])?>  </span></h4>

				<div id = 'html'>
					<?php echo @($data['news'][$j]['news_text'])?>
				</div>
			</div>
		</form>


	</div>

</div>