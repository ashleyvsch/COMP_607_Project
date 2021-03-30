CREATE DATABASE adoptable_dogs;

  use adoptable_dogs;

  CREATE TABLE dog (
    did INT(11) UNSIGNED PRIMARY KEY,
    dogname VARCHAR(30) NOT NULL,
    dogage VARCHAR(30) NOT NULL,
    dogstatus VARCHAR(50) NOT NULL,
  );