create database films;
use films;

# table for films
create table film (id int(3) primary key not null auto_increment,
title varchar(40) not null,
certificate varchar(5),
releaseDate varchar(4),
poster varchar(200),
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

insert into film (title) values ("Taken");
insert into film (title) values ("The Last Samurai");
insert into film (title) values ("500 Days of Summer");
insert into film (title) values ("Collateral");
insert into film (title) values ("War of the Worlds");
insert into film (title) values ("No Country For Old Men");
insert into film (title) values ("Star Trek");
insert into film (title) values ("Rare Exports: A Christmas Tale");
insert into film (title) values ("The Lives of Others");
insert into film (title) values ("Crouching Tiger Hidden Dragon");
insert into film (title) values ("The Girl With The Dragon Tattoo");
insert into film (title) values ("300");
insert into film (title) values ("Dejavu");
insert into film (title) values ("Die Hard");
insert into film (title) values ("Hancock");
insert into film (title) values ("Black Hawk Down");
insert into film (title) values ("Blade Runner");
insert into film (title) values ("Superman Returns");
insert into film (title) values ("Alien vs Predator");
insert into film (title) values ("Ace Ventura Pet Detective");
insert into film (title) values ("Jumanji");
insert into film (title) values ("Spider Man 2");
insert into film (title) values ("Big Fish");
insert into film (title) values ("The Aviator");
insert into film (title) values ("Australia");
insert into film (title) values ("The Butterfly Effect");
insert into film (title) values ("Cast Away");
insert into film (title) values ("Borat");
