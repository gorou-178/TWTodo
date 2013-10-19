<?php
/*

CREATE DATABASE `todo_php` DEFAULT CHARSET=utf8;
use `todo_php`

CREATE DATABASE `test_todo_php` DEFAULT CHARSET=utf8;
use `test_todo_php`

CREATE TABLE `todos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `order` INT(11) NOT NULL,
  `done` TINYINT(1) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `todos` VALUE
(1, 'ブログを書く', 1, 0, NOW(), NOW()),
(2, 'サンプルを作る', 2, 0, NOW(), NOW());


http://gurimmer.lolipop.jp/app/twido/tw/callback.php


https://api.twitter.com/1/
nOcbpjvl3jUnB7ipKw8Rg
ygjLuY2QPKUcKJsHgdApaliO1Ssn6U3SH55lDtYNs


create table users (
  id int not null auto_increment primary key,
  tw_user_id varchar(30) unique,
  tw_screen_name varchar(15),
  tw_access_token varchar(255),
  tw_access_token_secret varchar(255),
  created datetime,
  modified datetime
);

*/

define("CONSUMER_KEY", "nOcbpjvl3jUnB7ipKw8Rg");
define("CONSUMER_SECRET", "ygjLuY2QPKUcKJsHgdApaliO1Ssn6U3SH55lDtYNs");
define("SITE_URL", "http://gurimmer.lolipop.jp/app/twido/");

/*

create table users (
    id int(11) NOT NULL AUTO_INCREMENT,
    tw_user_id varchar(30),
    tw_screen_name varchar(15),
    tw_access_token varchar(255),
    tw_access_token_secret varchar(255),
    created datetime,
    modified datetime,
    PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `todos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `order` INT(11) NOT NULL,
  `done` TINYINT(1) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;


 */