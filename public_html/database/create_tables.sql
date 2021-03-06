CREATE TABLE IF NOT EXISTS `users` (
  `uwinid` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rating` double DEFAULT NULL,
  `upload_date` timestamp DEFAULT CURRENT_TIMESTAMP,
  `hasuploaded` boolean DEFAULT FALSE,
  `description` varchar(2048),
  PRIMARY KEY (`uwinid`)
);
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `uwinid` varchar(20) NOT NULL,
  `commenters_uwinid` varchar(20) NOT NULL,
  `comment_date` timestamp NOT NULL,
  `comment_data` varchar(2048) NOT NULL,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`uwinid`) REFERENCES `users`(`uwinid`),
  FOREIGN KEY (`commenters_uwinid`) REFERENCES `users`(`uwinid`)
);

CREATE TABLE IF NOT EXISTS `ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `uwinid` varchar(20) NOT NULL,
  `raters_uwinid` varchar(20) NOT NULL,
  `rating` double NOT NULL,
  PRIMARY KEY (`rating_id`),
  FOREIGN KEY (`uwinid`) REFERENCES `users`(`uwinid`),
  FOREIGN KEY (`raters_uwinid`) REFERENCES `users`(`uwinid`)
);
