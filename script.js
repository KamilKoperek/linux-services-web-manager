function dhcp_host_add() {
	var name = document.getElementById("dhcp_host_name")
	var mac = document.getElementById("dhcp_host_mac")
	var ip = document.getElementById("dhcp_host_ip")

	if(name.value != "" && mac.value != "" && ip.value != "") {
		var xmr = new XMLHttpRequest()
		xmr.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				name.value = ""
				mac.value = ""
				ip.value = ""
				document.getElementById("dhcp_hosts").innerHTML = this.response;
			}
		}
		xmr.open("GET", `management/dhcp/dhcp.php?action=host_add&name=${name.value}&mac=${mac.value}&ip=${ip.value}`, true);
		xmr.send();
	}
}

function dhcp_host_rm(id) {
	var xmr = new XMLHttpRequest()
	xmr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
			document.getElementById("dhcp_hosts").innerHTML = this.response;
	}
	xmr.open("GET", `management/dhcp/dhcp.php?action=host_rm&id=${id}`, true);
	xmr.send();
}


function dhcp_range_add() {
	var beg = document.getElementById("dhcp_range_beg")
	var end = document.getElementById("dhcp_range_end")

	if(beg.value != "" && end.value != "") {
		var xmr = new XMLHttpRequest()
		xmr.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				beg.value = ""
				end.value = ""
				document.getElementById("dhcp_ranges").innerHTML = this.response;
			}
		}
		xmr.open("GET", `management/dhcp/dhcp.php?action=range_add&beg=${beg.value}&end=${end.value}`, true);
		xmr.send();
	}
}

function dhcp_range_rm(id) {
	var xmr = new XMLHttpRequest()
	xmr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
			document.getElementById("dhcp_ranges").innerHTML = this.response;
	}
	xmr.open("GET", `management/dhcp/dhcp.php?action=range_rm&id=${id}`, true);
	xmr.send();
}



function dhcp_refresh(id) {
	var xmr = new XMLHttpRequest()
	xmr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
			document.getElementById("dhcp_status").innerHTML = this.response;
	}
	xmr.open("GET", `management/dhcp/dhcp.php?action=status`, true);
	xmr.send();
}
