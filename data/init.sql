CREATE DATABASE adoptable_dogs;

  use adoptable_dogs;

  CREATE TABLE dog (
    did int auto_increment,
    dogname VARCHAR(30) NOT NULL,
    dogage VARCHAR(30) NOT NULL,
    dogstatus VARCHAR(50) NOT NULL,
    constraint pk_dog PRIMARY KEY (did)
  );