<?php
  include('db.php');
  $data = $_POST;
  if(isset($data['do_sign'])) {
    $name = htmlspecialchars(trim($data['login']));
    $email = htmlspecialchars(trim($data['email']));
    $password = (string)htmlspecialchars($data['password']);
    $password_confirmation = (string)($data['confirm_password']);
    $surname = htmlspecialchars(trim($data['surname']));
    $firstname = htmlspecialchars(trim($data['name']));
    $gender = htmlspecialchars(trim($data['gender']));
    $errors = array();
    if($data['login'] == '') {
      $errors[] = 'Введите логин!';
    }
    if($stmt = mysqli_prepare($link, "SELECT * FROM access where login = ?")) {
      /* связываем параметры с метками */
      mysqli_stmt_bind_param($stmt, "s", $name);
      /* запускаем запрос */
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      /* получаем значения */
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      /* закрываем запрос */
      mysqli_stmt_close($stmt);
      if($row) {
        $errors[] = "Пользователь с логином \"" . $name . "\" уже существует. Выберите другой или пройдите авторизацию.";
      }
    }
    if($data['email'] == '') {
      $errors[] = 'Введите электронный адрес!';
    }
    if($stmt = mysqli_prepare($link, "SELECT * FROM access where email = ?")) {
      /* связываем параметры с метками */
      mysqli_stmt_bind_param($stmt, "s", $email);
      /* запускаем запрос */
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      /* получаем значения */
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      /* закрываем запрос */
      mysqli_stmt_close($stmt);
      if($row) {
        $errors[] = "Пользователь с электронным адресом \"" . $email . "\" уже существует. Выберите другой или пройдите авторизацию.";
      }
    }
    if($data['password'] == '') {
      $errors[] = 'Введите пароль!';
    }
    if($data['confirm_password'] != $data['password']) {
      $errors[] = 'Пароли не совпадают!';
    }
    if(empty($errors)) {
      // everything is ok, we can register the user
      $stmt = mysqli_prepare($link, "INSERT INTO access (login, email, password) VALUES (?,?,?)");
    if($stmt) {
      /* делаем соль для пароля */
     // $salt = md5(mt_rand());
     //$encryptedPassword = md5($password . $salt);
      /* связываем параметры с метками */
      mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
      /* запускаем запрос */
      $success = mysqli_stmt_execute($stmt);
      if($success) {
        echo '<div style="color: green; font-weight: bold;">Регистрация прошла успешно! <a href="login.php">Авторизуйтесь</a>, пожалуйста!</div><hr/>';
          $CreateSql = "INSERT INTO `user` (`name`, `surname` ,`gender`,`id_access`) VALUES ('$firstname', '$surname', '$gender',(SELECT id FROM access WHERE login='$name'));";
          mysqli_query($link, $CreateSql) or die(mysqli_error($link));
      } else {
        echo '<div style="color: blue;">Ошибка добавления! Проверьте параметры базы данных!</div><hr/>';
      }
      /* закрываем запрос */
      mysqli_stmt_close($stmt);
      }
    } else {
      // smth is wrong
      echo '<div style="color: red;">'. array_shift($errors) . '</div><hr/>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
  </head>
  <body>
      <div class="container">
          <div class="row">
              <form method="post" class="form-horizontal col-md-6 col-md-offset-3" action="<?= $_SERVER['PHP_SELF'] ?>">
              <h1>Registration</h1>
                  <div class="form-group">
      <label for="exampleInputEmail1" class="col-sm-2 control-label">Login</label>
        <div class="col-sm-10">
      <input type="text" class="form-control" id="login" name="login" placeholder="Enter Login" value="<?= $data['login'] ?>">
        </div>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $data['email'] ?>">
    </div>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-10">
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
    </div>
    </div>
    <div class="form-group">
      <label for="exampleInputName" class="col-sm-2 control-label">Name</label>
         <div class="col-sm-10">
      <input type="name" class="form-control" id="name" name="name" placeholder="Name" value="<?= $data['name'] ?>">
         </div>
    </div>
                  <div class="form-group">
                      <label  class="col-sm-2 ">Surname</label>
                      <div class="col-sm-10">
                          <input type="surname" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?= $data['surname'] ?>">
                      </div>
                      <div class="form-group" class="radio">
                          <label for="input1" class="col-sm-6 control-label"></label>
                          <label>
                              <input type="radio" name="gender" id="optionsRadios1" value="male" checked> Male
                          </label>
                          <label>
                              <input type="radio" name="gender" id="optionsRadios1" value="female"> Female
                          </label>
                      </div>
                  </div>
              <button type="submit" name="do_sign" class="btn btn-primary col-sm-6">Registration</button>
      </div>
      </div>
      <h3 style="text-align: center ">Если Вы уже регистрировались, пройдите <a href="login.php">авторизацию</a>.</h3>
  </body>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>