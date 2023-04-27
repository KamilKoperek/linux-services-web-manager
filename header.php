<?php
	session_start();
	if(!$blockRedirect && !$_SESSION['admin']) {
		header("Location: login.php");
	}
?>
<!doctype html> 
<html lang="pl">
<head>
	<title>Panel administracyjny serwera</title>
	<meta charset="UTF-8"/>
	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css"/>
</head>
<body>
	<header>
		<a href="logout.php">Wyloguj się</a>
		<a href="index.php">Strona główna</a>
		<a href="dhcp.php">DHCP</a>
	</header>
