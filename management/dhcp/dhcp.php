<?php
session_start();
function dhcp_manager($cmd) {
	return shell_exec("/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/manage.sh $cmd");
}

function dhcp_restart() {
	return shell_exec("sudo /opt/lampp/management/dhcp/generate.sh");
}

function dhcp_status() {
	return shell_exec("sudo systemctl status isc-dhcp-server");
}

function dhcp_host_add($name, $mac, $ip) {
	dhcp_manager("hosts add $name $mac $ip");
}

function dhcp_host_rm($id) {
	$id++;
	dhcp_manager("host rm $id");
}

function dhcp_hosts_get() {
	global $path;
	$response = "";
	$hosts = dhcp_manager("hosts get");
	$hosts = explode("\n", $hosts);
	for($i = 0; $i < count($hosts)-1; $i++) {
	 $host = explode(" ", $hosts[$i]);
	 $response .= "<tr>
					<td>{$host[0]}</td>
					<td>{$host[1]}</td>
					<td>{$host[2]}</td>
					<td>
					 <div onclick='dhcp_host_rm($i)'>Usuń</div>
					</td>
		     </tr>";
	}
	return $response;
}

function dhcp_range_add($beg, $end) {
	shell_exec("sudo echo '$beg $end' >> /opt/lampp/htdocs/linux-services-web-manager/management/dhcp/ranges.conf");
}

function dhcp_range_rm($id) {
	$id++;
	shell_exec("sudo sed -i '".$id."d' /etc/dhcp/conf_gen/ranges.conf");
}

function dhcp_ranges_get() {
	$response = "";
	$ranges = shell_exec("cat /etc/dhcp/conf_gen/ranges.conf");
	$ranges = explode("\n", $ranges);
	for($i = 0; $i < count($ranges)-1; $i++) {
	 $range = explode(" ", $ranges[$i]);
	 $response .= "<tr>
					<td>{$range[0]}</td>
					<td>{$range[1]}</td>
					<td>
					 <div onclick='dhcp_range_rm($i)'>Usuń</div>
					</td>
		     </tr>";
	}
	return $response;
}


if($_SESSION['admin']) {
	switch ($_GET['action']) {
		case 'host_add': dhcp_host_add($_GET['name'], $_GET['mac'], $_GET['ip']); echo dhcp_hosts_get(); dhcp_restart(); break;
		case 'host_rm': dhcp_host_rm($_GET['id']); echo dhcp_hosts_get(); dhcp_restart(); break;
		case 'range_add': dhcp_range_add($_GET['beg'], $_GET['end']); echo dhcp_ranges_get(); dhcp_restart(); break;
		case 'range_rm': dhcp_range_rm($_GET['id']); echo dhcp_ranges_get(); dhcp_restart(); break;
		case 'status': echo dhcp_status(); break;
		case 'host_get': echo dhcp_hosts_get(); break;
	}
}
?>
