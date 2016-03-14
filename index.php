<?php
error_reporting(-1);
header('Content-Type: text/html; charset=UTF-8');

include './view/head.php';
//header( 'Location: view/main.php', true );
?>

<body onload="startTimer()">
	<div id="body">

<?php

include './view/title.php';

if(!isset($_GET['page'])){
	$_GET['page']= 'view/main';
}
//echo "<pre>"; print_r($_GET); echo "</pre>";

include './'.$_GET['page'].'.php';


include './view/footer.php';
?>
		</div>
	</body>
</html>