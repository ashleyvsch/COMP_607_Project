CREATE DATABASE adoptable_dogs;

  use adoptable_dogs;

    CREATE TABLE color (
    cid int NOT NULL,
    cname VARCHAR(50) NOT NULL,
    constraint pk_color PRIMARY KEY (cid)
    );

    INSERT INTO color (cid, cname)
    values
    (1, 'white'),
    (2, 'black'),
    (3, 'brown'),
    (4, 'grey'),
    (5, 'red'),
    (6, 'gold'),
    (7, 'yellow'),
    (8, 'cream'),
    (9, 'blue');

  CREATE TABLE breed (
    bid int NOT NULL,
    bname VARCHAR(100) NOT NULL,
    bweight VARCHAR(10),
    bgroup VARCHAR(100),
    constraint pk_breed PRIMARY KEY (bid)
  );

  INSERT INTO breed (bid, bname, bweight, bgroup)
  values
  ('1', 'Mixed', NULL, NULL),
  ('2', 'Other', NULL, NULL),
  ('3', 'Alaskan Malamute', '85', 'Working Group'),
  ('4', 'American Pit Bull Terrier', '50-79', 'Terrier Group'),
  ('5', 'American Staffordshire Terrier', '55-70', 'Terrier Group'),
  ('6', 'Australian Shepherd', '50-65', 'Herding Group'),
  ('7', 'Bernese Mountain Dog', '80-155', 'Working Group'),
  ('8', 'Border Collie', '30-55', 'Herding Group'),
  ('9', 'Boston Terrier', '12-25', 'Non-Sporting Group'),
  ('10', 'Bulldog', '51-55', 'Non-Sporting Group'),
  ('11', 'Chihuahua', '6', 'Toy Group'),
  ('12', 'Dashshund', '16-32', 'Hound Group'),
  ('13', 'Dobermann', '75-100', 'Working Group'),
  ('14', 'French Bulldog', '28', 'Non-Sporting Group'),
  ('15', 'German Shepherd', '65-90', 'Herding Group'),
  ('16', 'Golden Retriever', '55-65', 'Sporting Group'),
  ('17', 'Great Dane', '140-175', 'Working Group'),
  ('18', 'Greyhound', '65-70', 'Hound Group'),
  ('19', 'Labrador Retriever', '65-80', 'Sporting Group'),
  ('20', 'Maltese', '7', 'Toy Group'),
  ('21', 'Pembroke Welsh Corgi', '30', 'Herding Group'),
  ('22', 'Pomeranian', '3-7', 'Toy Group'),
  ('23', 'Poodle', '60-70', 'Non-Sporting Group'),
  ('24', 'Rottweiler', '95-135', 'Working Group'),
  ('25', 'Siberian Husky', '45-60', 'Working Group');

  CREATE TABLE dog (
    did int auto_increment,
    dogname VARCHAR(50) NOT NULL,
    dogage VARCHAR(30),
    dogweight VARCHAR(50),
    dogstatus VARCHAR(50) NOT NULL,
    bid int NOT NULL, 
    FOREIGN KEY (bid) REFERENCES breed(bid) ON DELETE CASCADE,
    constraint pk_dog PRIMARY KEY (did)
  );

  INSERT INTO dog (dogname, dogage, dogweight, dogstatus, bid)
    values
    ('Jack', '4', '20', 'adopted','3'),
    ('Chewy', '0.5', '60', 'adopted','15'),
    ('Cookie', '10', '30', 'adoptable','16'),
    ('Duke', '3', '55', 'adoptable','19'),
    ('Basil', '3.4', '45', 'adoptable','1'),
    ('Bean', '0.2', '35', 'adoptable','2'),
    ('Cinnamon', '0.8', '30', 'adoptable','3'),
    ('Harley', '2.5', '60', 'adoptable','4'),
    ('Tasha', '1.5', '55', 'adoptable','5'),
    ('Stella', '4.5', '40', 'adoptable','6'),
    ('Tyson', '8', '110', 'adoptable','7'),
    ('Terminator', '3', '55', 'adoptable','8'),
    ('Stanley', '7', '40', 'adoptable','9'),
    ('Oreo', '5', '51', 'adoptable','10'),
    ('Mike', '6', '6', 'adoptable','11'),
    ('Doug', '9', '20', 'adoptable','12'),
    ('Lucky', '3.1', '80', 'adoptable','13'),
    ('Marley', '0.5', '15', 'adoptable','14'),
    ('Leo', '3.5', '65', 'adoptable','15'),
    ('Frank', '2', '60', 'adoptable','16'),
    ('Dixie', '2', '155', 'adoptable','17'),
    ('Lucy', '3', '65', 'adoptable','18'),
    ('Gus', '4', '70', 'adoptable','19'),
    ('Coco', '5', '7', 'adoptable','20'),
    ('Rock', '6', '30', 'adoptable','21'),
    ('Regis', '7', '4', 'adoptable','22'),
    ('Matt', '8', '60', 'adoptable','23'),
    ('Cleo', '9', '95', 'adoptable','24'),
    ('Buddy', '11', '55', 'adoptable','25');

  CREATE TABLE has_color(
    cid int NOT NULL,
    did int NOT NULL,
    constraint pk_has_color PRIMARY KEY (cid, did),
    FOREIGN KEY (cid) REFERENCES color(cid) ON DELETE CASCADE,
    FOREIGN KEY (did) REFERENCES dog(did) ON DELETE CASCADE
  );

  INSERT INTO has_color (did, cid) 
    values 
    (1, 1),
    (1, 3),
    (2, 2),
    (3, 6),
    (4, 1),
    (5, 2),
    (6, 1),
    (6, 3),
    (7, 1),
    (7, 2),
    (8, 1),
    (9, 3),
    (10, 1),
    (10, 3),
    (11, 2),
    (11, 1),
    (12, 2),
    (13, 8),
    (14, 4),
    (15, 3),
    (16, 3),
    (17, 2),
    (18, 7),
    (19, 8),
    (20, 9),
    (21, 2),
    (22, 7),
    (23, 1),
    (24, 6),
    (25, 2),
    (26, 1),
    (27, 2),
    (28, 1),
    (29, 1);


  CREATE TABLE adopter (
    aid int auto_increment,
    afname VARCHAR(50) NOT NULL,
    alname VARCHAR(50) NOT NULL,
    aphone  VARCHAR(50),
    aemail VARCHAR(100),
    constraint pk_aid PRIMARY KEY (aid)
  );

  INSERT INTO adopter (afname, alname, aphone, aemail)
    values
    ('Jane', 'Smith', '619-635-8723', 'janesmith@gmail.com'),
    ('Jeremy', 'Brown', '619-345-7823', 'jeremy123@gmail.com');

  CREATE TABLE adopted (
    aid int NOT NULL,
    did int NOT NULL,
    adate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    constraint pk_adopted PRIMARY KEY (aid, did),
    FOREIGN KEY (aid) REFERENCES adopter(aid) ON DELETE CASCADE,
    FOREIGN KEY (did) REFERENCES dog(did) ON DELETE CASCADE
  );

  INSERT INTO adopted (did, aid)
    values
    ('1', '1'),
    ('2', '2');

  CREATE TABLE shelter_address (
    postal_code VARCHAR(10) NOT NULL,
    city VARCHAR(50) NOT NULL,
    s_state VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL,
    constraint pk_shelter_address PRIMARY KEY (postal_code)
  );

  INSERT INTO shelter_address (postal_code, city, s_state, country)
    values
    ('92101', 'San Diego', 'California', 'United Sates'),
    ('92115', 'San Diego', 'California', 'United Sates');

  CREATE TABLE shelter (
    shid int NOT NULL,
    sname VARCHAR(200) NOT NULL,
    sphone VARCHAR(50) NOT NULL,
    semail VARCHAR(50) NOT NULL,
    swebsite VARCHAR(100) NOT NULL,
    address1 VARCHAR(50) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    constraint pk_shelter PRIMARY KEY (shid, postal_code),
    FOREIGN KEY (postal_code) REFERENCES shelter_address(postal_code) ON DELETE CASCADE
  );

  INSERT INTO shelter (shid, sname, sphone, semail, swebsite, address1, postal_code)
    values
    ('1', 'San Diego Dog Rescue', '619-453-8253', 'sddogrescue@gmail .com', 'sddogrescue.com', '3421 D St', '92101'),
    ('2', 'Baja Mexico Dog Rescue', '619-537-8264', 'bajadogrescue@gmail.com', 'bajadogrecue.com', '3524 Baja Rd', '92115'),
    ('3', 'Senior Shelter', '619-246-9742', 'seniorshelter@gmail.com', 'seniorshelter.com', '6532 Columbia St', '92115');

  CREATE TABLE received (
    shid int NOT NULL,
    did int NOT NULL,
    rdate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    constraint pk_received PRIMARY KEY (shid, did),
    FOREIGN KEY (shid) REFERENCES shelter(shid) ON DELETE CASCADE,
    FOREIGN KEY (did) REFERENCES dog(did) ON DELETE CASCADE
  );

  INSERT INTO received (did, shid) 
    values 
    ('1', '1'),
    ('2', '2'),
    ('3', '3'),
    ('4', '1'),
    ('5', '2'),
    ('6', '2'),
    ('7', '2'),
    ('8', '2'),
    ('9', '2'),
    ('10', '3'),
    ('11', '3'),
    ('12', '3'),
    ('13', '3'),
    ('14', '3'),
    ('15', '3'),
    ('16', '1'),
    ('17', '2'),
    ('18', '3'),
    ('19', '1'),
    ('20', '1'),
    ('21', '1'),
    ('22', '2'),
    ('23', '3'),
    ('24', '2'),
    ('25', '3'),
    ('26', '2'),
    ('27', '3'),
    ('28', '2'),
    ('29', '3');
