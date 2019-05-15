#AddSecondInterface.sh adds these lines to the end of "/etc/network/interfaces" file
#Will require root/sudo permissions.
#Change the Static IP for each Unique host this is run on.

#Copy to append to.
#echo " " #New Line for Neatness
#echo "#Bridged Interface"
#echo "auto enp0s8"
#echo "iface enp0s8 inet static"
######################################################
#echo "address 192.168.8.115" #Change This per Machine#
######################################################
#echo "netmask 255.255.255.0"
#echo "gateway 192.168.8.1"


#Copy from Working Server Setup. Replace with
echo "#Loopback Interface"
echo "auto lo"
echo "iface lo inet loopback"
echo " " #New Line
echo "#NAT Interface - Which we don't want starting at boot. But do want available maybe."
echo "#auto enp0s3"
echo "iface enp0s3 inet dhcp"
echo " " #New Line
echo "#Bridged Interface - Which we DO want starting on boot."
echo "auto enp0s8"
echo "iface enp0s8 inet static"
#############################################################################################
echo "#Did you forget to change the static IP for this machine? Do it below."
echo "address 192.168.8.116" # <-- Don't forget to set this.
#######################################################################################
echo "netmask 255.255.255.0"
echo "gateway 192.168.8.1"

#Attempt to Resolve lack of internet despite being on the router network
echo "dns-nameservers 8.8.8.8"
