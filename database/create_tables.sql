CREATE TABLE `users` (
  `uwinid` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rating` double DEFAULT NULL,
  `upload_date` timestamp,
  `hasuploaded` boolean DEFAULT FALSE,
  PRIMARY KEY (`uwinid`)
);

CREATE TABLE `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `uwinid` varchar(20) NOT NULL,
  `commenters_uwinid` varchar(20) NOT NULL,
  `comment_date` timestamp NOT NULL,
  `comment_data` varchar(2048) NOT NULL,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`uwinid`) REFERENCES `users`(`uwinid`),
  FOREIGN KEY (`commenters_uwinid`) REFERENCES `users`(`uwinid`)
);
