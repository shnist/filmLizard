create database films;
use films;

# table for films
create table film (id int(3) primary key not null auto_increment,
title varchar(40) not null,
certificate varchar(5),
releaseDate varchar(4),
poster varchar(200),
synopsis text,
rating double) engine=InnoDB;

# tables for genres
create table genre (id int(2) primary key not null auto_increment,
genre varchar(30)) engine=InnoDB;

# table for actors
create table actor (id int(2) primary key not null auto_increment,
name varchar(30)) engine=InnoDB;

# associative table between genre and films
create table genreFilm (genreId int(2),
filmId int(2),
foreign key (genreId) references genre(id),
foreign key (filmId) references film(id)) engine=InnoDB;

# creating an associative table between actors and films
create table actorFilm (actorId int(2),
filmId int(2),
foreign key (actorId) references actor(id),
foreign key (filmId) references film(id)) engine=InnoDB;