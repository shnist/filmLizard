# table for films
create table film (id int(3) primary key not null auto_increment,
title varchar(30) not null,
certificate varchar(2),
releaseDate date,
rating double) engine=InnoDB;

# tables for genres
create table genre (id int(2) primary key not null auto_increment,
genre varchar(10)) engine=InnoDB;

# table for actors
create table actor (id int(2) primary key not null auto_increment,
name varchar(30)) engine=InnoDB;

# associative table between genre and films
create table genreFilm (genreId int(2),
filmId int(2),
foreign key (genreId) references genre(id),
foreign key (filmId) references film(id)) engine=InnoDB;

# creating an associative table between actors and films
create table actorsFilm (actorId int(2),
filmId int(2),
foreign key (actorId) references actor(id),
foreign key (filmId) references film(id)) engine=InnoDB;

# adding values to the genre table
insert into genre(genre) values ("action");
insert into genre(genre) values ("adventure");
insert into genre(genre) values ("comedy");
insert into genre(genre) values ("crime");
insert into genre(genre) values ("drama");
insert into genre(genre) values ("historical");
insert into genre(genre) values ("horror");
insert into genre(genre) values ("musical");
insert into genre(genre) values ("sci-fi");
insert into genre(genre) values ("war");
insert into genre(genre) values ("westerns");



insert into film (id, title) values (1, "Taken");
insert into film (id, title) values (2, "The Last Samurai");
insert into film (id, title) values (3, "500 Days of Summer");
insert into film (id, title) values (4, "Collateral");
insert into film (id, title) values (5, "War of the Worlds");
insert into film (id, title) values (6, "500 Days of Summer");
insert into film (id, title) values (7, "Star Trek");