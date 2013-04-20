-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2013 at 05:37 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crm_db`
--
CREATE DATABASE `crm_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crm_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `webmail_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin_id` varchar(10) NOT NULL,
  PRIMARY KEY (`webmail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`webmail_id`, `name`, `admin_id`) VALUES
('admin', 'Admin 1', '101');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `webmail_id` varchar(20) NOT NULL,
  `comment_text` text NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `webmail_id`, `comment_text`, `thread_id`) VALUES
(32, 'srs', '.No this is not. Sorry its fine', 3),
(40, 'p.sai', 'I really like the cool UI of threads and it is really easy to look after...', 52),
(42, 'p.sai', 'browse and drop databases, tables, views, columns and indexes; create, copy, .... cd phpMyAdmin mkdir config # create directory for saving chmod o+rw config # give it ..... CREATE VIEW,ALTER VIEW,DROP VIEW, CREATE DATABASE,ALTER .... whether to display the names of databases (in the selector) using a tree, see ...', 53),
(43, 'p.sai', 'use this interface to send mails to IITG aliases like stud, btech etc. To send mails to all these, please use webmail.iitg.ernet.in\r\n\r\nDo not reply to any mail asking for your password, credit card info, bank account number, etc. These are all SPAM mails.', 53),
(44, 'sharath', 'Data models with emphasis on the relational model; Database design with E-R model; Relational algebra and calculus; query Languages (specifically SQL); RDBMS design; File & system structure: indexed sequential, hashed, dynamic hashed, B-trees; Query processing; Concurrency control; error recovery; security; Case studies like ORACLE, Mysql, etc.; Introduction to Open Database Connectivity, Client-Server environment etc.', 14),
(46, 'sharath', ' \r\n\r\nFamiliarization with various databases packages like Microsoft Access, ORACLE, MySql, SQL Server, DB2 etc. Client-server and 3 tier web enabled database programming. Use of Application servers. Design and implementation of a Database application using a multi-user DBMS.', 14),
(48, 'sahil', 'Overview of different phases of a compiler: front-end; back-end; Lexical analysis: specification of tokens, recognition of tokens, input buffering, automatic tools; Syntax analysis: context free grammars, top down and bottom up parsing techniques, construction of efficient parsers, syntax-directed translation, automatic tools; Semantic analysis: declaration processing, type checking, symbol tables, error recovery; Intermediate code generation: run-time environments, translation of language constructs; Code generation: flow-graphs, register allocation, code-generation algorithms; Introduction to code optimization techniques.', 14),
(49, 'sahil', ' \r\n\r\nEvolution of computer networks; Data link layer: Framing, HDLC, PPP, sliding window protocols, medium access control, Token Ring, Wireless LAN; Virtual circuit switching: Frame relay, ATM; Network Layer: Internet addressing, IP, ARP, ICMP, CIDR, routing algorithms (RIP, OSPF, BGP); Transport Layer: UDP, TCP, flow control, congestion control; Introduction to quality of service; Application Layer: DNS, Web, email, authentication, encryption.', 14),
(50, 'sahil', ' \r\n\r\nEvolution of computer networks; Data link layer: Framing, HDLC, PPP, sliding window protocols, medium access control, Token Ring, Wireless LAN; Virtual circuit switching: Frame relay, ATM; Network Layer: Internet addressing, IP, ARP, ICMP, CIDR, routing algorithms (RIP, OSPF, BGP); Transport Layer: UDP, TCP, flow control, congestion control; Introduction to quality of service; Application Layer: DNS, Web, email, authentication, encryption.', 52),
(51, 'sahil', 'Introduction to Programming in ML/Haskell/Scheme: Functional programming paradigm, evaluation, type and type checking, data types, higher order functions. Introduction to Programming in Prolog: Logic programming paradigm, unification and resolution, data structures in Prolog, cuts. Concurrent Programming: Threads, processes, synchronization monitors, concurrent objects, concurrent programming in Java/MPI/CILK.', 52),
(52, 'sahil', ' \r\n\r\nIntroduction and organization of an interactive graphics system; Scan conversion: line, circle, and ellipse; Filling: rectangle, polygon, ellipse, and arc; Clipping: line, circle, ellipse, and polygon; Antialiasing: unweighted and weighted area sampling, and Gupta-Sproull methods;  Transformations: 2D and 3D, homogeneous coordinates, composite and window-to-viewport transformations; 3D View: projections, specification and implementation of 3D view; ', 59);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `syllabus` text NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_name` (`course_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `syllabus`) VALUES
('CH-201', 'CH-201', 'Structure and Bonding; Origin'),
('CS 355', 'VLSI', 'basics of VLSI'),
('CS243', 'Software Engineering', 'Nothing much !'),
('CS344', 'Databases', 'Data models with emphasis on the relational model; Database design with E-R model; Relational algebra and calculus; query Languages (specifically SQL); RDBMS design; File & system structure: indexed sequential, hashed, dynamic hashed, B-trees; Query processing; Concurrency control; error recovery; security; Case studies like ORACLE, Mysql, etc.; Introduction to Open Database Connectivity, Client-Server environment etc.'),
('CS346', 'Compilers', 'Overview of different phases of a compiler: front-end; back-end; Lexical analysis: specification of tokens, recognition of tokens, input buffering, automatic tools; Syntax analysis: context free grammars, top down and bottom up parsing techniques, construction of efficient parsers, syntax-directed translation, automatic tools; Semantic analysis: declaration processing, type checking, symbol tables, error recovery; Intermediate code generation: run-time environments, translation of language constructs; Code generation: flow-graphs, register allocation, code-generation algorithms; Introduction to code optimization techniques.\r\n\r\n '),
('CS348', 'Networks', 'Evolution of computer networks; Data link layer: Framing, HDLC, PPP, sliding window protocols, medium access control, Token Ring, Wireless LAN; Virtual circuit switching: Frame relay, ATM; Network Layer: Internet addressing, IP, ARP, ICMP, CIDR, routing algorithms (RIP, OSPF, BGP); Transport Layer: UDP, TCP, flow control, congestion control; Introduction to quality of service; Application Layer: DNS, Web, email, authentication, encryption.');

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE IF NOT EXISTS `course_offerings` (
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `absolute_year` year(4) NOT NULL,
  PRIMARY KEY (`course_id`,`semester`,`absolute_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`course_id`, `semester`, `absolute_year`) VALUES
('CS344', 1, 2013),
('CS346', 1, 2013),
('CS348', 1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(200) NOT NULL,
  `file_data` varchar(300) NOT NULL,
  `file_description` text NOT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  KEY `course_id` (`course_id`,`semester`,`year`),
  KEY `uploader_id` (`uploader_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`file_id`, `file_name`, `file_data`, `file_description`, `uploader_id`, `course_id`, `semester`, `year`, `time_stamp`) VALUES
(63, 'opttext.pdf', 'upload/CS346/1_2013/opttext.pdf', 'Every one please share the files which you have, so that it will be a good repository in no time', 'p.sai', 'CS346', 1, 2013, '2013-04-13 08:39:21'),
(64, '1000 Most Common Words In English - Numbers Vocabulary For Esl Efl Tefl Toefl Tesl English Learners.pdf', 'upload/CS346/1_2013/1000 Most Common Words In English - Numbers Vocabulary For Esl Efl Tefl Toefl Tesl English Learners.pdf', 'this is dictionary....', 'p.dileep', 'CS346', 1, 2013, '2013-04-13 08:46:50'),
(68, 'ch6.pdf', 'upload/CS344/1_2013/ch6.pdf', 'Silberschatz - slides on ER digram - very useful one', 'p.dileep', 'CS344', 1, 2013, '2013-04-13 15:01:47'),
(69, 'TA_list_CSE.pdf', 'upload/CS344/1_2013/TA_list_CSE.pdf', 'List of TA''s for the final project', 'srs', 'CS344', 1, 2013, '2013-04-13 15:03:11'),
(70, 'Instructions.txt', 'upload/CS344/1_2013/Instructions.txt', 'Midsem lab exam instructions..', 'sharath', 'CS344', 1, 2013, '2013-04-13 15:05:27'),
(71, 'Compiler-Lec20&21.pdf', 'upload/CS346/1_2013/Compiler-Lec20&21.pdf', 'Good tutorial on Bison -- a good starter guide !', 'sharath', 'CS346', 1, 2013, '2013-04-13 15:06:27'),
(72, 'Compiler-Lec35.pdf', 'upload/CS346/1_2013/Compiler-Lec35.pdf', 'Latest lecture slides on Cache optimization', 'arnab', 'CS346', 1, 2013, '2013-04-13 15:07:59'),
(75, 'www.binarytides.com_socket-programming-c-linux-tutorial_2.pdf', 'upload/CS348/1_2013/www.binarytides.com_socket-programming-c-linux-tutorial_2.pdf', 'Nice tutorial on Socket programming', 'p.sai', 'CS348', 1, 2013, '2013-04-13 15:14:21'),
(77, '230910_351174001644249_746160530_n.jpg', 'upload/CS348/1_2013/230910_351174001644249_746160530_n.jpg', 'Federer pic!', 'sahil', 'CS348', 1, 2013, '2013-04-13 15:20:24'),
(78, 'Solutions.txt', 'upload/CS348/1_2013/Solutions.txt', 'solutions for the assignment', 't.venkat', 'CS348', 1, 2013, '2013-04-13 17:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE IF NOT EXISTS `enrolls` (
  `stud_webmail_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`stud_webmail_id`,`course_id`,`semester`,`year`),
  KEY `my_key` (`course_id`,`semester`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`stud_webmail_id`, `course_id`, `semester`, `year`) VALUES
('p.dileep', 'CS344', 1, 2013),
('p.sai', 'CS344', 1, 2013),
('sahil', 'CS344', 1, 2013),
('sharath', 'CS344', 1, 2013),
('p.dileep', 'CS346', 1, 2013),
('p.sai', 'CS346', 1, 2013),
('sahil', 'CS346', 1, 2013),
('sharath', 'CS346', 1, 2013),
('p.dileep', 'CS348', 1, 2013),
('p.sai', 'CS348', 1, 2013),
('sahil', 'CS348', 1, 2013),
('sharath', 'CS348', 1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `webmail_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `instructor_id` varchar(10) NOT NULL,
  PRIMARY KEY (`webmail_id`),
  UNIQUE KEY `instuctor_id` (`instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`webmail_id`, `name`, `instructor_id`) VALUES
('arnab', 'Dr. Arnab Sarkar', '102'),
('srs', 'Dr. Sanasam Rabir Singh', '101'),
('t.venkat', 'Dr. Venkatesh', '103');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `webmail_id_sender` varchar(20) NOT NULL,
  `webmail_id_reciever` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reciever_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `webmail_id_sender` (`webmail_id_sender`),
  KEY `webmail_id_reciever` (`webmail_id_reciever`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `webmail_id_sender`, `webmail_id_reciever`, `message`, `time_stamp`, `reciever_read`) VALUES
(1, 'p.sai', 'p.dileep', 'fasf', '2013-04-12 04:56:14', 1),
(2, 'p.dileep', 'p.sai', 'sdafdsadsa', '2013-04-12 05:29:39', 1),
(3, 'p.dileep', 'srs', 'sdafdsaf', '2013-04-12 05:29:50', 1),
(4, 'p.dileep', 'p.sai', 'fdasfsa', '2013-04-12 05:30:08', 1),
(5, 'p.dileep', 'p.sai', 'fsadfdsa', '2013-04-12 05:30:08', 1),
(6, 'p.dileep', 'p.sai', 'fsadfdsads', '2013-04-12 05:30:22', 1),
(7, 'p.dileep', 'srs', 'dsafdsasa', '2013-04-12 05:30:22', 1),
(8, 'p.sai', 'p.dileep', 'fdsafdsaf', '2013-04-12 05:30:33', 1),
(9, 'p.sai', 'p.dileep', 'dsafdasf', '2013-04-12 05:30:33', 1),
(10, 'srs', 'p.dileep', 'dsafdasf', '2013-04-12 05:30:48', 1),
(11, 'srs', 'p.dileep', 'dsafdsaf', '2013-04-12 05:30:48', 1),
(12, 'p.dileep', 'p.sai', 'sdafasdsadf', '2013-04-12 05:47:17', 1),
(13, 'p.dileep', 'p.sai', 'sahil is good', '2013-04-12 05:47:41', 1),
(14, 'p.dileep', 'srs', 'it is a good day', '2013-04-12 05:47:58', 1),
(15, 'p.sai', 'p.dileep', 'lets check notification', '2013-04-12 06:58:42', 1),
(16, 'p.sai', 'p.dileep', 'mohan is good', '2013-04-12 07:31:57', 1),
(17, 'p.sai', 'p.dileep', 'yes im nt woktnind', '2013-04-12 18:53:31', 1),
(18, 'p.sai', 'srs', 'Sir, Iam finding difficulty in BCNF? can you help me', '2013-04-13 03:52:26', 1),
(19, 'p.dileep', 'p.sai', 'are we having class tomorrow.and did u check the new UI for compose? ITS AWESOME MAN!!!!', '2013-04-13 08:42:56', 1),
(20, 'p.sai', 'p.dileep', 'ya, its really cool....well I think ther is a class tomorrow.', '2013-04-13 08:45:08', 1),
(21, 'p.sai', 'p.dileep', 'yes sir .. i am facing great difficulty', '2013-04-13 09:50:22', 1),
(22, 'srs', 'p.dileep', 'how ae you dileep', '2013-04-13 09:51:46', 1),
(23, 'srs', 'p.sai', 'what are you doing ?', '2013-04-13 09:51:52', 1),
(24, 'srs', 'p.sai', 'i am here', '2013-04-13 09:53:32', 1),
(25, 'p.sai', 'admin', 'Hello sir', '2013-04-13 12:52:47', 0),
(26, 'p.sai', 'admin', 'Hello sir ... !!!', '2013-04-13 13:56:56', 0),
(27, 'p.sai', 'srs', 'Hello Sir ... !!!', '2013-04-13 13:57:15', 1),
(28, 'srs', 'p.sai', 'I am good .. !!!', '2013-04-13 14:02:13', 1),
(29, 'p.sai', 'srs', 'Sir .. on what topics are you working on ?', '2013-04-13 15:10:59', 1),
(30, 'srs', 'p.sai', 'I am working on Distributed Algorithms..', '2013-04-13 15:11:26', 1),
(31, 'p.sai', 'srs', 'Okay ..This sounds like a very good topic of research...', '2013-04-13 15:12:33', 1),
(32, 'srs', 'p.sai', 'yes, it is ... and i am looking for some students to work on a Porject that i have in my mind ...What is your BTP project ?', '2013-04-13 15:13:20', 1),
(33, 'srs', 'p.sai', 'yes, it is ... and i am looking for some students to work on a Porject that i have in my mind ...What is your BTP project ?', '2013-04-13 15:13:30', 1),
(34, 'p.sai', 'srs', 'I would love to work ... Thanks .. i have to go for dinner now .. Thanks one again ... !!!', '2013-04-13 15:14:37', 0),
(35, 'p.dileep', 'p.sai', 'What is your progress on NS- 3 Asssignment ..', '2013-04-13 15:16:06', 1),
(36, 'p.sai', 'p.dileep', 'I have started to work on the assignment ..and hope .it finishes soon .. wbu ?', '2013-04-13 15:16:49', 1),
(37, 'p.dileep', 'p.sai', 'ha .. i have finishe that .. and will be submitting any time now ... :D :D', '2013-04-13 15:17:54', 1),
(38, 'p.sai', 'p.dileep', 'oh ..seriously ..... :P', '2013-04-13 15:19:18', 1),
(39, 'p.sai', 'p.dileep', 'i gotta go ,....bye .. take care .. !!!', '2013-04-13 15:20:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_course`
--

CREATE TABLE IF NOT EXISTS `news_course` (
  `nid` int(11) NOT NULL DEFAULT '0',
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`nid`,`course_id`,`semester`,`year`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_course`
--

INSERT INTO `news_course` (`nid`, `course_id`, `semester`, `year`) VALUES
(1, 'CS344', 1, 2013),
(3, 'CS344', 1, 2013),
(4, 'CS344', 1, 2013),
(13, 'CS344', 1, 2013),
(14, 'CS344', 1, 2013),
(15, 'CS344', 1, 2013),
(7, 'CS346', 1, 2013),
(8, 'CS346', 1, 2013),
(19, 'CS346', 1, 2013),
(16, 'CS348', 1, 2013),
(17, 'CS348', 1, 2013),
(18, 'CS348', 1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE IF NOT EXISTS `news_feed` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `news_text` text,
  `webmail` varchar(20) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_content` text NOT NULL,
  PRIMARY KEY (`nid`),
  KEY `webmail` (`webmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`nid`, `news_text`, `webmail`, `date`, `news_content`) VALUES
(1, 'quiz2 on wed', 'srs', '2013-04-08 01:30:00', 'Saikrishna Budamgunta IRS, a 2006 batch alumni is in campus right now . He plans to stay in the campus tonight . We all have a wonderful opportunity to meet him and learn from his experiences . All those who are Civil Service aspirants or even have a slight bit of inquisitiveness about it are requested to get together in the EEE Departmental library , core 2 , Academic complex .\r\nSome particulars about him .'),
(3, 'hello, this saturday no class', 'srs', '2013-04-07 01:30:00', 'I''m hoping to know the views of academicians on my opinion that ACM/IEEE Student Memberships are a waste of money at the Undergraduate Level; Especially since IITG is already subscribed to all the publications and the individual departments subscribe to the respective monthly magazines in print from their funds.'),
(4, 'Slides are uploaded', 'srs', '2013-04-05 01:30:00', 'I''m also wondering on a threat that because of "ACM/IEEE" branding(necessary/unnecessary ?), some of the workshops by respective department''s students/Special Interest Groups may turn premium in future! I think that ACM/IEEE Chapters should work (if they didn''t already) with a motive that they''ll not charge for a talk/workshop by using the "brand value" for something that''s trivial and can be efficiently conducted using IITG''s own fraternity. And, yes, I do agree that special talks (as may deemed necessary) require special guests which demands a fee to be collected from the attendees to compensate the expenditure which requires branding.'),
(7, 'dasfef', 'srs', '2013-04-12 21:14:09', 'P.S.: This post shouldn''t be mistaken for an "Anti-IITG IEEE Chapter". I personally appreciate the active efforts of the team to promote research culture at IITG. I''m only (as of now) against B.Tech Paid Student Memberships. I agree that I may be totally ignorant of the details of ACM/IEEE sponsorship and would really appreciate if someone could point out any flaw in my limited understanding.\n'),
(8, 'now ', 'srs', '2013-04-12 21:14:21', 'Hello we www.buysellgreen.in are a startup of IITG and we are trying to promote eco-friendly products. We take bulk orders for tshirts and are planning to launch our own brand in organic cotton fabric. Till now we have delivered about 3 orders in IITG and have received good response. We are avoiding use of polybags in our packaging as can be seen in ADVAYA 2013 tshirts. '),
(9, 'now ', 'srs', '2013-04-12 21:15:01', 'I would like to gather your valuable reflections about life at IIT and its relation with a successful career. My primary motive is to understand how the faculty and administration can help the current students. This, I will use to set my agenda as EEE DUPC secy, and during discussions with other faculty. I will also use this to advise students about what their seniors (you) are saying about how they should get most from their time at IIT.'),
(10, 'End sem', 'srs', '2013-04-12 21:15:35', 'Earlier today, with my couple of friends I went to Admin canteen. What took my attention was this little kid (may be 13-14 years old), he was taking care of our food. That little kid was working as a waiter, right below the nose of administration of IIT Guwahati.'),
(11, 'Now Important news', 'srs', '2013-04-12 21:34:03', ' His face was so innocent & one can instantly judge from his expression, that he has no interest in serving other people''s food. At his age one should be given an opportunity to study, a freedom to dream. But right here in front of the *superior, *more sophisticated, & *intelligent society of IIT G, that kid is crying & suffering from the evils of child labor.'),
(13, 'pls work', 'srs', '2013-04-12 21:36:53', ' At this moment I cannot provide any documents of Indian legislature(acts), which claim that this is wrong & illegal. But I''m sure we''d all agree that this kind of atrocities are immoral. The most pathetic feeling was my incapability to help that kid. I went to him & asked him his name & age politely. He was scared & he lied to me that his age was 18. I know that a kid that young can''t be 18 years old.'),
(14, 'no clas', 'srs', '2013-04-13 06:04:30', 'ther iwlll be no class next semester....\r\n'),
(15, 'Surprise Quiz .!!!', 'srs', '2013-04-13 12:57:25', 'Coming week can have a surprise quiz . Be prepared ... !!!'),
(16, 'End sem syllabus', 't.venkat', '2013-04-13 16:00:35', ' \r\n\r\nEvolution of computer networks; Data link layer: Framing, HDLC, PPP, sliding window protocols, medium access control, Token Ring, Wireless LAN; Virtual circuit switching: Frame relay, ATM; Network Layer: Internet addressing, IP, ARP, ICMP, CIDR, routing algorithms (RIP, OSPF, BGP); Transport Layer: UDP, TCP, flow control, congestion control; Introduction to quality of service; Application Layer: DNS, Web, email, authentication, encryption.'),
(17, 'Text books updated', 't.venkat', '2013-04-13 16:01:00', '1.L. L. Peterson and B. S. Davie, Computer Networks: A Systems Approach, 4th Ed., Elsevier India, 2007.\r\n\r\n2.A. S. Tanenbaum, Computer Networks, 4th Ed., Pearson India, 2003.\r\n\r\n '),
(18, 'Collect QUIZ 2 papers ', 't.venkat', '2013-04-13 16:01:36', 'Venue : lecture hall\r\nTime : 5pm'),
(19, 'Syllabus for this semester updated', 'arnab', '2013-04-13 16:03:02', 'Overview of different phases of a compiler: front-end; back-end; Lexical analysis: specification of tokens, recognition of tokens, input buffering, automatic tools; Syntax analysis: context free grammars, top down and bottom up parsing techniques, construction of efficient parsers, syntax-directed translation, automatic tools; Semantic analysis: declaration processing, type checking, symbol tables, error recovery; Intermediate code generation: run-time environments, translation of language constructs; Code generation: flow-graphs, register allocation, code-generation algorithms; Introduction to code optimization techniques.');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `webmail_id` varchar(20) NOT NULL,
  `psswd` varchar(100) NOT NULL,
  PRIMARY KEY (`webmail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`webmail_id`, `psswd`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
('arnab', '0177a74032e1e9ab9dcd8f18ef1578ea3478ba32'),
('p.dileep', 'a6f9b3bcd538b605eaa3fa8e829f88df2ecea540'),
('p.sai', '4a139ab8ba403e6a085b018d276c203b0e0875e4'),
('sahil', '00e1ca7a39a6d3e3f14be34a9414dfd17f4ae24e'),
('sharath', 'eff173d3ae2a939dbc5fc2cd50a9acb72cd56f8a'),
('srs', '9f97ab1131b1ad6055bd34cdbada48b407764d2e'),
('t.venkat', 'd59f6fe80498ac9e2d09d92b5d729bd064f9bb9d');

-- --------------------------------------------------------

--
-- Table structure for table `questions_quiz`
--

CREATE TABLE IF NOT EXISTS `questions_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(500) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `questions_quiz`
--

INSERT INTO `questions_quiz` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 'United Nation has released "One Women" album on the occasion of International Women''s Day. Name the Indian Artist who was the member of this album?', 'A. R. Rahaman', 'Anoushka Shankar', 'Mallika Sarabhai', 'Amzad Ali Khan', 2),
(2, 'The Government of India and the RBI to introduce one billion pieces of Rs. 10 notes in polymer/plastic on a field trial basis. The field trial will be conducted in five cities. Which of the following is not among them?', 'Shimla', 'Jaipur', 'Nagpur', 'Bhubaneswar', 3),
(3, 'On 12th March 2013 the President of India Mr. Pranab Mukherjee attending the celebration of 45th Anniversary of Independence of which country?', 'Maldive', 'Sri Lanka', 'Vietnaam', 'Mauritius', 4),
(4, 'Name the renowned soccer player who on 9 December, 2012 set the record for most goals in a calendar year by scoring his 86th goal of 2012 ___', 'David Beckham', 'Lionel Messi', 'Cristiano Ronaldo', 'Roberto Carlos', 2),
(5, 'Which team on December 15, 2012 won the 3rd World Cup Kabaddi Tournament for the third consecutive time in the Men''s category and second consecutive time in the Women''s category?', 'India', 'Pakistan', 'Australia', 'England', 1),
(6, 'The Uttar Pradesh government on 4 December, 2012 decided to issue Cards to industrialists and industrial associations for easy access to its offices. What is the name of that card?', 'Platinum Cards', 'Silver cards', 'Golden Cards', 'Industrial cards', 3),
(7, 'Union Government of India on 5 December, 2012 cleared the decks for transferring the prime 12.5 acre United Mill land in Mumbai to the Maharashtra government for building a state-of-the-art memorial for an Indian revolutionary and political leader. Name the political leader ___', 'Sardar Vallabh Bhai Patel', 'B. R. Ambedkar', 'Ramabai Ambedkar', 'Balasaheb Thackrey', 2),
(8, 'The Cauvery Monitoring Committee (CMC) on December 7, 2012 asked Karnataka to provide Tamil Nadu with how many TMC (thousand million cubic) feet of Cauvery water during December 2012 ____', '12 TMC feet', '10 TMC feet', '8 TMC feet', '6 TMC feet', 1),
(9, 'Where did the American Depositary Shares (ADS) of Infosys, India''s second-largest IT services provider start trading on 12 December, 2012?', 'Bombay Stock Exchange', 'National Stock Exchange', 'New York Stock Exchange', 'Singapore Stock Exchange', 3),
(10, 'Scientists in northern Mexico discovered a new dinosaur with a large prominent nose which lived about 73 million years ago. what is the name of this new dinosaur?', 'Latirhinus Uitstlani', 'Gigantoraptor', 'Khaan', 'Raptorex', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `webmail_id` varchar(60) NOT NULL,
  `first` int(11) NOT NULL,
  `second` int(11) NOT NULL,
  `third` int(11) NOT NULL,
  `fourth` int(11) NOT NULL,
  `fifth` int(11) NOT NULL,
  `sixth` int(11) NOT NULL,
  `seventh` int(11) NOT NULL,
  `eighth` int(11) NOT NULL,
  `ninth` int(11) NOT NULL,
  `tenth` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `course_id` varchar(10) NOT NULL,
  PRIMARY KEY (`webmail_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `reported_by` varchar(20) NOT NULL,
  `file_id` int(10) NOT NULL,
  PRIMARY KEY (`reported_by`,`file_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reported_by`, `file_id`) VALUES
('p.dileep', 63),
('p.sai', 64),
('sahil', 77);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `webmail_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `abs_semester` int(2) NOT NULL,
  `abs_year` year(4) NOT NULL,
  PRIMARY KEY (`webmail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`webmail_id`, `name`, `roll_no`, `semester`, `abs_semester`, `abs_year`) VALUES
('p.dileep', 'Dileep', '10010180', 6, 1, 2013),
('p.sai', 'Venkat', '10010149', 6, 1, 2013),
('sahil', 'Sahil Kumar Goyal', '10010175', 6, 2013, 2001),
('sharath', 'Sharath Reddy', '10010174', 6, 1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE IF NOT EXISTS `teaches` (
  `instructor_webmail_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`instructor_webmail_id`,`course_id`,`semester`,`year`),
  KEY `course_id` (`course_id`,`semester`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`instructor_webmail_id`, `course_id`, `semester`, `year`) VALUES
('srs', 'CS344', 1, 2013),
('arnab', 'CS346', 1, 2013),
('t.venkat', 'CS348', 1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_name` varchar(200) NOT NULL,
  `webmail_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `semester` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`thread_id`),
  KEY `course_id` (`course_id`,`semester`,`year`),
  KEY `webmail_id` (`webmail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`thread_id`, `thread_name`, `webmail_id`, `course_id`, `semester`, `year`, `description`) VALUES
(3, 'Final Project  - Discussionthread', 'p.dileep', 'CS344', 1, 2013, 'All the discussion of the final project are to be discussed in this thread and dont create any new thread....'),
(14, 'Parsing', 'p.sai', 'CS346', 1, 2013, 'Syatax analysis'),
(52, 'A new thread', 'p.dileep', 'CS346', 1, 2013, 'A new thread created by me for testing'),
(53, 'Instructoir thread', 'srs', 'CS344', 1, 2013, 'Instructor desc'),
(54, 'Communication systems', 'p.sai', 'CS344', 1, 2013, 'Communication is the basis of any civilization none of the technologies that we use today viz. internet, mobile etc were created within 10000Km radius of this place and the administration here imposes timing constraints on the usage of internet and places so many restrictions on the movement of students. I would like to know that by what percentage has the attendance of students increased in the classes after imposing another restriction of no-internet between 2-5PM from last two years or more or less stopping the DC from operation in the institute.... They should give some thought to the actual roots of this problem and not just finding a way to mitigate one problem by imposing one restriction after the other and creating five other problems for the students....'),
(55, 'Endsem', 'p.sai', 'CS344', 1, 2013, 'This thread is focussed for those students who are having doubts in end semester database. Sharath sent me a personal message for help in BCNF so this will help him....'),
(57, 'New thread', 'p.sai', 'CS346', 1, 2013, 'this thead is for discussion about all topics which are yet to be covered by sir'),
(59, 'Transport layer', 'sahil', 'CS348', 1, 2013, 'Discussion on TCp / UDP');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`webmail_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`uploader_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `enrolls_ibfk_1` FOREIGN KEY (`stud_webmail_id`) REFERENCES `student` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolls_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolls_ibfk_3` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`),
  ADD CONSTRAINT `enrolls_ibfk_4` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`),
  ADD CONSTRAINT `my_key` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`webmail_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`webmail_id_reciever`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`webmail_id_sender`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_course`
--
ALTER TABLE `news_course`
  ADD CONSTRAINT `news_course_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_course_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `news_feed` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD CONSTRAINT `news_feed_ibfk_1` FOREIGN KEY (`webmail`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`webmail_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `documents` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`webmail_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`instructor_webmail_id`) REFERENCES `instructor` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaches_ibfk_3` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`),
  ADD CONSTRAINT `teaches_ibfk_4` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaches_ibfk_5` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`);

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`course_id`, `semester`, `year`) REFERENCES `course_offerings` (`course_id`, `semester`, `absolute_year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_4` FOREIGN KEY (`webmail_id`) REFERENCES `person` (`webmail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
