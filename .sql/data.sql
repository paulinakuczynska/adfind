CREATE TABLE Category (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(50) NOT NULL,
  parent_id INT DEFAULT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE File (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name_hash CHAR(32) NOT NULL,
  name_add VARCHAR(255) DEFAULT NULL,
  name_view VARCHAR(255) NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (name_hash),
  FOREIGN KEY (category_id) REFERENCES Category(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

CREATE TABLE Tag (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(30) NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE MapTag (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  tag_id INT UNSIGNED NOT NULL,
  file_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  INDEX tagfile (tag_id, file_id),
  FOREIGN KEY (file_id) REFERENCES File(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (tag_id) REFERENCES Tag(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;