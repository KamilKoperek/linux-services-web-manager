<?php
	include 'header.php';
	include 'management/dhcp/dhcp.php';
?>
<section>
	<h1>DHCP</h1>
	<pre id="dhcp_status"><?=shell_exec("systemctl status isc-dhcp-server")?></pre>
	<button onclick="dhcp_refresh()">Odśwież</button>
</section>
<section>
	<h2>Rezerwacje</h2>
	<table>
		<thead>
			<tr>
				<th>Nazwa</th>
				<th>MAC</th>
				<th>IP</th>
			</tr>
		</thead>
		<tbody id="dhcp_hosts">
			<?php  echo dhcp_hosts_get(); ?>
		</tbody>
	</table>
		<h3>Dodaj rezerwację</h3>
		<form action="javascript:void(0);">
		nazwa: <br><input type="text" id="dhcp_host_name" required/><br>
		MAC:   <br><input type="text" id="dhcp_host_mac" required/><br>
		IP:    <br><input type="text" id="dhcp_host_ip" required/><br>
		<input type="submit" value="dodaj" onclick="dhcp_host_add()"/>
	</form>
</section>
<section>
	<h2>Zakresy</h2>
	<table>
		<thead>
		<tr>
			<th>Początek</th>
			<th>Koniec</th>
		</tr>
		</thead>
		<tbody id="dhcp_ranges">
			<?=dhcp_ranges_get();?>
		</tbody>
	</table>
	<h3>Dodaj zakres</h3>
	<form action="javascript:void(0);">
	Adres początkowy: <br><input type="text" id="dhcp_range_beg" required/><br>
	adres końcowy:   <br><input type="text" id="dhcp_range_end" required/><br>
	<input type="submit" value="dodaj" onclick="dhcp_range_add()"/>
	</form>
</section>

<?php include 'footer.php';  ?>
