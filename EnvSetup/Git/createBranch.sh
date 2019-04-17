#!/bin/bash



sudo git pull

#gets most recent QA branch
CURRBRANCH=$(git branch -a | grep remotes/origin/QA* | sort -rn | head -n 1 | cut -d/ -f3)

echo The current branch is $CURRBRANCH
SUBVER=$(echo "$CURRBRANCH" | cut -c 5-)
VER=$(echo "$CURRBRANCH" | cut -c 3- | sed 's/.\{3\}$//')
while true; do	
	read -p  "You are on version $VER. Is this a major revision?[Y/N]" yn
	case $yn in
		[Yy]* ) VER=$(($VER+1))
			SUBVER=0
			break;;
		[Nn]* ) break;;
		* ) echo "please answer y or n";;
	esac
done

while true; do	
	read -p  "You are on sub version $SUBVER. Would you like to make a new sub version? [Y/N]" yn
	case $yn in
		[Yy]* ) SUBVER=$(($SUBVER+1))
			if (($SUBVER < 9))
			then
				SUBVER=0$SUBVER
			fi
			break;;
		[Nn]* ) break;;
		* ) echo "please answer y or n";;
	esac
done

#create new branch here
NEWBRANCH=QA$VER.$SUBVER
echo $NEWBRANCH
exit

#creates a new branch
git checkout -b $NEWBRANCH
git push origin $NEWBRANCH

