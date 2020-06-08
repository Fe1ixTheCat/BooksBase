<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>X5Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet/less" type="text/css" href="styles.less" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
  </head>
  <body>
    <div class="container">
      <header>
        <h1>Тестовое задание от X5Studio для Герасименко Александра Александровича</h1>
      </header>
      <main>
        <button type="button" name="button" onclick="getForm()">Добавить книгу</button>
        <article class="books">
          <?php
          $timeNow = time();
          $host = 'localhost';
          $user = 'root';
          $pass = '';
          $db_name = 'mybase';
          $link = mysqli_connect($host, $user, $pass, $db_name);

          if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
          }

            $sql = mysqli_query($link, 'SELECT `id`, `name`, `time`, `about`, `quantity`, `price` FROM `books`');

          while ($result = mysqli_fetch_array($sql)) {
            $timerM = intval(($timeNow - $result['time']) /60 % 60);
            $timerH = intval(($timeNow - $result['time']) /60 / 60);
            echo "<article class='book__item' id='{$result['id']}'>
                  <span>#{$result['id']}</span>
                  <h2>{$result['name']}</h2>
                  <span>Добавлено {$timerH} часов {$timerM} минут назад</span>
                  <p>{$result['about']}</p>
                  <span>{$result['quantity']} страниц</span>
                  <span>{$result['price']}$</span><br>
                  <a href='#' onclick='identy({$result['id']})' class='delete'>&#215;</a>
                  </article>";
          };
          if (isset($_POST["done"])) {
            $query = mysqli_query($link, "INSERT INTO `books`
              SET
              `name` = '".$_POST['name']."',
              `about` = '".$_POST['about']."',
              `time` = '".time()."',
              `quantity` = '".$_POST['quantity']."',
              `price` = '".$_POST['price']."'
              ");
            if ($query == true) {
              echo "<p style='color:lime'>Книга добавлена</p>";
              header("Refresh: 0");
            } else {
              echo "<p style='color:red'>Книга не была добавлена</p>";
            }
          }


          ?>
        </article>
      </main>
    </div>
    <article id="books__form" class="books__form">
      <form class="form" name="form" action="" method="post">
        <a href="#" onclick="getOutForm()">&#215;</a>
        <h2>Добавить новую книгу в каталог</h2>
        <input class="form__item" type="text" name="name" value="" placeholder="Введите название книги" required>
        <textarea class="form__item" name="about" name="about" rows="8" cols="80" placeholder="Введите краткое описание" required></textarea>
        <input class="form__item" type="text" name="quantity" value="" placeholder="Введите количество страниц" required>
        <input class="form__item" type="text" name="price" value="" placeholder="Введите цену" required><br>
        <button type="submit" name="done" onclick="checkForm()">Добавить</button>
      </form>
    </article>
    <script src="script.js"></script>
  </body>
</html>
