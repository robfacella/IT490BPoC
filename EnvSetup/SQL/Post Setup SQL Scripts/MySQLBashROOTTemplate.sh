#!/bin/bash

mysql -u root -proot <<EOF

#USE databaseName
USE testdb;

#Queries
SHOW tables;

#EndOfFile
EOF

