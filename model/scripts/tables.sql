CREATE TABLE Actors(
   actor_id BIGINT AUTO_INCREMENT,
   actor_firstname VARCHAR(50) NOT NULL,
   actor_lastname VARCHAR(50) NOT NULL,
   PRIMARY KEY(actor_id)
);

CREATE TABLE Languages(
   lang_id INT AUTO_INCREMENT,
   lang_name VARCHAR(50) NOT NULL,
   lang_short VARCHAR(5) NOT NULL,
   PRIMARY KEY(lang_id),
   UNIQUE(lang_name),
   UNIQUE(lang_short)
);

CREATE TABLE Countries(
   country_id INT AUTO_INCREMENT,
   country_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(country_id),
   UNIQUE(country_name)
);

CREATE TABLE Genres(
   genre_id INT AUTO_INCREMENT,
   genre_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(genre_id),
   UNIQUE(genre_name)
);

CREATE TABLE Users(
   user_id BIGINT AUTO_INCREMENT,
   user_name VARCHAR(15) NOT NULL,
   user_hashpwd VARCHAR(50) NOT NULL,
   user_email VARCHAR(50) NOT NULL,
   PRIMARY KEY(user_id),
   UNIQUE(user_email)
);

CREATE TABLE Movies(
   movie_id BIGINT AUTO_INCREMENT,
   movie_title VARCHAR(50) NOT NULL,
   movie_poster VARCHAR(50),
   movie_duration TIME NOT NULL,
   movie_summary VARCHAR(50),
   movie_score DECIMAL(2,1) NOT NULL,
   country_id INT NOT NULL,
   PRIMARY KEY(movie_id),
   FOREIGN KEY(country_id) REFERENCES Countries(country_id)
);

CREATE TABLE Played_by(
   movie_id BIGINT,
   actor_id BIGINT,
   PRIMARY KEY(movie_id, actor_id),
   FOREIGN KEY(movie_id) REFERENCES Movies(movie_id)
    ON DELETE CASCADE,
   FOREIGN KEY(actor_id) REFERENCES Actors(actor_id)
);

CREATE TABLE Available_in(
   movie_id BIGINT,
   lang_id INT,
   PRIMARY KEY(movie_id, lang_id),
   FOREIGN KEY(movie_id) REFERENCES Movies(movie_id)
    ON DELETE CASCADE,
   FOREIGN KEY(lang_id) REFERENCES Languages(lang_id)
);

CREATE TABLE Have(
   movie_id BIGINT,
   genre_id INT,
   PRIMARY KEY(movie_id, genre_id),
   FOREIGN KEY(movie_id) REFERENCES Movies(movie_id)
    ON DELETE CASCADE,
   FOREIGN KEY(genre_id) REFERENCES Genres(genre_id)
);
