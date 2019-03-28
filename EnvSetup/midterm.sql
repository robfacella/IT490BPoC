-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: testdb
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movies` (
  `movieid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `rated` varchar(255) NOT NULL,
  `released` varchar(255) DEFAULT NULL,
  `genre` varchar(255) NOT NULL,
  `actors` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `director` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`movieid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'Shaun of the Dead','2004','R','24 Sep 2004','Comedy','Simon Pegg, Nick Frost, Kate Ashfield','',NULL),(2,'Ghostbusters','1984','PG','08 Jun 1984','Action, Comedy, Fantasy','Bill Murray, Dan Aykroyd','',NULL),(3,'Up','2009','PG','29 May 2009','Animation, Adventure, Comedy, Family','Edward Asner, Christopher Plummer, Jordan Nagai, Bob Peterson','https://m.media-amazon.com/images/M/MV5BMTk3NDE2NzI4NF5BMl5BanBnXkFtZTgwNzE1MzEyMTE@._V1_SX300.jpg',NULL),(7,'Kill Bill: Vol. 2','2004','R','16 Apr 2004','Action, Crime, Thriller','Vivica A. Fox, Ambrosia Kelley, Michael Parks, James Parks','https://m.media-amazon.com/images/M/MV5BNmFiYmJmN2QtNWQwMi00MzliLThiOWMtZjQxNGRhZTQ1MjgyXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_SX300.jpg',NULL),(8,'Kill Bill: Vol. 1','2003','R','10 Oct 2003','Action, Crime, Thriller','Uma Thurman, Lucy Liu, Vivica A. Fox, Daryl Hannah','https://m.media-amazon.com/images/M/MV5BNzM3NDFhYTAtYmU5Mi00NGRmLTljYjgtMDkyODQ4MjNkMGY2XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',NULL),(10,'Away','2016','Not Rated','12 May 2017','Drama','Juno Temple, Matt Ryan, Timothy Spall, Susan Lynch','https://m.media-amazon.com/images/M/MV5BMTQ5NTc4NTE1MF5BMl5BanBnXkFtZTgwNzk4NTc2NTE@._V1_SX300.jpg',NULL),(11,'Pulp Fiction','1994','R','14 Oct 1994','Crime, Drama','Tim Roth, Amanda Plummer, Laura Lovelace, John Travolta','https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',NULL),(12,'Godfather','1991','Not Rated','15 Nov 1991','Comedy, Drama, Romance','N.N. Pillai, Mukesh, Kanaka, Philomina','https://m.media-amazon.com/images/M/MV5BZTkyYzc5MGEtYTBiYS00ZmYyLThlZWUtOWY3ZWE4ZDhlN2MzXkEyXkFqcGdeQXVyMjM0ODk5MDU@._V1_SX300.jpg',NULL),(13,'Clerks','1994','R','09 Nov 1994','Comedy','Brian O\'Halloran, Jeff Anderson, Marilyn Ghigliotti, Lisa Spoonauer','https://m.media-amazon.com/images/M/MV5BNzE1Njk0NmItNDhlMC00ZmFlLWI4ZTUtYTY4ZjgzNjkyMTU1XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(14,'The Princess Bride','1987','PG','09 Oct 1987','Adventure, Family, Fantasy, Romance','Cary Elwes, Mandy Patinkin, Chris Sarandon, Christopher Guest','https://m.media-amazon.com/images/M/MV5BMGM4M2Q5N2MtNThkZS00NTc1LTk1NTItNWEyZjJjNDRmNDk5XkEyXkFqcGdeQXVyMjA0MDQ0Mjc@._V1_SX300.jpg',NULL),(15,'Superman','1978','PG','15 Dec 1978','Action, Adventure, Drama, Sci-Fi','Marlon Brando, Gene Hackman, Christopher Reeve, Ned Beatty','https://m.media-amazon.com/images/M/MV5BMzA0YWMwMTUtMTVhNC00NjRkLWE2ZTgtOWEzNjJhYzNiMTlkXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SX300.jpg',NULL),(16,'Batman','1989','PG-13','23 Jun 1989','Action, Adventure','Michael Keaton, Jack Nicholson, Kim Basinger, Robert Wuhl','https://m.media-amazon.com/images/M/MV5BMTYwNjAyODIyMF5BMl5BanBnXkFtZTYwNDMwMDk2._V1_SX300.jpg',NULL),(17,'I Am Legend','2007','PG-13','14 Dec 2007','Drama, Horror, Sci-Fi, Thriller','Will Smith, Alice Braga, Charlie Tahan, Salli Richardson-Whitfield','https://m.media-amazon.com/images/M/MV5BYTE1ZTBlYzgtNmMyNS00ZTQ2LWE4NjEtZjUxNDJkNTg2MzlhXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',NULL),(18,'Cars 2','2011','G','24 Jun 2011','Animation, Adventure, Comedy, Family, Sport','Larry the Cable Guy, Owen Wilson, Michael Caine, Emily Mortimer','https://m.media-amazon.com/images/M/MV5BMTUzNTc3MTU3M15BMl5BanBnXkFtZTcwMzIxNTc3NA@@._V1_SX300.jpg',NULL),(19,'The Dark Knight','2008','PG-13','18 Jul 2008','Action, Crime, Drama, Thriller','Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine','https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg',NULL),(20,'Blade Runner','1982','R','25 Jun 1982','Sci-Fi, Thriller','Harrison Ford, Rutger Hauer, Sean Young, Edward James Olmos','https://m.media-amazon.com/images/M/MV5BNzQzMzJhZTEtOWM4NS00MTdhLTg0YjgtMjM4MDRkZjUwZDBlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',NULL),(21,'Django Unchained','2012','R','25 Dec 2012','Drama, Western','Jamie Foxx, Christoph Waltz, Leonardo DiCaprio, Kerry Washington','https://m.media-amazon.com/images/M/MV5BMjIyNTQ5NjQ1OV5BMl5BanBnXkFtZTcwODg1MDU4OA@@._V1_SX300.jpg',NULL),(22,'The Hateful Eight','2015','R','30 Dec 2015','Crime, Drama, Mystery, Thriller, Western','Samuel L. Jackson, Kurt Russell, Jennifer Jason Leigh, Walton Goggins','https://m.media-amazon.com/images/M/MV5BMjA1MTc1NTg5NV5BMl5BanBnXkFtZTgwOTM2MDEzNzE@._V1_SX300.jpg',NULL),(23,'Shaolin Soccer','2001','PG','12 Jul 2001','Action, Comedy, Fantasy, Sport','Stephen Chow, Man-Tat Ng, Wei Zhao, Yin Tse','https://m.media-amazon.com/images/M/MV5BZjdiYTBiMDUtNTg0Yy00N2NhLWIxZmEtMTEwNDNlYzRkMGY3L2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg',NULL),(24,'Reservoir Dogs','1992','R','02 Sep 1992','Crime, Drama, Thriller','Harvey Keitel, Tim Roth, Michael Madsen, Chris Penn','https://m.media-amazon.com/images/M/MV5BZmExNmEwYWItYmQzOS00YjA5LTk2MjktZjEyZDE1Y2QxNjA1XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(25,'Death Proof','2007','Not Rated','31 May 2007','Action, Thriller','Kurt Russell, ZoÃ« Bell, Rosario Dawson, Vanessa Ferlito','https://m.media-amazon.com/images/M/MV5BYTdmZmY3Y2QtNjU5NC00OGUxLTg3MWQtMmE2ODM5Mzg3MzcyL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg',NULL),(26,'Jackie Brown','1997','R','25 Dec 1997','Crime, Drama, Thriller','Pam Grier, Samuel L. Jackson, Robert Forster, Bridget Fonda','https://m.media-amazon.com/images/M/MV5BNmY5ODRmYTItNWU0Ni00MWE3LTgyYzUtYjZlN2Q5YTcyM2NmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',NULL),(27,'Garrow\'s Law: From Dawn to Dusk','2012','N/A','06 Feb 2012','Documentary, Short','N/A','N/A',NULL),(28,'Spirited Away','2001','PG','28 Mar 2003','Animation, Adventure, Family, Fantasy, Mystery','Rumi Hiiragi, Miyu Irino, Mari Natsuki, Takashi NaitÃ´','https://m.media-amazon.com/images/M/MV5BOGJjNzZmMmUtMjljNC00ZjU5LWJiODQtZmEzZTU0MjBlNzgxL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg',NULL),(29,'Dazed and Confused','1993','R','10 Feb 1994','Comedy','Jason London, Joey Lauren Adams, Milla Jovovich, Shawn Andrews','https://m.media-amazon.com/images/M/MV5BMTM5MDY5MDQyOV5BMl5BanBnXkFtZTgwMzM3NzMxMDE@._V1_SX300.jpg',NULL),(30,'Nacho Libre','2006','PG','16 Jun 2006','Comedy, Family, Sport','Jack Black, Ana de la Reguera, HÃ©ctor JimÃ©nez, Darius Rose','https://m.media-amazon.com/images/M/MV5BN2ZkNDgxMjMtZmRiYS00MzFkLTk5ZjgtZDJkZWMzYmUxYjg4XkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_SX300.jpg',NULL),(31,'Billy Madison','1995','PG-13','10 Feb 1995','Comedy','Adam Sandler, Darren McGavin, Bridgette Wilson-Sampras, Bradley Whitford','https://m.media-amazon.com/images/M/MV5BMzcyMjZmNjctNGNhMS00ZmQxLWFkNzQtYTIxYjVkYmU1NmNmXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(32,'School of Rock','2003','PG-13','03 Oct 2003','Comedy, Music','Jack Black, Adam Pascal, Lucas Papaelias, Chris Stack','https://m.media-amazon.com/images/M/MV5BMjEwOTMzNjYzMl5BMl5BanBnXkFtZTcwNjczMTQyMQ@@._V1_SX300.jpg',NULL),(33,'King Kong','2005','PG-13','14 Dec 2005','Action, Adventure, Drama, Romance','Naomi Watts, Jack Black, Adrien Brody, Thomas Kretschmann','https://m.media-amazon.com/images/M/MV5BMjYxYmRlZWYtMzAwNC00MDA1LWJjNTItOTBjMzlhNGMzYzk3XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(34,'Shrooms','2007','Not Rated','23 Nov 2007','Comedy, Horror, Mystery, Thriller','Lindsey Haun, Jack Huston, Max Kasch, Maya Hazen','https://m.media-amazon.com/images/M/MV5BOTQ3NGZhNjktMDNhOS00YzJiLWI1YjAtMDI5MzY1NzUxOGFiXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(35,'Toy Story','1995','G','22 Nov 1995','Animation, Adventure, Comedy, Family, Fantasy','Tom Hanks, Tim Allen, Don Rickles, Jim Varney','https://m.media-amazon.com/images/M/MV5BMDU2ZWJlMjktMTRhMy00ZTA5LWEzNDgtYmNmZTEwZTViZWJkXkEyXkFqcGdeQXVyNDQ2OTk4MzI@._V1_SX300.jpg',NULL),(36,'Toy Story 2','1999','G','24 Nov 1999','Animation, Adventure, Comedy, Family, Fantasy','Tom Hanks, Tim Allen, Joan Cusack, Kelsey Grammer','https://m.media-amazon.com/images/M/MV5BMWM5ZDcxMTYtNTEyNS00MDRkLWI3YTItNThmMGExMWY4NDIwXkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_SX300.jpg',NULL),(37,'Jumanji','1995','PG','15 Dec 1995','Adventure, Family, Fantasy','Robin Williams, Jonathan Hyde, Kirsten Dunst, Bradley Pierce','https://m.media-amazon.com/images/M/MV5BZTk2ZmUwYmEtNTcwZS00YmMyLWFkYjMtNTRmZDA3YWExMjc2XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(38,'Toy Story 3','2010','G','18 Jun 2010','Animation, Adventure, Comedy, Family, Fantasy','Tom Hanks, Tim Allen, Joan Cusack, Ned Beatty','https://m.media-amazon.com/images/M/MV5BMTgxOTY4Mjc0MF5BMl5BanBnXkFtZTcwNTA4MDQyMw@@._V1_SX300.jpg',NULL),(39,'Zumba','2016','N/A','23 Jun 2016','Short, Comedy','Stefanie Estes, Chase Fein','N/A',NULL),(40,'Dumb and Dumber','1994','PG-13','16 Dec 1994','Comedy','Jim Carrey, Jeff Daniels, Lauren Holly, Mike Starr','https://m.media-amazon.com/images/M/MV5BZDQwMjNiMTQtY2UwYy00NjhiLTk0ZWEtZWM5ZWMzNGFjNTVkXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(41,'Grown Ups','2010','PG-13','25 Jun 2010','Comedy','Adam Sandler, Kevin James, Chris Rock, David Spade','https://m.media-amazon.com/images/M/MV5BMjA0ODYwNzU5Nl5BMl5BanBnXkFtZTcwNTI1MTgxMw@@._V1_SX300.jpg',NULL),(42,'Happy Gilmore','1996','PG-13','16 Feb 1996','Comedy, Sport','Adam Sandler, Christopher McDonald, Julie Bowen, Frances Bay','https://m.media-amazon.com/images/M/MV5BZWI2NjliOTYtZjE1OS00YzAyLWJjYTQtYWNmZTQzMTQzNzVjXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(43,'Sharknado','2013','TV-14','11 Jul 2013','Action, Adventure, Comedy, Horror, Sci-Fi, Thriller','Ian Ziering, Tara Reid, John Heard, Cassandra Scerbo','https://m.media-amazon.com/images/M/MV5BODcwZWFiNTEtNDgzMC00ZmE2LWExMzYtNzZhZDgzNDc5NDkyXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(44,'Sharknado 2: The Second One','2014','TV-14','30 Jul 2014','Action, Adventure, Comedy, Horror, Sci-Fi, Thriller','Ian Ziering, Tara Reid, Vivica A. Fox, Mark McGrath','https://m.media-amazon.com/images/M/MV5BMjA0MTIxMDEwNF5BMl5BanBnXkFtZTgwMDk3ODIxMjE@._V1_SX300.jpg',NULL),(45,'The Longest Yard','2005','PG-13','27 May 2005','Comedy, Crime, Sport','Adam Sandler, Chris Rock, Burt Reynolds, Nelly','https://m.media-amazon.com/images/M/MV5BMTc1NTQyNDk2NV5BMl5BanBnXkFtZTcwOTE2OTQzMw@@._V1_SX300.jpg',NULL),(46,'Sharknado 3: Oh Hell No!','2015','TV-14','22 Jul 2015','Action, Adventure, Comedy, Horror, Sci-Fi, Thriller','Ian Ziering, Tara Reid, Cassandra Scerbo, Frankie Muniz','https://m.media-amazon.com/images/M/MV5BMTc5MDUzNzQzOF5BMl5BanBnXkFtZTgwMDg4NTYzNTE@._V1_SX300.jpg',NULL),(47,'The Waterboy','1998','PG-13','06 Nov 1998','Comedy, Sport','Adam Sandler, Kathy Bates, Henry Winkler, Fairuza Balk','https://m.media-amazon.com/images/M/MV5BNzJmZDZlMGItZGJhOC00Y2NjLTljNzctMDg5YmQ1NzU3NzYzL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(48,'Borat: Cultural Learnings of America for Make Benefit Glorious Nation of Kazakhstan','2006','R','03 Nov 2006','Comedy','Sacha Baron Cohen, Ken Davitian, Luenell, Chester','https://m.media-amazon.com/images/M/MV5BMTk0MTQ3NDQ4Ml5BMl5BanBnXkFtZTcwOTQ3OTQzMw@@._V1_SX300.jpg',NULL),(49,'Sharknado 4: The 4th Awakens','2016','TV-14','31 Jul 2016','Action, Adventure, Comedy, Horror, Sci-Fi, Thriller','Ian Ziering, Tara Reid, Masiela Lusha, Cody Linley','https://m.media-amazon.com/images/M/MV5BMWE5YWJhZWYtMzUwMy00MWUyLTkzZWEtYzVjY2M0YzVmZjQ3XkEyXkFqcGdeQXVyNTc5NTcxMTQ@._V1_SX300.jpg',NULL),(50,'Sharknado 5: Global Swarming','2017','TV-14','06 Aug 2017','Action, Adventure, Comedy, Fantasy, Horror, Sci-Fi, Thriller','Ian Ziering, Tara Reid, Cassandra Scerbo, Billy Barratt','https://m.media-amazon.com/images/M/MV5BMjQ3Mzk5NzAwNV5BMl5BanBnXkFtZTgwNDkwOTc3MjI@._V1_SX300.jpg',NULL),(51,'Pixels','2015','PG-13','24 Jul 2015','Action, Comedy, Sci-Fi','Adam Sandler, Kevin James, Michelle Monaghan, Peter Dinklage','https://m.media-amazon.com/images/M/MV5BMTYxMzM4NDY5N15BMl5BanBnXkFtZTgwNzg1NTI3MzE@._V1_SX300.jpg',NULL),(52,'Mr. Deeds','2002','PG-13','28 Jun 2002','Comedy, Romance','Adam Sandler, Winona Ryder, John Turturro, Allen Covert','https://m.media-amazon.com/images/M/MV5BMTU3NTE3M2QtNWQ0MS00ZmRkLWIwNTMtOTA0ZGM5N2UwMWNjL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(53,'American Pie','1999','R','09 Jul 1999','Comedy','Jason Biggs, Jennifer Coolidge, Shannon Elizabeth, Alyson Hannigan','https://m.media-amazon.com/images/M/MV5BMTg3ODY5ODI1NF5BMl5BanBnXkFtZTgwMTkxNTYxMTE@._V1_SX300.jpg',NULL),(54,'Teeth','2007','R','03 Apr 2008','Comedy, Fantasy, Horror, Thriller','Jess Weixler, John Hensley, Josh Pais, Hale Appleman','https://m.media-amazon.com/images/M/MV5BZjVjMjY4MzMtYzljNi00NDQ5LTk3NTYtNzY5NzYyY2FjZTZmXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(55,'Rubber','2010','R','10 Nov 2010','Comedy, Fantasy, Horror','Stephen Spinella, Jack Plotnick, Wings Hauser, Roxane Mesquida','https://m.media-amazon.com/images/M/MV5BZTY2NTY4MzctMWNkYy00NWM4LTliOWQtMWExZDU1ZWQxNTQxXkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_SX300.jpg',NULL),(56,'Precious','2009','R','20 Nov 2009','Drama','Gabourey Sidibe, Mo\'Nique, Paula Patton, Mariah Carey','https://m.media-amazon.com/images/M/MV5BMTk3NDM4ODMwNl5BMl5BanBnXkFtZTcwMTYyNDIzMw@@._V1_SX300.jpg',NULL),(57,'Pop','1996','N/A','N/A','Animation, Short','N/A','N/A',NULL),(58,'Cars','2006','G','09 Jun 2006','Animation, Comedy, Family, Sport','Owen Wilson, Paul Newman, Bonnie Hunt, Larry the Cable Guy','https://m.media-amazon.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX300.jpg',NULL),(59,'Chicken Little','2005','G','04 Nov 2005','Animation, Adventure, Comedy, Family, Fantasy, Sci-Fi','Zach Braff, Garry Marshall, Don Knotts, Patrick Stewart','https://m.media-amazon.com/images/M/MV5BMTcwMjMwNTA3MV5BMl5BanBnXkFtZTcwMjk4OTgyMQ@@._V1_SX300.jpg',NULL),(60,'Chicken Run','2000','G','23 Jun 2000','Animation, Adventure, Comedy, Drama, Family','Phil Daniels, Lynn Ferguson, Mel Gibson, Tony Haygarth','https://m.media-amazon.com/images/M/MV5BY2UyYjFkNzAtYzIyMC00MGI1LTlkNDktNzUyOGQ5NTI2ZGFjXkEyXkFqcGdeQXVyNTUyMzE4Mzg@._V1_SX300.jpg',NULL),(61,'Chicken','2015','N/A','20 May 2016','Drama','Scott Chambers, Morgan Watkins, Yasmin Paige, Kirsty Besterman','https://m.media-amazon.com/images/M/MV5BODY5ZTg2ZTEtZDE5ZS00YWY0LTgwYjYtNDQ2ZTljNjk5MWVlXkEyXkFqcGdeQXVyMTk1MTUyMDA@._V1_SX300.jpg',NULL),(62,'White Chicks','2004','PG-13','23 Jun 2004','Comedy, Crime','Shawn Wayans, Marlon Wayans, Jaime King, Frankie Faison','https://m.media-amazon.com/images/M/MV5BMTY3OTg2OTM3OV5BMl5BanBnXkFtZTYwNzY5OTA3._V1_SX300.jpg',NULL),(63,'Fast and Furious','1939','PASSED','06 Oct 1939','Comedy, Crime, Musical, Mystery','Franchot Tone, Ann Sothern, Ruth Hussey, Lee Bowman','https://m.media-amazon.com/images/M/MV5BMjAyNTQ1NjA3Ml5BMl5BanBnXkFtZTgwOTIyNjIxMzE@._V1_SX300.jpg',NULL),(64,'2 Fast 2 Furious','2003','PG-13','06 Jun 2003','Action, Crime, Thriller','Paul Walker, Tyrese Gibson, Eva Mendes, Cole Hauser','https://m.media-amazon.com/images/M/MV5BMzExYjcyYWMtY2JkOC00NDUwLTg2OTgtMDI3MGY2OWQzMDE2XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(65,'Bleep','2014','N/A','03 Sep 2014','Short, Comedy','Leandro Arvelo, Carla Baratta, Maria Antonieta Hidalgo, Leonidas Urbina','N/A',NULL),(66,'Epic Movie','2007','PG-13','26 Jan 2007','Adventure, Comedy','Kal Penn, Adam Campbell, Jennifer Coolidge, Jayma Mays','https://m.media-amazon.com/images/M/MV5BMTA3NDM5ODU3NzleQTJeQWpwZ15BbWU3MDgyMjgyNDE@._V1_SX300.jpg',NULL),(67,'Scary Movie','2000','R','07 Jul 2000','Comedy','Carmen Electra, Dave Sheridan, Frank B. Moore, Giacomo Baessato','https://m.media-amazon.com/images/M/MV5BMGEzZjdjMGQtZmYzZC00N2I4LThiY2QtNWY5ZmQ3M2ExZmM4XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(68,'Race to Witch Mountain','2009','PG','13 Mar 2009','Action, Adventure, Family, Fantasy, Sci-Fi, Thriller','Dwayne Johnson, AnnaSophia Robb, Alexander Ludwig, Carla Gugino','https://m.media-amazon.com/images/M/MV5BMzQ5MTM5NTU2NV5BMl5BanBnXkFtZTcwMDAzMjAyMg@@._V1_SX300.jpg',NULL),(69,'Kangaroo Jack','2003','PG','17 Jan 2003','Action, Adventure, Comedy, Crime, Family','Jerry O\'Connell, Anthony Anderson, Estella Warren, Christopher Walken','https://m.media-amazon.com/images/M/MV5BMTk1Njg5MjAyOV5BMl5BanBnXkFtZTYwNDAxMDg5._V1_SX300.jpg',NULL),(70,'Shrek','2001','PG','18 May 2001','Animation, Adventure, Comedy, Family, Fantasy','Mike Myers, Eddie Murphy, Cameron Diaz, John Lithgow','https://m.media-amazon.com/images/M/MV5BOGZhM2FhNTItODAzNi00YjA0LWEyN2UtNjJlYWQzYzU1MDg5L2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(71,'Home Alone','1990','PG','16 Nov 1990','Comedy, Family','Macaulay Culkin, Joe Pesci, Daniel Stern, John Heard','https://m.media-amazon.com/images/M/MV5BMzFkM2YwOTQtYzk2Mi00N2VlLWE3NTItN2YwNDg1YmY0ZDNmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg',NULL),(72,'Home Alone 2: Lost in New York','1992','PG','20 Nov 1992','Adventure, Comedy, Family','Macaulay Culkin, Joe Pesci, Daniel Stern, Catherine O\'Hara','https://m.media-amazon.com/images/M/MV5BNDI1MzM0Y2YtYmIyMS00ODE3LTlhZjEtZTUyNmEzMTNhZWU5XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(73,'Home Alone 3','1997','PG','12 Dec 1997','Comedy, Crime, Family','Alex D. Linz, Olek Krupa, Rya Kihlstedt, Lenny von Dohlen','https://m.media-amazon.com/images/M/MV5BZTJhYjVhOWMtYTUyOS00NWM0LThjNzYtZWYxOTkwN2FhODg2XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(74,'John Dies at the End','2012','R','25 Jan 2013','Comedy, Horror, Sci-Fi','Chase Williamson, Rob Mayes, Paul Giamatti, Clancy Brown','https://m.media-amazon.com/images/M/MV5BMTUyNzIyNzc0MV5BMl5BanBnXkFtZTcwOTM5ODg1OA@@._V1_SX300.jpg',NULL),(75,'Pineapple Express','2008','R','06 Aug 2008','Action, Comedy, Crime','Seth Rogen, James Franco, Danny McBride, Kevin Corrigan','https://m.media-amazon.com/images/M/MV5BMTY1MTE4NzAwM15BMl5BanBnXkFtZTcwNzg3Mjg2MQ@@._V1_SX300.jpg',NULL),(76,'Wreck-It Ralph','2012','PG','02 Nov 2012','Animation, Adventure, Comedy, Family, Fantasy','John C. Reilly, Sarah Silverman, Jack McBrayer, Jane Lynch','https://m.media-amazon.com/images/M/MV5BNzMxNTExOTkyMF5BMl5BanBnXkFtZTcwMzEyNDc0OA@@._V1_SX300.jpg',NULL),(77,'Wayne\'s World','1992','PG-13','14 Feb 1992','Comedy, Music','Mike Myers, Dana Carvey, Rob Lowe, Tia Carrere','https://m.media-amazon.com/images/M/MV5BMDAyNDY3MjUtYmJjYS00Zjc5LTlhM2MtNzgzYjNlOWVkZjkzL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',NULL),(78,'Bill & Ted\'s Excellent Adventure','1989','PG','17 Feb 1989','Adventure, Comedy, Music, Sci-Fi','Keanu Reeves, Alex Winter, George Carlin, Terry Camilleri','https://m.media-amazon.com/images/M/MV5BMTk3Mjk5MzI3OF5BMl5BanBnXkFtZTcwMTY4MzcyNA@@._V1_SX300.jpg',NULL),(79,'The Warriors','1979','R','09 Feb 1979','Action, Crime, Thriller','Michael Beck, James Remar, Dorsey Wright, Brian Tyler','https://m.media-amazon.com/images/M/MV5BYTU2MWRiMTMtYzAzZi00NGYzLTlkMDEtNWQ3MzZlNTJlNzZkL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SX300.jpg',NULL),(80,'Drunken Master II','1994','R','20 Oct 2000','Action, Comedy','Jackie Chan, Lung Ti, Anita Mui, Felix Wong','https://m.media-amazon.com/images/M/MV5BMjhhZDI4ZjItZjJkOS00NTJiLWJlNjMtOGI3Y2E3YzQ3MjNhXkEyXkFqcGdeQXVyMjUyNDk2ODc@._V1_SX300.jpg',NULL),(81,'Kung Pow: Enter the Fist','2002','PG-13','25 Jan 2002','Action, Comedy','Steve Oedekerk, Fei Lung, Leo Lee, Ling-Ling Hsieh','https://m.media-amazon.com/images/M/MV5BMGQxZDEwZDctMjNkMi00YmIxLTgyN2MtYmJhYjEzZGY0NjljXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(82,'The Hitchhiker\'s Guide to the Galaxy','2005','PG','29 Apr 2005','Adventure, Comedy, Sci-Fi','Bill Bailey, Anna Chancellor, Warwick Davis, Yasiin Bey','https://m.media-amazon.com/images/M/MV5BZmU5MGU4MjctNjA2OC00N2FhLWFhNWQtMzQyMGI2ZmQ0Y2YyL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg',NULL),(83,'Shrek 2','2004','PG','19 May 2004','Animation, Adventure, Comedy, Family, Fantasy, Romance','Mike Myers, Eddie Murphy, Cameron Diaz, Julie Andrews','https://m.media-amazon.com/images/M/MV5BMDJhMGRjN2QtNDUxYy00NGM3LThjNGQtMmZiZTRhNjM4YzUxL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',NULL),(84,'Elf','2003','PG','07 Nov 2003','Comedy, Family, Fantasy, Romance','Will Ferrell, James Caan, Bob Newhart, Edward Asner','https://m.media-amazon.com/images/M/MV5BMzUxNzkzMzQtYjIxZC00NzU0LThkYTQtZjNhNTljMTA1MDA1L2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg',NULL),(85,'The Emperor\'s New Groove','2000','G','15 Dec 2000','Animation, Adventure, Comedy, Family, Fantasy','David Spade, John Goodman, Eartha Kitt, Patrick Warburton','https://m.media-amazon.com/images/M/MV5BNzk1ZDcwY2YtMzRhZi00OTYwLTkzMmYtMGMwN2Y3ZjM1MTM0XkEyXkFqcGdeQXVyNTUyMzE4Mzg@._V1_SX300.jpg',NULL),(86,'Die Hard','1988','R','20 Jul 1988','Action, Thriller','Bruce Willis, Bonnie Bedelia, Reginald VelJohnson, Paul Gleason','https://m.media-amazon.com/images/M/MV5BZjRlNDUxZjAtOGQ4OC00OTNlLTgxNmQtYTBmMDgwZmNmNjkxXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',NULL),(87,'Full Metal Jacket','1987','R','10 Jul 1987','Drama, War','Matthew Modine, Adam Baldwin, Vincent D\'Onofrio, R. Lee Ermey','https://m.media-amazon.com/images/M/MV5BNzkxODk0NjEtYjc4Mi00ZDI0LTgyYjEtYzc1NDkxY2YzYTgyXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',NULL),(88,'Mission: Impossible - Ghost Protocol','2011','PG-13','21 Dec 2011','Action, Adventure, Thriller','Tom Cruise, Paula Patton, Simon Pegg, Jeremy Renner','https://m.media-amazon.com/images/M/MV5BMTY4MTUxMjQ5OV5BMl5BanBnXkFtZTcwNTUyMzg5Ng@@._V1_SX300.jpg',NULL),(89,'Space Jam','1996','PG','15 Nov 1996','Animation, Adventure, Comedy, Family, Fantasy, Sci-Fi, Sport','Michael Jordan, Wayne Knight, Theresa Randle, Manner Washington','https://m.media-amazon.com/images/M/MV5BMDgyZTI2YmYtZmI4ZC00MzE0LWIxZWYtMWRlZWYxNjliNTJjXkEyXkFqcGdeQXVyNjY5NDU4NzI@._V1_SX300.jpg',NULL),(90,'Animaniacs: Wakko\'s Wish','1999','Unrated','21 Dec 1999','Animation, Adventure, Comedy, Drama, Family, Fantasy, Musical','Rob Paulsen, Jess Harnell, Tress MacNeille, Maurice LaMarche','https://m.media-amazon.com/images/M/MV5BODk4NDE1MDEzMl5BMl5BanBnXkFtZTgwMzAxOTk1MDE@._V1_SX300.jpg',NULL);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `userid` int(10) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `rating` int(100) DEFAULT NULL,
  PRIMARY KEY (`userid`,`genre`),
  CONSTRAINT `FK_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (13,'Action',2),(13,'Animation',4),(13,'Drama',2);
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testtable`
--

DROP TABLE IF EXISTS `testtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testtable` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testtable`
--

