#!/bin/bash

mysql -u testuser -ppassword <<EOF

#USE databaseName
USE testdb;

#Queries
SHOW tables;
show columns from testtable;

#EndOfFile
EOF

