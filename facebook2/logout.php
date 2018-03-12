<?php

	include('db.php');

	unset($_SESSION['logged_user']);
	if(isset($_COOKIE['name']) and isset($_COOKIE['password'])) {
		$name = $_COOKIE['name'];
		$pass = $_COOKIE['password'];
		setcookie('name', $name, time() - 1);
		setcookie('password', $pass, time() - 1);
	}

	header('Location: index.php');