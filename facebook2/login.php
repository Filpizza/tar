<?php
  include('db.php');
  $data = $_POST;
  if(isset($data['do_login'])) {
    $name = htmlspecialchars($data['login']);
    $pass = (string)htmlspecialchars($data['password']);
    $errors = array();
    $stmt = mysqli_prepare($link, "SELECT * FROM access WHERE login = ?");
    // связываем параметры с метками
    mysqli_stmt_bind_param($stmt, "s", $name);
    // запускаем запрос
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // получаем значения
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //закрываем запрос
    mysqli_stmt_close($stmt);
    if($user) {
      $stmt = mysqli_prepare($link, "SELECT * FROM access WHERE password = ?");
      // связываем параметры с метками
      mysqli_stmt_bind_param($stmt, "s", $pass);
      // запускаем запрос
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      // получаем значения
      $password = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // закрываем запрос
      mysqli_stmt_close($stmt);
      if($password) {
        // можем залогинить юзера
        $_SESSION['logged_user'] = $name;
        if(isset($_POST['remember'])) {
          setcookie('name', $name, time() + (10*365*24*60*60));
          setcookie('password', $pass, time() + (10*365*24*60*60));
        } else {
          if(isset($_COOKIE['name']) and isset($_COOKIE['password'])) {
            setcookie("name", "");
            setcookie("password", "");
          }
        }
        echo '<div style="color: green; font-weight: bold;">Вы авторизованы, можете перейти на <a href="hello world.php">главную страницу</a>.</div><hr/>';
        exit();
        header("Location: index.php");

      } else {
        $errors[] = 'Пароль введен неверно! Попробуйте еще раз!';
      }

    } else {
      $errors[] = 'Польазователь с таким логином не нйден!';
    }

    if(! empty($errors)) {
      echo '<div style="color: red;">' . array_shift($errors) . '</div><hr/>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <h1>Authorisation form</h1>

  <form method="post" action="<?= $_SERVER['SCRIP_NAME'] ?>">
    <div class="form-group">
      <label for="exampleInputEmail1">Login</label>
      <input type="text" class="form-control" id="login" name="login" placeholder="Login" value="<?php if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];?><?php } else ?><?php { ?><?php echo $data['login']; ?><?php } ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];?><?php } ?>">
    </div>
    <div class="form-group">
      <label for="checkbox">Remember me</label>
      <input type="checkbox" id="checkbox" name="remember" <?php if(isset($_COOKIE['name'])) { ?> checked <?php } ?>>
    </div>
    <button type="submit" name="do_login" class="btn btn-primary">Submit</button>
  </form><br><br>

  <h5>Если Вы еще не зарегистрированы, пройдите <a href="registration.php">регистрацию</a>.</h5>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>