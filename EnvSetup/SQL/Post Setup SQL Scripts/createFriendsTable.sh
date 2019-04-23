
#!/bin/bash

#ROOT
mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;
#rating table
CREATE TABLE IF NOT EXISTS friends (
    userid int(10) NOT NULL,
    friendid int(10) NOT NULL,
    PRIMARY KEY (userid, friendid),
    CONSTRAINT FK_user FOREIGN KEY (userid) REFERENCES users(userid),
    CONSTRAINT FK_friend FOREIGN KEY (friendid) REFERENCES users(userid)
);
show columns from friends;
EOF
