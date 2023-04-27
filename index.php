<?php 
	include 'header.php';
?>
<section>
	<h1>Strona główna</h1>
	Status DHCP: <?=shell_exec("systemctl is-active isc-dhcp-server")?>
</section>
<?php include 'footer.php'; ?>