LOCK TABLES `testtable` WRITE;
/*!40000 ALTER TABLE `testtable` DISABLE KEYS */;
/*!40000 ALTER TABLE `testtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `friendslist` varchar(255) DEFAULT NULL,
  `favmovies` text,
  `stats` float DEFAULT NULL,
  `wstats` float DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'admin','admin@bpoc.com','nimda','DJ','Blade Runner',NULL,NULL),(11,'adam','adam@adam.adam','adam','adam','Django Unchained, The Hateful Eight, inglourious bastards, Reservoir Dogs, Death Proof, Jackie Brown, Garrow\'s Law: From Dawn to Dusk, nacho libre, Billy Madison, School of Rock, King Kong, Jumanji, Grown Ups, Happy Gilmore, The Longest Yard, The Waterboy, Borat: Cultural Learnings of America for Make Benefit Glorious Nation of Kazakhstan, Pixels, Mr. Deeds, Fast and Furious, 2 Fast 2 Furious, Pineapple Express, Wreck-It Ralph',NULL,NULL),(12,'DanClark','dclark@pass.net','dclark',NULL,'Shrooms, Toy Story, Toy Story 2, Toy Story 3, Zumba, Dumb and Dumber, Sharknado, Sharknado 2: The Second One, Sharknado 3: Oh Hell No!, Sharknado 4: The 4th Awakens, Sharknado 5: Global Swarming, American Pie, Teeth, Rubber, Precious, Pop, Cars, Chicken Little, Chicken Run, Chicken, White Chicks, Bleep, Epic Movie, Scary Movie, Race to Witch Mountain, Kangaroo Jack, Shrek, Home Alone, Home Alone 2: Lost in New York, Home Alone 3',NULL,NULL),(13,'Rob','rob@bpoc.net','tacos',NULL,'Wayne\'s World, Clerks, Bill & Ted\'s Excellent Adventure, John Dies at the End, Spirited Away, Shaolin Soccer, The Warriors, Drunken Master II, Kung Pow: Enter the Fist, The Princess Bride, The Hitchhiker\\\'s Guide to the Galaxy, Shrek, Shrek 2, Elf, Kill Bill: Vol. 1, Shrek, The Emperor\\\'s New Groove, Die Hard, Full Metal Jacket, Mission: Impossible - Ghost Protocol, Mission: Impossible - Ghost Protocol, Space Jam, Space Jam, Space Jam, Animaniacs: Wakko\\\'s Wish',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-27 22:27:36
