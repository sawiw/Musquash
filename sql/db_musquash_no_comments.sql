CREATE DATABASE IF NOT EXISTS musquash_test_commun;
-- USE musquash_test_commun;

-- DROP TABLE IF EXISTS utilisateur_cours_squash_collectif;
-- DROP TABLE IF EXISTS utilisateur_materiel_achat;
-- DROP TABLE IF EXISTS utilisateur_materiel_location;
-- DROP TABLE IF EXISTS utilisateur_formule;
-- DROP TABLE IF EXISTS utilisateur;
-- DROP TABLE IF EXISTS authentification;
-- DROP TABLE IF EXISTS formule;
-- DROP TABLE IF EXISTS promo_formule;
-- DROP TABLE IF EXISTS casier;
-- DROP TABLE IF EXISTS materiel_achat;
-- DROP TABLE IF EXISTS materiel_location;
-- DROP TABLE IF EXISTS prof;
-- DROP TABLE IF EXISTS terrain;
-- DROP TABLE IF EXISTS cours_squash_collectif;
-- DROP TABLE IF EXISTS planning_reservation;


CREATE TABLE IF NOT EXISTS utilisateur(
    id_utilisateur INT NOT NULL,
    nom_utilisateur VARCHAR(30),
    prenom_utilisateur VARCHAR(30),
    date_naissance DATE,
    groupe_utilisateur TINYINT,
    CONSTRAINT pk_utilisateur PRIMARY KEY (id_utilisateur)
);

