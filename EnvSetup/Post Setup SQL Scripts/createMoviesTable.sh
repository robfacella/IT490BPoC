#!/bin/bash

#ROOT
#mysql -u root -proot <<EOF
#TestUser
mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;
#Uncomment if TableName already exists.
#DROP TABLE movies;
Create table movies (
	movieid int not null primary key auto_increment,
	title varchar(255) not null,
	year int not null,
	rated varchar(255) not null,
	released int not null,
  	genre varchar(255) not null,
 	actors varchar(255) not null,
  	poster varchar(255) not null
);
show columns from movies;
EOF
