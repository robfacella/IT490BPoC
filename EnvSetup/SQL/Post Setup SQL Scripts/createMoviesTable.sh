#!/bin/bash

#ROOT
sudo mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;
#Uncomment if TableName already exists.
#DROP TABLE movies;
Create table movies (
	movieid int not null primary key auto_increment,
	title varchar(255) not null,
	year int not null,
	rated varchar(255) not null,
	released varchar(255) not null,
  	genre varchar(255) not null,
 	actors varchar(255) not null,
  	poster varchar(255) not null
);

INSERT INTO movies (title, year, rated, released, genre, actors, poster) VALUES
('Shaun of the Dead', 2004, '7.9', 2004, 'Comedy', 'Simon Pegg, Nick Frost, Kate Ashfield', ''),
('Hot Fuzz', 2007, '7.9', 2007, 'Comedy', 'Simon Pegg, Nick Frost, Martin Freeman', '');

select * from movies;
EOF
