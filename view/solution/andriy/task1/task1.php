<div class="content">
    <form action="" method = "post">
        <div> Введіть логін</br><input type="text" name="login"></div>
        <div> Введіть пароль</br><input type="password" name="pass"></div>
        <div><input type="submit" name="sub" value="&#1058;&#1080;&#1089;&#1085;&#1080;"</br></div>

        <?php
        if(isset($_POST['login'], $_POST['pass'])) {
            echo '<p>Ви ввели логін: ' . $_POST['login'];
            '</p>';
            echo '<p>Ви ввели пароль: ' . $_POST['pass'];
            '</p';
        }
        ?>

</div>
