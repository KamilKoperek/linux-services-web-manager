<?php 
	include 'header.php';
?>
<h1>Strona główna</h1>
Status DHCP: <?=shell_exec("systemctl is-active isc-dhcp-server")?>
<?php include 'footer.php'; ?>
