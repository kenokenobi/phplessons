create table posts (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
	subject varchar(128) not null,
    content varchar(1000) not null,
	date datetime not null  
);

insert into posts (subject, content, date)
    VALUES ('A samplle subject', 'blah bvlah blah', '2020-01-16 20:35:00');