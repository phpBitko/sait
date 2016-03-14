<?php

if (isset($_POST['valName'],$_POST['valPassword'])) {
    $nameVal = $_POST['valName'];
    $pasVal = $_POST['valPassword'];
}
echo "Ім'я - " .$_POST['valName'];
echo "<br />";
echo "Пароль - ". $_POST['valPassword'];
exit;
?>