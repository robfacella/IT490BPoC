<?php
#logfile tries to open testlog.txt and if it doesn't exist it is created.
#the "a" parameter is for appending to the file (write mode with the pointer at the EOF)
$logfile = fopen("testlog.txt", "a") or die("Unable to open Log!!");

#probably passed to function as w/ever message(s) the broker needs to log.
$msg = "Public Service Announcement: This is only a test.\n";

#logMsg would be a timestamp + the message which the server is logging... should server or log itself generate the time stamp? may be a moot point.
$logMsg = 'Date['. date('Y-m-d') .'] Time['. date('H:i:s') .']: '."$msg"."\n";

#Writes to EOF.
fwrite($logfile, $logMsg);
#Save/Close File.
fclose($logfile);
?>
