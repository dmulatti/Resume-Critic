CREATE TABLE `users` (
  `uwinid` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `rating` double DEFAULT NULL,
  `upload_date` timestamp,
  `hasuploaded` boolean DEFAULT FALSE,
  PRIMARY KEY (`uwinid`)
);
