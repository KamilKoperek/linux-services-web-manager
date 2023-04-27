<?php 
$blockRedirect = true;
include 'header.php'; ?>
<script>
	document.getElementsByTagName("header")[0].remove()
</script>
<section>
	<h1>Logowanie</h1>
	<form action="" method="GET">
		login: <br><input type="text" name="login"/><br>
		hasło:   <br><input type="password" name="password"/><br>
		<input type="submit" value="Zaloguj się"/>
	</form>
</section>
<?php 
	if($_GET['login'] == 'admin' && password_verify($_GET['password'], '$2y$10$Jlopq.wAwRbd0LOWAetZ6uESaTK2x8c7WovKAxG13oT2XL4IM.PMa')) {
		$_SESSION['admin'] = true;
		header("Location: index.php");
	}
	include 'footer.php';
?>
