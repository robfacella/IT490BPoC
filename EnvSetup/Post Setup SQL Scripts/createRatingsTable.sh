
#!/bin/bash

#ROOT
mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;

#rating table
CREATE TABLE IF NOT EXISTS ratings (
    userid int(10) NOT NULL,
    genre varchar(255) NOT NULL,
    rating int(11),
    PRIMARY KEY (userid, genre),
    CONSTRAINT FK_user FOREIGN KEY (userid) REFERENCES users(userid)
);

show columns from ratings;
EOF

