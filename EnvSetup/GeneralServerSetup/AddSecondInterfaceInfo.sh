#AddSecondInterface.sh adds these lines to the end of "/etc/network/interfaces" file
#Will require root/sudo permissions.
#Change the Static IP for each Unique host this is run on.
echo " " #New Line for Neatness
echo "#Bridged Interface"
echo "auto enp0s8"
echo "iface enp0s8 inet static"
######################################################
echo "address 192.168.8.115" #Change This per Machine#
######################################################
echo "netmask 255.255.255.0"
echo "gateway 192.168.8.1"
