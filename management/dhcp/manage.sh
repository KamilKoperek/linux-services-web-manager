#!/bin/bash
case "$1" in
  "generate")
    config="
    default-lease-time 600;
    \nmax-lease-time 7200;
    \nddns-update-style none;
    \n\nsubnet 10.10.10.0 netmask 255.255.255.0 {\n"
    config+=$(awk '{printf "	range %s %s;\\n", $1, $2}' /opt/lampp/htdocs/linux-services-web-manager/management/dhcp/ranges.conf)
    config+="}"
    config+=$(awk '{printf "\\n\\nhost %s {\\n hardware ethernet %s;\\n fixed-address %s;\\n}", $1, $2, $3}' /opt/lampp/htdocs/linux-services-web-manager/management/dhcp/hosts.conf)
    echo -e $config > /etc/dhcp/dhcpd.conf
    systemctl restart isc-dhcp-server
    systemctl is-active isc-dhcp-server
    ;;
  "hosts")
    case "$2" in
      "get")
        cat "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/hosts.conf"
        ;;
      "add")
        echo "$3 $4 $5" >> "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/hosts.conf"
        ;;
      "rm")
        sudo sed -i "$3d" "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/hosts.conf"
        ;;
    esac;;
  "ranges")
    case "$2" in
      "get")
        cat "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/ranges.conf"
        ;;
      "add")
        echo "$3 $4 $5" >> "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/ranges.conf"
        ;;
      "rm")
        sudo sed -i "$3d" "/opt/lampp/htdocs/linux-services-web-manager/management/dhcp/ranges.conf"
        ;;
    esac
esac
