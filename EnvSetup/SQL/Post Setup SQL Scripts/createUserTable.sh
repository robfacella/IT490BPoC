#!/bin/bash

#ROOT
mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF

USE testdb;

#SHOW tables;

#Uncomment if TableName already exists.
#DROP TABLE users;

CREATE TABLE IF NOT EXISTS users (
	userid int(10) not null primary key auto_increment,
	username varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null,
	friendslist varchar(255),
	favmovies varchar(255),
	stats float,
	wstats float,
	zip int(5)
);



show columns from users;

EOF

