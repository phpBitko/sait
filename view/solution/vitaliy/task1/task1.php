<?php
include './view/solution/vitaliy/task1/les1.php';
?>

<div class="content">
    <img src = "view/solution/vitaliy/task1/pic.jpg">
    <h2>Напої кава <q>StarBuzz</q>> </h2>
    <p> кава Мексики, Болівії - 10 грн.<blockquote>Неймовірно прекрасна кава з ароматом
        стиглої вишні і підсмаженої кориці, отримана із високогінних порід кави.<p> Спробуйте це зараз</p></blockquote></p>
    <p> капучіно - 15 грн. </p>
    <p> чай - 8 грн. </p>
    <form action = "" method = "post" >
        <p>Введіть ім'я
            <input type="text" name = "valName"></p>
        <p>Введіть пароль
            <input type = "password" name="valPassword"></p>
        <input type ="submit" name = "send" value = "Замовити">
    </form>
    <?php
      if( isset($nameVal))  echo "Логін - " .$nameVal;
       echo "<br />";
      if( isset($nameVal))  echo  "Пароль - " .$nameVal;
 ?>
</div>