
#!/bin/bash

#ROOT
mysql -u root -proot <<EOF
#TestUser
#mysql -u testuser -ppassword <<EOF
USE testdb;
#SHOW tables;

#rating table
CREATE TABLE IF NOT EXISTS ratings (
   ratingid INT(11)
   ruser INT(11),
   rmovie INT(11),
   rating float,
   PRIMARY KEY (ruser, rmovie)),
   CONSTRAINT FK_user FOREIGN KEY (PersonID)
   REFERENCES Persons(PersonID)

show columns from ratings;
EOF

