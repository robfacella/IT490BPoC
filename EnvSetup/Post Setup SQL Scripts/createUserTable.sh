#!/bin/bash

#ROOT
#mysql -u root -proot <<EOF
#TestUser
mysql -u testuser -ppassword <<EOF

USE testdb;

#SHOW tables;

#Uncomment if TableName already exists.
#DROP TABLE users;

Create table users (
	userid int not null primary key auto_increment,
	username varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null
);
show columns from users;

EOF

