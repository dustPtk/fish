-- 创建用户表
drop table IF EXISTS fish_user;

create table fish_user(
id int(4) unsigned not null auto_increment,
user_name varchar(30) not null,
password varchar(30) not null,
primary key(id)
)engine= InnoDB default charset = utf8;


-- 创建新闻表
drop table if exists fish_news;

create table fish_news(
id int(11) unsigned not null auto_increment,
news_name varchar(50) not null,
news_date date not null,
news_editor varchar(30) not null,
news_content varchar(1000) not null,
news_status int(2) not null default 0,
primary key(id)
)engine = InnoDB default charset = utf8;

-- 图片表
drop table if exists fish_img;

create table fish_img(
id int(11) unsigned not null auto_increment,
img_name varchar(50) not null,
img_url_max varchar(200) not null,
img_url_min varchar(200) not null,
img_news_id int(11) not null,
primary key(id)
)engine =InnoDB default charset = utf8;


--公告表
drop table if exists fish_notice;

create table fish_notice(
id int(11) unsigned not null auto_increment,
notice_name varchar(100) not null,
notice_content varchar(500) not null,
notice_status int(2) not null default 0,
notice_editor varchar(30) not null,
notice_date date not null,
primary key(id)
)engine = InnoDB default charset = utf8;

--文章表
drop table if exists fish_article;

create table fish_article(
id int(11) unsigned not null auto_increment,
article_name varchar(100) not null,
article_content varchar(1000) not null,
article_editor varchar(30) not null,
article_date date not null,
primary key(id)
)engine = InnoDB default charset = utf8;

--食物表
drop table if exists fish_food;

create table fish_food(
id int(11) unsigned not null auto_increment,
food_name varchar(30) not null,
food_intro varchar(500) not null,
food_img_max varchar(200) not null,
food_img_min varchar(200) not null,
food_date date not null,
primary key(id)
)engine = InnoDB default charset = utf8;

--公共图片表
drop table if exists fish_common_img;


create table fish_common_img(
id int(11) unsigned not null auto_increment,
img_name varchar(30) not null,
img_intro varchar(100),
img_url_max varchar(200) not null,
img_url_min varchar(200) not null,
img_date date not null,
primary key(id)
)engine = InnoDB default charset = utf8;