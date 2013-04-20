create database abc;
use abc;

create table student(
	name varchar(30) not null,
	ssno int not null primary key,
	program varchar(30) not null 
);

create table room(
	roomno int  not null,
	building varchar(20) not null,
	primary key(roomno, building)
);

create table instructor(
	issno int not null primary key,
	name varchar(30) not null,
	dept varchar(30) not null,
	title varchar(30) not null
);

/*
 *	Assuming Courseno and Title together form primary key .
 *	Syllabus and credit are not considered primary key.
 *	It is assumed that credit and syllabus never changes 
 *  for a given course with a given title.
 */

create table course(
	syllabus varchar(80),
	courseno int not null,
	title varchar(40) not null,
	credits int not null,
	primary key(courseno, title)
);

/*
 *	All are primary keys to uniquely identify the record.
 *	To uniquely identify the two records with the same course no, 
		with same year, in the same sem and time but different sections (secno). 
 */
 
create table courseoffer(
	tim time not null,
	secno varchar(2) not null,
	sem int not null,
	years int(4) not null,
	courseno int not null,
	foreign key (courseno) references course(courseno) on delete cascade,
	primary key(courseno, years, sem, tim,secno)
);

/*
 *	Many to many relation exist therefore primary key of student table and 
	primary key of course offering table is taken.
 */
 
create table enrol(
	grade varchar(5) not null,
	ssno int not null ,
	tim time not null,
	secno varchar(2) not null,
	sem int not null,
	years int(4) not null,
	courseno int not null,
	primary key(ssno, tim, secno, sem, years, courseno),
	foreign key (courseno, years, sem, tim,secno) references 
		courseoffer(courseno, years, sem, tim,secno) on delete cascade,
	foreign key (ssno) references student(ssno) on delete cascade
);

/*
	Many to many relation exist therefore primary key of instructor table and 
	primary key of course offering table is taken.
*/

create table teaches(
	issno int not null,
	tim time not null,
	secno varchar(2) not null,
	sem int not null,
	years int(4) not null,
	courseno int not null,
	primary key(issno, tim, secno, sem, years, courseno),
	foreign key (courseno, years, sem, tim,secno) references 
		courseoffer(courseno, years, sem, tim,secno) on delete cascade,
	foreign key (issno) references instructor(issno) on delete cascade
);

/*
	Many to many relation exist therefore primary key of room table and 
	primary key of course offering table is taken.
*/

create table meetings(
	roomno int  not null,
	building varchar(20) not null,
	
	tim time not null,
	secno varchar(2) not null,
	sem int not null,
	years int(4) not null,
	courseno int not null,
	
	primary key(roomno, building,tim, secno, sem, years, courseno),
	foreign key (courseno, years, sem, tim,secno) references 
		courseoffer(courseno, years, sem, tim,secno) on delete cascade,
	foreign key (roomno, building) references room(roomno, building) on delete cascade
);

/*
	depenedson = the course on which courseno depends
	depenedstitle = the title on dependson course
*/

create table requires(
	courseno int not null,
	title varchar(40) not null,
	dependson int not null,
	dependstitle varchar(40) not null,
	primary key(courseno, dependson,title,dependstitle),
	foreign key (courseno,title) references course(courseno,title) on delete cascade,
	foreign key (dependson,dependstitle) references course(courseno,title) on delete cascade
);
