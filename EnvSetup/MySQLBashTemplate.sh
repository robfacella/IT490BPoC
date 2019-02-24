#!/bin/bash

mysql -u root -proot <<EOF

#USE databaseName
USE mysql

#Queries
SHOW tables

#EndOfFile
EOF

