-- Professor Xavier's Team Management System ---
-- X-Men Heroes Database ----

Create Database if not exists xmen_db;
Use xmen_db;

-- Table: users ---
-- This table stores the login credentials about the authenticated user(admin) of the system.
Drop table if exists users;
Create table users (
    id int not null auto_increment primary key,
    username varchar(50) not null unique,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
);

-- Our default admin user for the system: username: professorx, password: xavier123
insert into users (username, password) values 
('professorx', '$2y$10$5bpHmu0xfbHCz3M1kZd.teWtnMuzN.jy4x20oAFCui5aTek2wOlXa');

-- Table: heroes --
-- This table stores the records of the X-Men heroes managed by Professor Xavier.
Drop table if exists heroes;
Create table heroes (
    id int not null auto_increment primary key,
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

-- Sample X-Men data
INSERT INTO heroes (hero_name, real_name, short_bio, long_bio, powers, team, publisher, gender, status, image_url) VALUES
('Cyclops', 'Scott Summers', 'Field leader of the X-Men with optic blasts.',
 'Scott Summers is one of the founding members of the X-Men and has served as their field leader for most of the team''s history. After an accident in childhood, Scott gained the ability to fire powerful beams of concussive force from his eyes, which he can only control using a special visor or glasses made of ruby quartz. Disciplined and dutiful, Scott was trained personally by Professor Charles Xavier and has led multiple incarnations of the X-Men into battle against threats to mutantkind.',
 'Optic blasts, tactical genius', 'X-Men', 'Marvel Comics', 'Male', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/11161/111612243/10012902-5140161970-b364e.jpg'),

('Jean Grey', 'Jean Grey-Summers', 'Powerful telepath and telekinetic, host of the Phoenix Force.',
 'Jean Grey is one of the most powerful mutants in the Marvel Universe, possessing vast telepathic and telekinetic abilities. A founding member of the X-Men, Jean has repeatedly become host to the cosmic Phoenix Force, an event that has led to some of the most dramatic storylines in X-Men history, including her transformation into Dark Phoenix. She is deeply connected to Scott Summers (Cyclops) and has died and been resurrected multiple times.',
 'Telepathy, telekinesis, Phoenix Force', 'X-Men', 'Marvel Comics', 'Female', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/11174/111743204/9631969-snapinst.app_478483283_18489451930039453_2656336862039838358_n_1080.jpg'),

('Wolverine', 'James "Logan" Howlett', 'Feral mutant with a healing factor and adamantium claws.',
 'Wolverine, also known as Logan, is a mutant possessing animal-keen senses, enhanced physical capabilities, three retractable bone claws in each hand, and a healing factor that allows him to recover from virtually any wound. His skeleton and claws were later bonded with the indestructible metal adamantium as part of the Weapon X program. Gruff and independent, Wolverine has served on multiple X-Men teams while carrying the emotional scars of a mysterious past.',
 'Healing factor, adamantium claws, enhanced senses', 'X-Men', 'Marvel Comics', 'Male', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/11161/111612243/9575315-3753315455-latest.jpg'),

('Storm', 'Ororo Munroe', 'Mutant who can control and manipulate the weather.',
 'Ororo Munroe, known as Storm, is a mutant with the ability to control atmospheric conditions, including wind, lightning, and precipitation. Worshipped as a goddess in parts of Africa during her youth, Storm later joined the X-Men and became one of its most respected leaders, at times leading the team herself. She is known for her regal bearing, deep empathy, and close friendship with Professor Xavier and Wolverine.',
 'Weather manipulation, flight', 'X-Men', 'Marvel Comics', 'Female', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/11174/111743204/9636122-storm7%2Cmateusmanhanini.jpg'),

('Beast', 'Henry "Hank" McCoy', 'Genius scientist with ape-like agility and strength.',
 'Hank McCoy, known as Beast, is a founding member of the X-Men who combines tremendous physical strength and agility with genius-level intellect in genetics and biochemistry. His mutation initially gave him oversized hands and feet, but subsequent experiments transformed him further, giving him a more feral, blue-furred appearance. Despite his intimidating look, Hank is soft-spoken, well-read, and often serves as the team''s resident scientist and moral conscience.',
 'Superhuman strength and agility, genius intellect', 'X-Men', 'Marvel Comics', 'Male', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/11112/111123579/7166569-x-force_vol_6_6_textless.jpg'),

('Professor X', 'Charles Francis Xavier', 'Founder of the X-Men and the world''s most powerful telepath.',
 'Charles Xavier, known as Professor X, is the founder of the X-Men and one of the most powerful telepaths on Earth. Paralyzed from the waist down, Charles built Xavier''s School for Gifted Youngsters to train young mutants to use their powers responsibly and to promote peaceful coexistence between mutants and humans. A brilliant strategist and mentor, he has shaped generations of X-Men while battling threats both external and, at times, from within his own mind.',
 'Telepathy, psychic shields, astral projection', 'X-Men', 'Marvel Comics', 'Male', 'Active', 'https://comicvine.gamespot.com/a/uploads/scale_small/10/100647/7261595-hox1pichelli.jpg');
