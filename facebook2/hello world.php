<?php
include('db.php');
$data = $_POST;
if(isset($data['do_sign'])) {
    $country = htmlspecialchars(trim($data['country']));
    $city = htmlspecialchars(trim($data['city']));
    $date = htmlspecialchars($data['date']);
    $college = htmlspecialchars(trim($data['college']));
    $interest = htmlspecialchars(trim($data['interst']));
    echo $date;
    $CreateSql ="update `user` set date='$date'  WHERE `id_access`= (select id  from access WHERE login='y');";
    mysqli_query($link, $CreateSql) or die(mysqli_error($link));
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
<style>
body {
background: url(http://www.kartinkijane.ru/pic/201305/2560x1440/kartinkijane.ru-41051.jpg);
-moz-background-size: 100%; /* Firefox 3.6+ */
-webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
-o-background-size: 100%; /* Opera 9.6+ */
background-size: 100%; /* Современные браузеры */
}
.t {
    color: #373B41;
    font-size: 30px;
    font-weight: bold;
    text-shadow: 3px 3px 0px #fff;
</style>
<body>
    <div class="t">Поздравляем вы на фейсбуке</br> помогите нам лучше узнать вас</div>
<div class="container-fluid">
    <form method="post" class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>"">
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputcountry" class="control-label">Country</label>
                <div>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" >
                </div>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputcity" class=" control-label">City</label>
                <div>
                    <input type="text" class="form-control" id="city" name="city" placeholder="city">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-md-2">
                <div>
                    <label for="exampleInputdate" class="control-label">date of birth</label>
                    <input type="text" class="form-control" id="date" name="date" placeholder="date">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputcollege" class=" control-label">college</label>
                <div>
                    <input type="text" class="form-control" id="college" name="college" placeholder="college">
                </div>
            </div></div>
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputinterest" class=" control-label">interest</label>
                <div>
                    <input type="text" class="form-control" id="interest" name="interest" placeholder="interest">
                </div>
            </div></div>
            <div>
                <button type="submit" name="do_sign" class="btn btn-primary col-md-1 ">send</button>
                </div>
</div>
</form>
</body>
</html>

