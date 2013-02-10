create database abc;
use abc;

create table Suppliers(
	sid int  primary key,
	sname varchar(30),
	city varchar(30)
);

create table Parts(
	pid int primary key,
	pname varchar(30),
	color varchar(30)
);

create table Catalog(
	sid int ,
	pid int,
	cost real,
	primary key(sid,pid),
	foreign key (sid) references Suppliers(sid) on delete cascade,
	foreign key (pid) references Parts(pid) on delete cascade
);

INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('1', "Mohan Sharma", "Dispur" );
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('2', "Michael Mohit Chouhan","Bombay");
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('3', "Rajnikanth","Delhi");
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('4', "Kumar Sanu","Kolkata");
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('5', "Zubeen Barua","Guwahati");
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('6', "Raj Kapoor","Patna");
INSERT INTO Suppliers ( sid, sname,  city ) VALUES ('7', "Imam Siddiquee","Agra");

INSERT INTO Parts ( pid,  pname,  color ) VALUES ('1',"Cap","Red" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('2',"Ball","Red" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('3',"T Shirt","Green" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('4',"Shoe","Green" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('5',"Ribbon","Yellow" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('6',"Earth","Blue" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('7',"Moon","White" );
INSERT INTO Parts ( pid,  pname,  color ) VALUES ('8',"Mars","Red" );

INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('1','1','1500');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('1','3','600');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('2','3','800');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('2','4','999');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','1','.05');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','2','.05');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','3','.05');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','4','.05');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','5','.05');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','6','9999999999');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','7','99999999');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('3','8','9999999999');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('4','5','15');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('4','1','210');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('5','5','50');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('6','4','1200');
INSERT INTO Catalog ( sid,  pid,  cost ) VALUES ('7','1','150');


/*Ans-1*/
select distinct sname from Suppliers where sid in (
	select sid from Catalog where pid in(
		select pid from Parts where color="Red"
	) 
);

/*
+----------------+
| sname          |
+----------------+
| Mohan Sharma   |
| Rajnikanth     |
| Kumar Sanu     |
| Imam Siddiquee |
+----------------+
4 rows in set (0.01 sec)*/

/*Ans-2*/
select distinct sid from Suppliers where sid in (
	select sid from Catalog where pid in(
		select pid from Parts where color="Red" or color= "Green"
	) 
);

/*
+-----+
| sid |
+-----+
|   1 |
|   2 |
|   3 |
|   4 |
|   6 |
|   7 |
+-----+
6 rows in set (0.00 sec)*/

/*Ans-3*/
select sid from Catalog where pid in(
                select pid from Parts where color="Red"
         
) union select sid from Suppliers where city='Guwahati';

/*
+-----+
| sid |
+-----+
|   1 |
|   3 |
|   4 |
|   7 |
|   5 |
+-----+
5 rows in set (0.00 sec)*/

/*Ans-4*/
select distinct c1.sid 
	from Parts p1, Parts p2,  Catalog c1, Catalog c2 
	where ( p1.color = 'Red' and c1.pid = p1.pid) 
	and ( p2.color = 'Green' and c2.pid = p2.pid) 
	and c1.sid = c2.sid;

/*
+-----+
| sid |
+-----+
|   1 |
|   3 |
+-----+
2 rows in set (0.00 sec)*/

/*Ans-5*/
select distinct s.sid  from Suppliers s where not exists 
  ( 
    select p.pid from Parts p where not exists
      ( 
        select s.sid from Catalog c where (c.sid = s.sid) and (c.pid = p.pid)
      )
  );
/*
+-----+
| sid |
+-----+
|   3 |
+-----+
1 row in set (0.00 sec)*/

/*Ans-6*/
select distinct s.sid from Suppliers s where not exists 
  ( 
    select p.pid from Parts p where p.color='Red' and not exists 
      (
        select s.sid from Catalog c where (c.sid = s.sid) and (c.pid = p.pid)
      )
  );

/*
+-----+
| sid |
+-----+
|   3 |
+-----+
1 row in set (0.01 sec)*/

/*Ans-7*/
select distinct s.sid from Suppliers s where not exists 
  ( 
    select p.pid from Parts p where p.color='Red' and not exists 
      (
        select s.sid from Catalog c where (c.sid = s.sid) and (c.pid = p.pid)
      )
  ) union 

select distinct c.sid from Catalog c where c.pid in 
(
	select p.pid from Parts p where p.color="Green"
);

/*
+-----+
| sid |
+-----+
|   3 |
|   1 |
|   2 |
|   6 |
+-----+
4 rows in set (0.01 sec)*/

/*Ans-8*/
select distinct s.sid from Suppliers s where not exists 
  ( 
    select p.pid from Parts p where p.color='Red' and not exists 
      (
        select s.sid from Catalog c where (c.sid = s.sid) and (c.pid = p.pid)
      )
  ) union 

select distinct s.sid from Suppliers s where not exists 
  ( 
    select p.pid from Parts p where p.color='Green' and not exists 
      (
        select s.sid from Catalog c where (c.sid = s.sid) and (c.pid = p.pid)
      )
  );
  
/*
+-----+
| sid |
+-----+
|   3 |
|   2 |
+-----+
2 rows in set (0.00 sec)*/

/*Ans-9*/
select s1.sid as sid1, s2.sid as sid2 
	from Catalog s1, Catalog s2 
	where (s1.cost > s2.cost ) 
	and (s1.pid = s2.pid);

/*
+------+------+
| sid1 | sid2 |
+------+------+
|    1 |    3 |
|    1 |    4 |
|    1 |    7 |
|    1 |    3 |
|    2 |    1 |
|    2 |    3 |
|    2 |    3 |
|    4 |    3 |
|    4 |    7 |
|    4 |    3 |
|    5 |    3 |
|    5 |    4 |
|    6 |    2 |
|    6 |    3 |
|    7 |    3 |
+------+------+
15 rows in set (0.00 sec)*/

/*Ans-10*/
select distinct s1.pid from Catalog s1 , Catalog s2 where (s1.pid = s2.pid) and (s1.sid<>s2.sid) ;

/*
+-----+
| pid |
+-----+
|   1 |
|   3 |
|   4 |
|   5 |
+-----+
4 rows in set (0.00 sec)*/

/*Ans-11*/
select distinct X.pid 
	from (select  max(cost) as price , pid , sid from Catalog  group by pid)X,  
	(select sid from Suppliers where sname ="Rajnikanth")Y 
	where X.sid = Y.sid  ;

/*
+-----+
| pid |
+-----+
|   2 |
|   5 |
|   6 |
|   7 |
|   8 |
+-----+
5 rows in set (0.00 sec)*/

/*Ans-12*/
select p.pid from Parts p where not exists
(
	select s. sid from Suppliers s where not exists 
	(
		select c.sid from Catalog c where (c.sid = s.sid and c.pid = p.pid and c.cost<200 )
	)
);

/*
Empty set (0.00 sec)*/

