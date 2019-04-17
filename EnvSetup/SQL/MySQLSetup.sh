#!/bin/bash
#Should only be run once; sets up testdb and table as per in-class example.

sudo mysql -u root -proot <<EOF

#Create TestDB & TestUser
create database testdb;
create user 'testuser'@'localhost' identified by 'password';
grant all privileges on testdb.* to 'testuser'@'localhost';
flush privileges;

#Using testdb create testtable and show the columns.
Use testdb;
Create table testtable (
	userid int not null primary key auto_increment,
	username varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null
);
show columns from testtable;

#EndOfFile
EOF

