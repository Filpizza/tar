<?php
include('db.php');
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
<form>
    <div class="t">Поздравляем вы на фейсбуке</br> помогите нам лучше узнать вас</div>
<div class="container-fluid">
        <form method="post" class="form-horizontal" action="insert.php">
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputcountry" class="control-label">Country</label>
                <div>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?= $data['login'] ?>">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-md-2">
                <label for="exampleInputcity" class=" control-label">City</label>
                <div>
                    <input type="text" class="form-control" id="city" name="city" placeholder="city" value="<?= $data['email'] ?>">
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
</div></form>

</body>
</html>