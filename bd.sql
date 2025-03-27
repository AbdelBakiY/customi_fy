USE abdel_customi_fy;
drop table if exists users;
CREATE TABLE IF NOT EXISTS users_voitures(
    id INT  PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100) not null,
    Prenom VARCHAR(100)not null,
    email VARCHAR(200) not null,
    tel VARCHAR(100) not null,
    mdp VARCHAR(100),
    role VARCHAR(100) not null default "user" check(role IN ('admin','user'))
);



