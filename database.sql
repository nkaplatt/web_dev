CREATE DATABASE ecm2422_db;

DROP TABLE IF EXISTS `User_tbl`;
CREATE TABLE `User_tbl` (
 --MUser_ID VARCHAR (64) PRIMARY KEY,
 User_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
 User_Name VARCHAR(64), -- unique username
 User_Password VARCHAR(64), -- password for log in
 Logged_IN INT(1) DEFAULT '0' -- to tell site user is logged in (0 = no)
);

DROP TABLE IF EXISTS `Ships_tbl`;
CREATE TABLE `Ships_tbl` (
 Ship_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 Name VARCHAR(40),
 Year_Built INT(4),
 Capacity INT(7),
 Manufactorer VARCHAR(100),
 Operator VARCHAR(40),
 Image VARCHAR(40) -- stores image name, then references img in images folder
);

--- for wamp reloads
CREATE DATABASE ecm2422_db;

DROP TABLE IF EXISTS `User_tbl`;
CREATE TABLE `User_tbl` (
 User_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 User_Name VARCHAR(64),
 User_Password VARCHAR(64),
 Salt VARCHAR(16),
 Logged_IN INT(1) DEFAULT '0'
);

DROP TABLE IF EXISTS `Operator_tbl`;
CREATE TABLE `Operator_tbl` (
 Operator_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 Operator VARCHAR(40) NOT NULL
);

DROP TABLE IF EXISTS `Manufactor_tbl`;
CREATE TABLE `Manufactor_tbl` (
 Manufacturer_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 Manufacturer VARCHAR(70) NOT NULL
);

DROP TABLE IF EXISTS `Ships_tbl`;
CREATE TABLE `Ships_tbl` (
 Ship_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 Boat_Name VARCHAR(40) NOT NULL,
 Year_Built INT(4) NOT NULL,
 Capacity INT(7) NOT NULL,
 Manufacturer VARCHAR(70) NOT NULL,
 Operator VARCHAR(40) NOT NULL,
 FOREIGN KEY (Manufacturer) REFERENCES Manufactor_tbl(Manufacturer) ON UPDATE CASCADE,
 FOREIGN KEY (Operator) REFERENCES Operator_tbl(Operator) ON UPDATE CASCADE,
 Image VARCHAR(40) NOT NULL
);