CREATE TABLE IF NOT EXISTS authentification(
 mail_authentification VARCHAR(30) NOT NULL,
 mdp_authentification VARCHAR(50),
 login_authentification VARCHAR(30),
 role_authentification VARCHAR(15) NOT NULL,
 id_utilisateur INT NOT NULL,
 CONSTRAINT pk_authentification PRIMARY KEY (mail_authentification),
 CONSTRAINT fk_utilisateur_authentification FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE IF NOT EXISTS formule(
    id_formule INT NOT NULL,
    nom_formule VARCHAR(30),
    prix_formule FLOAT,
    CONSTRAINT pk_formule PRIMARY KEY (id_formule)
);

CREATE TABLE IF NOT EXISTS utilisateur_formule(
    id_utilisateur INT NOT NULL,
    id_formule INT NOT NULL,
    date_adhesion DATE,
    duree_mois INT,
    CONSTRAINT pk_utilisateur_formule PRIMARY KEY (id_utilisateur, id_formule),
    CONSTRAINT fk_utilisateur_utilisateur_formule FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    CONSTRAINT fk_formule_utilisateur_formule FOREIGN KEY (id_formule) REFERENCES formule(id_formule)
);

CREATE TABLE IF NOT EXISTS promo_formule(
    id_promo_formule INT NOT NULL,
    pourcentage_promotion INT NOT NULL,
    date_promotion DATE,
    duree_promotion INT,
    id_formule INT NOT NULL,
    CONSTRAINT pk_promo_formule PRIMARY KEY (id_promo_formule),
    CONSTRAINT fk_formule_promo_formule FOREIGN KEY (id_formule) REFERENCES formule(id_formule)
);

CREATE TABLE IF NOT EXISTS casier(
    id_casier INT NOT NULL,
    type_location VARCHAR(10),
    id_utilisateur INT NOT NULL,
    CONSTRAINT pk_casier PRIMARY KEY (id_casier),
    CONSTRAINT fk_utilisateur_casier FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE IF NOT EXISTS materiel_achat(
    id_materiel_achat INT NOT NULL,
    designation_materiel_achat VARCHAR(30),
    quantite_materiel_achat INT,
    tarif_materiel_achat FLOAT,
    CONSTRAINT pk_materiel_achat PRIMARY KEY (id_materiel_achat)
);

CREATE TABLE IF NOT EXISTS utilisateur_materiel_achat(
    date_achat DATE NOT NULL,
    quantite_achat INT,
    id_utilisateur INT NOT NULL,
    id_materiel_achat INT NOT NULL ,
    CONSTRAINT pk_utilisateur_materiel_achat PRIMARY KEY (date_achat,id_utilisateur,id_materiel_achat),
    CONSTRAINT fk_utilisateur_utilisateur_materiel_achat FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    CONSTRAINT fk_materiel_achat_utilisateur_materiel_achat FOREIGN KEY (id_materiel_achat) REFERENCES materiel_achat(id_materiel_achat)
);

CREATE TABLE IF NOT EXISTS materiel_location(
    id_materiel_location INT NOT NULL,
    designation_materiel_location VARCHAR(30),
    quantite_materiel_location INT,
    tarif_materiel_location FLOAT,
    CONSTRAINT pk_materiel_location PRIMARY KEY (id_materiel_location)
);

CREATE TABLE IF NOT EXISTS utilisateur_materiel_location(
    date_location DATE NOT NULL,
    duree INT,
    quantite_location INT,
    id_utilisateur INT NOT NULL,
    id_materiel_location INT NOT NULL,
    CONSTRAINT pk_utilisateur_materiel_location PRIMARY KEY (date_location,id_utilisateur,id_materiel_location),
    CONSTRAINT fk_materiel_loaction_utilisateur_materiel_location FOREIGN KEY (id_materiel_location) REFERENCES materiel_location(id_materiel_location),
    CONSTRAINT fk_utilisateur_utilisateur_materiel_location FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
);

CREATE TABLE IF NOT EXISTS prof(
    sport_prof VARCHAR(15) NOT NULL,
    specialite_gym_prof VARCHAR(20),
    id_prof INT NOT NULL,
    CONSTRAINT pk_prof PRIMARY KEY (id_prof),
    CONSTRAINT fk_utilisateur_prof FOREIGN KEY (id_prof) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE IF NOT EXISTS terrain(
    prix_location FLOAT,
    id_terrain TINYINT NOT NULL,
    CONSTRAINT pk_terrain PRIMARY KEY (id_terrain)
);

CREATE TABLE IF NOT EXISTS cours_squash_collectif(
    groupe_cours_squash_collectif INT,
    horaire_cours_squash_collectif DATETIME,
    id_cours_squash_collectif INT NOT NULL,
    id_prof INT NOT NULL,
    id_terrain TINYINT NOT NULL,
    CONSTRAINT pk_cours_squash_collectif PRIMARY KEY (id_cours_squash_collectif ),
    CONSTRAINT fk_prof_cours_squash_collectif FOREIGN KEY (id_prof) REFERENCES prof(id_prof),
    CONSTRAINT fk_terrain_cours_squash_collectif FOREIGN KEY (id_terrain) REFERENCES terrain(id_terrain)    
);

CREATE TABLE IF NOT EXISTS utilisateur_cours_squash_collectif(
    id_utilisateur INT NOT NULL,
    id_cours_squash_collectif INT NOT NULL,
    CONSTRAINT pk_utilisateur_cours_squash_collectif PRIMARY KEY (id_utilisateur,id_cours_squash_collectif),
    CONSTRAINT fk_utilisateur_utilisateur_cours_squash_collectif FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    CONSTRAINT fk_cours_squash_collectif_utilisateur_cours_squash_collectif FOREIGN KEY (id_cours_squash_collectif) REFERENCES cours_squash_collectif(id_cours_squash_collectif)
);

CREATE TABLE IF NOT EXISTS planning_reservation(
    horaire_planning_reservation DATETIME NOT NULL,
    type_reservation VARCHAR(20) NOT NULL, 
    id_utilisateur INT NOT NULL,
    id_terrain TINYINT,
    CONSTRAINT pk_planning_reservation PRIMARY KEY (horaire_planning_reservation, type_reservation, id_utilisateur,id_terrain),
    CONSTRAINT fk_utilisateur_planning_reservation FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    CONSTRAINT fk_terrain_planning_reservation FOREIGN KEY (id_terrain) REFERENCES terrain (id_terrain) 
);

INSERT INTO utilisateur (id_utilisateur, nom_utilisateur, prenom_utilisateur, date_naissance, groupe_utilisateur) VALUES
(1, "Girard", "Sami", "2001-01-29", 1),
(2, "Suard", "Erwann", "1991-12-01", 3),
(3, "Péra", "Nicolas", "1978-04-12", 1),
(4, "Soupa", "Arthur", "2002-01-01", 2),
(5, "Prof", "Monsieur", "1985-01-01", NULL),
(6, "Prof", "Madame", "1978-02-22", NULL),
(7, "Pierre", "Roger", "1995-03-03", 1);

INSERT INTO authentification(mail_authentification, mdp_authentification, login_authentification, role_authentification, id_utilisateur) VALUES 
('samigirard@lemail.com','zefzeg545ergh','samisami','utilisateur',1),
('erwannsuard@lemail.com','zeg5az354ezg','erwaaaaann','utilisateur',2),
('peranico@lemail.com','25468azdwfe','nicoo','utilisateur',3),
('soupaarthur@lemail.com','524zaaaaaaz','arthurent','utilisateur',4),
('profmr@lemail.com','54a566a4dqsf45','leprofdesquash','prof',5),
('profmme@lemail.com','a7a8z4d5q4sf','laprofdegym','prof',6),
('pierreroger@lemail.com','aaaaaaaaaaa','aaaaaaaa','utilisateur',7);

INSERT INTO formule (id_formule, nom_formule, prix_formule)
VALUES (1, 'Squash cours collectif', 39.99),
  (2, 'Squash cours individuel', 59.99),
  (3, 'Squash location terrain', 17.99),
  (4, 'Gym', 14.99),
  (5, 'Muscu', 14.99);