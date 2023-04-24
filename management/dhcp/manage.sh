#!/bin/bash
path = "/opt/lampp/htdocs/linux-services-web-manager";
case "$1" in
  "generate")
    config="
    default-lease-time 600;
    \nmax-lease-time 7200;
    \nddns-update-style none;
    \n\nsubnet 10.0.0.0 netmask 255.255.255.0 {\n"
    config+=$(awk '{printf "	range %s %s;\\n", $1, $2}' /etc/dhcp/conf_gen/ranges.conf)
    config+="}"
    config+=$(awk '{printf "\\n\\nhost %s {\\n hardware ethernet %s;\\n fixed-address %s;\\n}", $1, $2, $3}' /etc/dhcp/conf_gen/hosts.conf)
    echo -e $config > /etc/dhcp/dhcpd.conf
    systemctl restart isc-dhcp-server
    systemctl is-active isc-dhcp-server
    ;;
  "hosts")
    case "$2" in
      "get")
        cat "$path/manage/dhcp/hosts.conf"
        ;;
    esac
esac
