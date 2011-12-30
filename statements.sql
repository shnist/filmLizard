create database films;
use films;

# table for films
create table film (id int(3) primary key not null auto_increment,
title varchar(40) not null,
certificate varchar(5),
releaseDate varchar(4),
poster varchar(200),
location varchar(20) not null,
rating double,
constraint location check (location = 'home' || location = 'university')) character set utf8 collate utf8_general_ci engine=InnoDB;

# tables for genres
create table genre (id int(2) primary key not null auto_increment,
genre varchar(30)) character set utf8 collate utf8_general_ci engine=InnoDB;

# table for actors
create table actor (id int(2) primary key not null auto_increment,
name varchar(30)) character set utf8 collate utf8_general_ci engine=InnoDB;

# associative table between genre and films
create table genreFilm (genreId int(2),
filmId int(2),
foreign key (genreId) references genre(id),
foreign key (filmId) references film(id)) character set utf8 collate utf8_general_ci engine=InnoDB;

# creating an associative table between actors and films
create table actorFilm (actorId int(2),
filmId int(2),
foreign key (actorId) references actor(id),
foreign key (filmId) references film(id)) character set utf8 collate utf8_general_ci engine=InnoDB;