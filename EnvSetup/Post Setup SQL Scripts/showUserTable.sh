#!/bin/bash

#ROOT
#mysql -u root -proot <<EOF
#TestUser
mysql -u testuser -ppassword <<EOF

USE testdb;

SHOW tables;

show columns from users;

SELECT * FROM users;

EOF

