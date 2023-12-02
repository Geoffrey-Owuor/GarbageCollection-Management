CREATE DATABASE envneat;

CREATE TABLE `envneat`.`users` 
(`user_id` BIGINT NOT NULL PRIMARY KEY, 
`username` VARCHAR(50) NOT NULL , 
`email` VARCHAR(50) NOT NULL , 
`date` TIMESTAMP,
`password` VARCHAR(20) NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `envneat`.`admin` 
(`admin_name` VARCHAR(50) NOT NULL , 
`admin_id` BIGINT NOT NULL PRIMARY KEY, 
`admin_email` VARCHAR(50) NOT NULL , 
`password` VARCHAR(20) NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `envneat`.`collectors` 
(`collector_name` VARCHAR(50) NOT NULL , 
`collector_email` VARCHAR(20) NOT NULL , 
`password` VARCHAR(20) NOT NULL , 
`collector_id` BIGINT NOT NULL PRIMARY KEY) ENGINE = InnoDB;

CREATE TABLE `envneat`.`trucks` 
(`vehicle_id` VARCHAR(20) NOT NULL PRIMARY KEY, 
FOREIGN KEY(`collector_id`) REFERENCES collectors(`collector_id`),
`license_id` VARCHAR(20) NOT NULL,
`collector_id` BIGINT NOT NULL ) ENGINE = InnoDB; 


CREATE TABLE `envneat`.`orders` 
(`id` BIGINT  NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`phone_number` VARCHAR(50) NOT NULL,
`location` VARCHAR(50) NOT NULL , 
`user_id` BIGINT NOT NULL , 
`payment_code` VARCHAR(20) NOT NULL , 
`house_address` VARCHAR(50) NOT NULL,
`collection_date` DATETIME,
`collector_id` BIGINT NOT NULL,
`vehicle_id` varchar(20) NOT NULL,
`status` varchar(10) NOT NULL,
FOREIGN KEY(`user_id`) REFERENCES users(`user_id`),
`collection_status` varchar(15) NOT NULL,
`date` TIMESTAMP) ENGINE = InnoDB;


CREATE TABLE `envneat`.`feedback` 
(`reply_id` BIGINT  NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` BIGINT NOT NULL , 
`email` VARCHAR(20) NOT NULL , 
FOREIGN KEY(`user_id`) REFERENCES users(`user_id`),
`info` VARCHAR(2000) NOT NULL,
`reply_status` VARCHAR(10) NOT NULL,
`reply` VARCHAR(2000) NOT NULL )ENGINE = InnoDB;

INSERT INTO `envneat`.`admin`(`admin_id`, `admin_name`, `admin_email`, `password`)
VALUES
(3451267,'admin','admin@gmail.com','1234'); 

INSERT INTO `envneat`.`users` (`username`, `email`, `password`, `date`, `user_id`) VALUES
('sharon', 'sharon@yahoo.com', '1234', '2023-10-20 22:02:25', 4533),
('geoffrey', 'geoff@gmail.com', 'geoff@1', '2023-10-20 21:59:43', 7165),
('sia', 'siak@gmail.com', '1234', '2023-10-24 13:59:35', 461245),
('angela', 'angie@outlook.com', '1234', '2023-10-20 22:34:16', 1026549),
('junkook', 'junkook@gmail.com', '1234', '2023-10-31 12:34:15', 2188139);

INSERT INTO `envneat`.`collectors` (`collector_name`, `collector_email`, `password`, `collector_id`) VALUES
('sean', 'sean@yahoo.com', 'sean@1', 5037),
('bruno', 'bruno1@gmail.com', '1234', 6955),
('jeffrey', 'damer@gmail.com', '123', 9662),
('diego', 'diego@outlook.com', '1234', 9701),
('miriam', 'miriam@outlook.com', '1234', 82306),
('jane', 'jane12@gmail.com', '1234', 1102719),
('consolata', 'consolata@gmail.com', '1234', 4052875);

INSERT INTO `envneat`.`trucks` (`vehicle_id`, `collector_id`, `license_id`) VALUES
('TRK001', 5037, 'LSN001'),
('TRK002', 6955, 'LSN002'),
('TRK003', 5037, 'LSN003'),
('TRK004', 9701, 'LSN004');