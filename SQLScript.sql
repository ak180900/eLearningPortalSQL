create database project;
use project;
create table login (
id varchar(50) primary key,
pass varchar(50),
role varchar(50)
);
create table faculty (
id varchar(50) primary key,
name varchar(50),
mobile int,
email varchar(50)
);
create table user (
id varchar(50) primary key,
name varchar(50),
mobile int,
email varchar(50)
);
select * from user;
create table course
(
  course_id  varchar(100),
  instructor_id varchar(100),
  course_name  varchar(100),
  price integer,
  faculty_name varchar(100),
  course_duration varchar(100),
  primary key(course_id)
);
select * from course;
create table enroll (
course_id varchar(100),
student_id varchar(100),
confirmation varchar(100),
primary key(course_id, student_id)
);
select * from enroll;
-- insert into dashboard values (
-- 'csb101','DSA','9','1','Sushila','1 Semester'
-- );
insert into course values('11','111','c++',3999,'Harry','6 Month' );
insert into course values('12','112','Data Structure',5999,'Sandeep Jain','6 Month' );
insert into course values('13','113','Web Development',6999,'Shraddha Khapra','8 Month' );
insert into course values('14','114','Machine Learning',4999,'Shubham Shinghal','7 Month' );
insert into course values('15','115','Competitive Programming',3999,'Love Babbar','6 Month');



-- select c.course_id, instructor_id, course_name, price, faculty_name, course_duration from course as c, enroll as e
-- where c.course_id = e.course_id and student_id = 'Anurag';


select * from course;
select * from enroll;
-- insert into enroll values (
-- '11',
-- 'Anurag',
-- 'YES'
-- );

-- UPDATE user SET name = 'Anurag Gautam' WHERE id = 'Anurag';


-- insert into enroll values('12','Anurag','NO');
-- select * from enroll;

-- drop table dashboard;

-- select * from login;
-- select * from user;
-- delete from login
-- where id='abcd';
-- select * from login as l, user as u
-- where l.id = u.id;

-- delete from login;
-- delete from enroll where course_id = '12';

-- insert into login values ('211210017', '123', 'student');
-- insert into user values('211210016', 'Ashutosh', 76, '211210017');
-- alter table user add foreign key (id) references login(id);
--
-- select * from login;