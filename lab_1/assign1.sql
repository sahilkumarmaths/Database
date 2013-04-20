create database abc;
use abc;

create table Employee( 
		E_ID varchar(6) not null primary key, 
		Designation varchar(25) not null, 
		Works_Under varchar(6) not null,
		foreign key(Works_Under) references Employee(E_ID)
		on delete cascade
		);

create table Salary(
		E_ID varchar(6) not null primary key,
		Salary int,
		foreign key (E_ID) references Employee(E_ID)
		);
		
create table Employee_Details(
		E_ID varchar(6) not null primary key ,
		Name varchar(25) not null,
		DOB date, 
		Gender enum('M','F') not null,
		Address varchar(50) not null,
		Mobile_No int(10) not null, 
		Email_ID varchar(30) not null,
		unique(Mobile_No),
		unique(Email_ID),
		foreign key (E_ID) references Employee(E_ID)
		);


alter table Employee_Details add check(Email_ID LIKE '%@%.%');
alter table Employee_Details add check(E_ID LIKE 'EMP[0-9][0-9][0-9]');
alter table Employee add check(E_ID LIKE 'EMP[0-9][0-9][0-9]');
alter table Salary add check(E_ID LIKE 'EMP[0-9][0-9][0-9]');
alter table Salary add check(Mobile_No LIKE '[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]');


INSERT INTO Employee VALUES ('EMP001','Owner', 'EMP001');
INSERT INTO Employee_Details VALUES ('EMP002', 'Durgesh','16/12/1989','M','IITG','1234567890','k.durgesh@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP001', 'NIladri','21/12/1983','M','IITG','2134567890','niladri@iitg.ernet.in');
INSERT INTO Employee VALUES ('EMP002','Manager', 'EMP001');
INSERT INTO Employee VALUES ('EMP004','Staff', 'EMP002');
INSERT INTO Employee VALUES ('EMP005','Staff', 'EMP002');
INSERT INTO Employee VALUES ('EMP006','Staff', 'EMP003');
INSERT INTO Employee VALUES ('EMP003','Manager', 'EMP001');
INSERT INTO Employee VALUES ('EMP006','Staff', 'EMP003');
INSERT INTO Employee VALUES ('EMP007','Staff', 'EMP003');
INSERT INTO Salary VALUES ('EMP008', 10000);
INSERT INTO Employee VALUES ('EMP008','Staff', 'EMP003');
INSERT INTO Salary VALUES ('EMP001', 30000);
INSERT INTO Salary VALUES ('EMP002', 20000);
INSERT INTO Salary VALUES ('EMP003', 20000);
INSERT INTO Salary VALUES ('EMP004', 10000);
INSERT INTO Employee_Details VALUES ('EMP002', 'Durgesh','16/16/1989','M','IITG','1234567890','k.durgesh@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP002', 'Durgesh','16/12/1989','M','IITG','1234567890','k.durgesh@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP003', 'Abhirup','19/06/1994','M','IITG','1324567890','abhirup@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP003', 'Abhirup','19/06/1988','M','IITG','1324567890','abhirup@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP004', 'Koushik','19/06/1988','M','IITG','1235467890','k.konar@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP005', 'Sachin','19/06/1988','M','IITG','1234576890','sachin@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP006', 'Prayag','19/06/1988','M','IITG','12348790','prayag@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP006', 'Prayag','19/06/1988','M','IITG','1234568790','prayag@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP007', 'Kartheek','19/06/1988','M','IITG','1234567980','kartheek#iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP007', 'Kartheek','19/06/1988','M','IITG','1234567980','kartheek@iitg.ernet.in');
INSERT INTO Employee_Details VALUES ('EMP008', 'Dinesh','19/06/1988','M','IITG','1234567809','dinesh@iitg.ernet.in');
INSERT INTO Salary VALUES ('EMP005', 10000);
INSERT INTO Salary VALUES ('EMP006', 10000);
INSERT INTO Salary VALUES ('EMP007', 10000);
INSERT INTO Salary VALUES ('EMP008', 10000);
