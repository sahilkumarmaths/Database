create database sahil;
use sahil;

create table dvd(
	dvd_id int primary key,
	actor_name varchar(30),
	title varchar(30)
);

create table friend(
	fid int primary key,
	name varchar(30)
);

create table borrow(
	fid int,
	dvd_id int,
	date_borrow date,
	date_return date,
	primary key (fid,dvd_id,date_borrow),
	foreign key (fid) references friend(fid) on delete cascade,
	foreign key (dvd_id) references dvd(dvd_id) on delete cascade
); 

create table telephone(
	fid int,
	tele_no	char(10),
	primary key(fid,tele_no),
	foreign key (fid) references friend(fid) on delete cascade
);

insert into friend values (1, "Ram");
insert into friend values (2, "Mohan");
insert into friend values (3, "Sohan");
insert into friend values (4, "Harry");
insert into friend values (5, "Potter");

insert into dvd values (1 , "Shah","Hey");
insert into dvd values (2 , "Rukh","Hello");
insert into dvd values (3 , "Khan","There");
insert into dvd values (4 , "Amit","Why");
insert into dvd values (5 , "Salman","How");

insert into telephone values (1,"9876543210");
insert into telephone values (2,"9876533210");
insert into telephone values (3,"9876543210");
insert into telephone values (4,"9876553210");
insert into telephone values (5,"9876563210");

insert into borrow values(1, 1, '2012-01-01','2012-01-02');
insert into borrow values(1, 2, '2012-01-01','2012-01-02');
insert into borrow values(2, 3, '2012-01-02','2012-01-03');
insert into borrow values(2, 4, '2012-01-02','2012-01-03');
insert into borrow values(3, 5, '2012-01-03','2012-01-04');
insert into borrow values(3, 1, '2012-01-03','2012-01-04');
insert into borrow values(4, 2, '2012-01-04','2012-01-05');
insert into borrow values(4, 3, '2012-01-04','2012-01-05');
insert into borrow values(5, 4, '2012-01-05','2012-01-06');
insert into borrow values(5, 5, '2012-01-05','2012-01-06');

/*Answer1 */
select T.fid , f.name  ,T.dvd,t.tele_no from 
	( select b.fid , count(dvd_id) as dvd  from borrow b group by b.fid) T , friend f, (SELECT fid, GROUP_CONCAT(tele_no SEPARATOR ', ') as tele_no FROM telephone GROUP BY fid)t 
	where f.fid = T.fid and t.fid = f.fid  ; 

/*Answer 2*/
select T.dvd_id,T.cnt,d.actor_name, d.title from 
	(select b.dvd_id as dvd_id, count(b.dvd_id) as cnt from borrow b group by b.dvd_id)T, dvd d 
where d.dvd_id = T.dvd_id  ; 

/*Answer 3*/
select count(*) from (select distinct b1.fid from borrow b1, borrow b2 where b1.fid = b2.fid and b1.dvd_id= b2.dvd_id and b1.date_borrow <> b2.date_borrow)T;

select T.fid, T.dvd_id, d.title, f.name, t.tele_no from
(select distinct b1.fid as fid, b1.dvd_id as dvd_id  from borrow b1, borrow b2 where b1.fid = b2.fid and b1.dvd_id= b2.dvd_id and b1.date_borrow <> b2.date_borrow)T, dvd d, friend f,(SELECT fid, GROUP_CONCAT(tele_no SEPARATOR ', ') as tele_no FROM telephone GROUP BY fid)t  where d.dvd_id = T.dvd_id and f.fid = T.fid and t.fid= f.fid;

/*Answer4 */
select b.fid from borrow b where b.date_return-b.date_borrow>5;

/*Answer 5*/
delete from friend where fid in (select b.fid from borrow b where b.date_return- b.date_borrow>5);










