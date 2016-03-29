CREATE TABLE `testid` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `commenters_uwinid` varchar(20) NOT NULL,
  `commenters_fullname` varchar(50) NOT NULL,
  `comment_date` timestamp NOT NULL,
  `comment_data` varchar(2048) NOT NULL,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`commenters_uwinid`) REFERENCES `users`(`uwinid`)
);


INSERT INTO `users` (
  `uwinid`,
  `fullname`,
  `password`)
  VALUES (
  'testid',
  'Bob Loblaw',
  'aBcryptHash'
);
