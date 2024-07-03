CREATE DATABASE IF NOT EXISTS ereto_scan;
USE ereto_scan;

CREATE TABLE IF NOT EXISTS users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  logo VARCHAR(255) DEFAULT "sem_avatar.jpg",
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS mangas(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) DEFAULT("sem titulo"),
  logo VARCHAR(255) DEFAULT ("sem_capa.jpg"),
  author VARCHAR(100) DEFAULT("desconhecido")
);

CREATE TABLE IF NOT EXISTS bios(
  id INT AUTO_INCREMENT PRIMARY KEY,
  type ENUM('manhwa', 'manhua', 'manga') NOT NULL,
  sinopse TEXT DEFAULT("SEM INFORMAÇÕES"),
  language VARCHAR(30) DEFAULT("SEM INFORMAÇÕES"),
  status_source VARCHAR(50) DEFAULT('SEM INFORMAÇÕES'),
  release_status VARCHAR(50) DEFAULT('SEM INFORMAÇÕES'),
  age_rating INT DEFAULT(12),
  total_chapters INT DEFAULT(0),
  last_updated DATE DEFAULT(NOW()),
  manga_id INT UNIQUE,
  FOREIGN KEY(manga_id) REFERENCES mangas(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS chapters(
  id INT AUTO_INCREMENT PRIMARY KEY,
  manga_id INT,
  chapter_number INT NOT NULL,
  title VARCHAR(255) DEFAULT("SEM TITULO"),
  release_date DATE DEFAULT(NOW()),
  FOREIGN KEY(manga_id) REFERENCES mangas(id) ON DELETE CASCADE
);
