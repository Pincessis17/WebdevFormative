--- Professor Xavier's Team Management System ---
--- X-Men Heroes Database ----

Create Database if not exists xmen_db;
Use xmen_db;

--- Table: users ---
--This table stores the login credentials about the authenticated user(admin) of the system.
Drop table if exists users;
Create table users (
    user_id int not null auto_increment primary key,
    username varchar(50) not null unique,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
);

--Our default admin user for the system: username: professorx, password: xavier123
insert into users (username, password) values 
('professorx', '2b$10$Kn9JZAy3tW0QTum9Y7zHPuuh5hFV.PZfBofYF4BuCrto99vewA5dy');

--- Table: heroes ---
--- This table stores the records of the X-Men heroes managed by Professor Xavier.
Drop table if exists heroes;
Create table heroes (
    hero_id int not null auto_increment primary key,
    hero_name varchar(100) not null,
    real_name varchar(100) not null,
    short_bio VARCHAR(255) NOT NULL,
    long_bio TEXT NOT NULL,
    powers VARCHAR(255),
    team VARCHAR(100),
    publisher VARCHAR(100) DEFAULT 'Marvel Comics',
    gender VARCHAR(20),
    status VARCHAR(20) DEFAULT 'Active',
    image_url VARCHAR(255),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);