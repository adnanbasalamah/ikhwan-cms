CREATE DATABASE tvrsa1;

USE tvrsa1;
CREATE TABLE video
(
	id bigint auto_increment PRIMARY KEY,
	video_title varchar(50),	 	 	 	 	 	 
	video_teaser tinytext,		 	 	 	 	 	 	 
	video_url tinytext,	 	 	 	 	 	 	 
	screenshoot_url tinytext, 	 	 	 	 	 
	video_category varchar(50),	 	 	 	 	 	 	 
	video_producer varchar(50),		 	 	 	 	 	 	 
	video_tag tinytext,	 	 	 	 	 	 	 
	video_date date
);

CREATE TABLE video_category
(
	id bigint auto_increment PRIMARY KEY,
	cat varchar(50)
);

CREATE TABLE video_producer
(
	id bigint auto_increment PRIMARY KEY,
	prod varchar(50)
);

INSERT video_category (cat) VALUES ('berita');
INSERT video_category (cat) VALUES ('dialog');
INSERT video_category (cat) VALUES ('dokumentari');
INSERT video_category (cat) VALUES ('drama');
INSERT video_category (cat) VALUES ('klip');

INSERT video_producer (prod) VALUES ('zone pusat-makassar');
INSERT video_producer (prod) VALUES ('zone kedah-madinah');
INSERT video_producer (prod) VALUES ('zone ibu pejabat');
INSERT video_producer (prod) VALUES ('zone jawa 1 - sumatra 2');


INSERT video (video_title,video_teaser,video_url,screenshoot_url,video_category,video_producer,video_tag,video_date) 
	VALUES('ayam daging vs ayam kampung','manakah yg anda pilih','http://player.vimeo.com/video/40070774','http://nurmuhammad.tv/wp-content/uploads/2012/04/ayam-3-200x200.jpg','clip','zon tengah','clip','1985-09-09');
INSERT video (video_title,video_teaser,video_url,screenshoot_url,video_category,video_producer,video_tag,video_date) 
	VALUES('ayam daging vs ayam kampung','manakah yg anda pilih','http://player.vimeo.com/video/40070774','http://nurmuhammad.tv/wp-content/uploads/2012/04/ayam-3-200x200.jpg','clip','zon tengah','clip','1990-01-01');
INSERT video (video_title,video_teaser,video_url,screenshoot_url,video_category,video_producer,video_tag,video_date) 
	VALUES('ayam daging vs ayam kampung','manakah yg anda pilih','http://player.vimeo.com/video/40070774','http://nurmuhammad.tv/wp-content/uploads/2012/04/ayam-3-200x200.jpg','clip','zon tengah','clip','2000-01-01');
