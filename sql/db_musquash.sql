CREATE DATABASE IF NOT EXISTS `musquash_complet`;
USE `musquash_complet`;

DROP TABLE IF EXISTS `utilisateur`;
DROP TABLE IF EXISTS `authentification`;
DROP TABLE IF EXISTS `formule`;
DROP TABLE IF EXISTS `utilisateur_formule`;
DROP TABLE IF EXISTS `promo_formule`;
DROP TABLE IF EXISTS `casier`;
DROP TABLE IF EXISTS `materiel_achat`;
DROP TABLE IF EXISTS `utilisateur_materiel_achat`;
DROP TABLE IF EXISTS `materiel_location`;
DROP TABLE IF EXISTS `utilisateur_materiel_location`;
DROP TABLE IF EXISTS `prof`;
DROP TABLE IF EXISTS `terrain`;
DROP TABLE IF EXISTS `cours_squash_collectif`;
DROP TABLE IF EXISTS `utilisateur_cours_squash_collectif`;
DROP TABLE IF EXISTS `planning_reservation`;


CREATE TABLE IF NOT EXISTS `utilisateur`(
    `id` INT NOT NULL,
    `nom` VARCHAR(30),
    `prenom` VARCHAR(30),
    `date_naissance` DATE,
    CONSTRAINT `pk_utilisateur` PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `authentification`(
 `mail` VARCHAR(30) NOT NULL,
 `mdp` VARCHAR(50),
 `login` VARCHAR(30),
 `role` VARCHAR(15) NOT NULL,
 `id_utilisateur` INT NOT NULL,
 CONSTRAINT `pk_authentification` PRIMARY KEY (`mail`),
 CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`)
);

CREATE TABLE IF NOT EXISTS `formule`(
    `id` INT NOT NULL,
    `nom_formule` VARCHAR(30),
    `prix_formule` FLOAT,
    CONSTRAINT `pk_formule` PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `utilisateur_formule`(
    `id_utilisateur` INT NOT NULL,
    `id_formule` INT NOT NULL,
    `date_adhesion` DATE,
    `duree_mois` INT,
    CONSTRAINT `pk_utilisateur_formule` PRIMARY KEY (`id_utilisateur`, `id_formule`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`),
    CONSTRAINT `fk_formule` FOREIGN KEY (`id_formule`) REFERENCES `formule`(`id`)
);

CREATE TABLE IF NOT EXISTS `promo_formule`(
    `id` INT NOT NULL,
    `pourcentage_promotion` INT NOT NULL,
    `date_promotion` DATE,
    `duree_promotion` INT,
    `id_formule` INT NOT NULL,
    CONSTRAINT `pk_promo_formule` PRIMARY KEY (`id`),
    CONSTRAINT `fk_formule` FOREIGN KEY (`id_formule`) REFERENCES `formule`(`id`)
);

CREATE TABLE IF NOT EXISTS `casier`(
    `id` INT NOT NULL,
    `type_location` VARCHAR(10),
    `id_utilisateur` INT NOT NULL,
    CONSTRAINT `pk_casier` PRIMARY KEY (`id`),
    CONSTRAINT `fk_casier` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`)
);

CREATE TABLE IF NOT EXISTS `materiel_achat`(
    `id` INT NOT NULL,
    `designation` VARCHAR(30),
    `quantite` INT,
    `tarif` FLOAT,
    CONSTRAINT `pk_materiel_achat` PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `utilisateur_materiel_achat`(
    `date_achat` DATE NOT NULL,
    `quantite_achat` INT,
    `id_utilisateur` INT NOT NULL,
    `id_materiel_achat` INT NOT NULL ,
    CONSTRAINT `pk_utilisateur_materiel_achat` PRIMARY KEY (`date_achat`,`id_utilisateur`,`id_materiel_achat`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`),
    CONSTRAINT `fk_materiel_achat` FOREIGN KEY (`id_materiel_achat`) REFERENCES `materiel_achat`(`id`)
);

CREATE TABLE IF NOT EXISTS `materiel_location`(
    `id` INT NOT NULL,
    `designation` VARCHAR(30),
    `quantite` INT,
    `tarif` FLOAT,
    CONSTRAINT `pk_materiel_location` PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `utilisateur_materiel_location`(
    `date_location` DATE NOT NULL,
    `duree` INT,
    `quantite_location` INT,
    `id_utilisateur` INT NOT NULL,
    `id_materiel_location` INT NOT NULL,
    CONSTRAINT `pk_utilisateur_materiel_location` PRIMARY KEY (`date_location`,`id_utilisateur`,`id_materiel_location`),
    CONSTRAINT `fk_materiel_loaction` FOREIGN KEY (`id_materiel_location`) REFERENCES `materiel_location`(`id`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`)
);

CREATE TABLE IF NOT EXISTS `prof`(
    `sport` VARCHAR(15) NOT NULL,
    `specialite_gym` VARCHAR(20),
    `id_prof` INT NOT NULL,
    CONSTRAINT `pk_prof` PRIMARY KEY (`id_prof`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_prof`) REFERENCES `utilisateur`(`id`)
);

CREATE TABLE IF NOT EXISTS `terrain`(
    `prix_location` FLOAT,
    `id` INT NOT NULL,
    CONSTRAINT `pk_terrain` PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `cours_squash_collectif`(
    `groupe` INT,
    `jour` VARCHAR(10),
    `heure` TIME,
    `id` INT NOT NULL,
    `id_prof` INT NOT NULL,
    `id_terrain` INT NOT NULL,
    CONSTRAINT `pk_cours_squash_collectif` PRIMARY KEY (`id`),
    CONSTRAINT `fk_prof` FOREIGN KEY (`id_prof`) REFERENCES `prof`(`id_prof`),
    CONSTRAINT `fk_terrain` FOREIGN KEY (`id_terrain`) REFERENCES `terrain`(`id`)    
);

CREATE TABLE IF NOT EXISTS `utilisateur_cours_squash_collectif`(
    `id_utilisateur` INT NOT NULL,
    `id_cours` INT NOT NULL,
    CONSTRAINT `pk_utilisateur_cours_squash_collectif` PRIMARY KEY (`id_utilisateur`,`id_cours`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`),
    CONSTRAINT `fk_cours_squash_collectif` FOREIGN KEY (`id_cours`) REFERENCES `cours_squash_collectif`(`id`)
);

CREATE TABLE IF NOT EXISTS `planning_reservation`(
    `horaire` DATETIME NOT NULL,
    `type_reservation` VARCHAR(20) NOT NULL, 
    `id_utilisateur` INT NOT NULL,
    CONSTRAINT `pk_planning_reservation` PRIMARY KEY (`horaire`, `type_reservation`, `id_utilisateur`),
    CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`) 
);
