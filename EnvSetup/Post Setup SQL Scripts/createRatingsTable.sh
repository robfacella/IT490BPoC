
#!/bin/bash

#ROOT
mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;

#rating table
CREATE TABLE IF NOT EXISTS ratings (
    userid varchar(255) NOT NULL,
    genre varchar(255) NOT NULL,
    rating int(11),
    FOREIGN KEY (userid) REFERENCES users(userid), 
    FOREIGN KEY (genre) REFERENCES movies(genre),
    PRIMARY KEY (userid, genre)
);

show columns from ratings;
EOF

