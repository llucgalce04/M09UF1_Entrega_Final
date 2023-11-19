DROP DATABASE IF EXISTS masaoweb;
CREATE DATABASE masaoweb;
USE masaoweb;

DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS user_admins;
DROP TABLE IF EXISTS blog;

CREATE TABLE comments (
id_comment INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
uuid_comment CHAR(36) NOT NULL UNIQUE DEFAULT uuid(), 
name varchar(32) NOT NULL, 
email varchar(32) NOT NULL, 
phone varchar(16) NOT NULL, 
comment text NOT NULL, 
`date` datetime default now()
);

CREATE TABLE users (
id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
name VARCHAR(255) NOT NULL, 
email VARCHAR(255) NOT NULL, 
password VARCHAR(255) NOT NULL, 
`date` datetime default now()
); 

CREATE TABLE user_admins ( 
id_user_admin INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
id_user INT UNSIGNED NOT NULL, 
FOREIGN KEY (id_user) REFERENCES users(id_user) 
);

CREATE TABLE blog (
id_entry INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
title VARCHAR(255) NOT NULL,
text_entry TEXT NOT NULL,
date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
user_id INT UNSIGNED NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id_user)
);

/* 
-----CREAR USUARIO DE LA BDD ----
CREATE user 'masao'@'localhost' IDENTIFIED BY 'masao';
GRANT all privileges on *.* to 'masao'@localhost;
flush privileges;*/


INSERT INTO comments (name, email, phone, comment) VALUES ('Tara', 'tarita@gmail.com', '666 666 666', 'El TT tara');
INSERT INTO users (name, email, password) VALUES ('Lluc', 'llucgalce@gmail.com', 'Enti.');
INSERT INTO user_admins (id_user) VALUES (1);
INSERT INTO blog (title, text_entry, user_id) VALUES ('Título del Post', 'Contenidos del Post', 1);

