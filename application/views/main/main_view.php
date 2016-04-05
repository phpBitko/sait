<div class="content">
	<p class="time">До завершення виконання завдання залишилось: </br></p>
	<span id="my_timer" > </span>
	<h2 style="padding-left: 20px;">Новини сайту</h2>

		<?php
		foreach ($data as $el){
			echo '<div class="newsContent">';
			echo "<div class='newsHead'><h3> {$el['news_head']}</h3></div>";?>
			<div class='addTimeNews'>
				<?php
				echo "Опубліковано: {$el['news_add_time']}";
				if ($el['modifiedDate'] !=1){
					echo "/Відректовано: {$el['news_edit_time']}";
				}
				?>

			</div>

			<?php	echo "<div class='newsText'>{$el['news_text']}</div></div>";
		}?>

</div>