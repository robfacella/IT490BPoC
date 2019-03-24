#!/bin/bash

#ROOT
#mysql -u root -proot <<EOF
#TestUser
mysql -u testuser -ppassword <<EOF

USE testdb;

#SHOW tables;

#Uncomment if TableName already exists.
#DROP TABLE users;

CREATE TABLE IF NOT EXISTS users (
	userid int not null primary key auto_increment,
	username varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null
);

#friends table
#SQL commands and PHP found here https://www.codedodle.com/2014/12/social-network-friends-database.html
CREATE TABLE IF NOT EXISTS relationship (
  user_one_id INT(10) UNSIGNED NOT NULL,
  user_two_id INT(10) UNSIGNED NOT NULL,
  status TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  action_user_id INT(10) UNSIGNED NOT NULL,
  FOREIGN KEY (`user_one_id`) REFERENCES users(`userid`),
  FOREIGN KEY (`user_two_id`) REFERENCES users(`userid`),
  FOREIGN KEY (`action_user_id`) REFERENCES users(`userid`)
) 

ALTER TABLE `relationship`
ADD UNIQUE KEY `unique_users_id` (`user_one_id`,`user_two_id`);

show columns from users;
show columns from relationship;

EOF

