#!/bin/bash

#ROOT
#mysql -u root -proot <<EOF
#TestUser
mysql -u testuser -ppassword <<EOF


#USE databaseName
USE testdb;

#Queries
SHOW tables;

#EndOfFile
EOF

