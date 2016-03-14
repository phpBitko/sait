<?php
include './view/solution/yuriy/task1/action.php';
?>


<div class="content">
    <form action="" method = "post">
        <div> Введіть логін</br><input type="text" name="login"></div>
        <div> Введіть пароль</br><input type="password" name="pass"></div>
        <div><input type="submit" name="sub" value="Тисни"</br></div>
    </form>
    <p><?php echo @($login) ?></p>
    <p><?php echo @(@$pass) ?></p>


</div>
