# LOGIN-WITH-PHP
to setup your database 
in the connex.php file change the pdo parameters according to your database 
then create two tables in your database 
CREATE TABLE users  (
   name varchar(20) PRIMARY KEY ,
   email VARCHAR(128),
   password varchar(20));
CREATE TABLE autos (
   auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
   make VARCHAR(128),
   year INTEGER,
   mileage INTEGER
);
then to add a user so you can connect 
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('your_name', 'your_email@gmail.com', 'your_password');