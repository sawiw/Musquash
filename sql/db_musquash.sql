CREATE DATABASE IF NOT EXISTS 'db_musquash';

USE 'db_musquash';

CREATE TABLE IF NOT EXISTS 'utilisateur' (
    'id_user' INT NOT NULL,
    'nom_user' VARCHAR(50) NOT NULL,
    'prenom_user' VARCHAR(25) NOT NULL,
    'date_naissance_user' DATE NOT NULL,
    CONSTRAINT PRIMARY KEY ('id_user')
);

CREATE TABLE IF NOT EXISTS 'formule' (
    'id_formule' INT NOT NULL,
    'nom_formule' VARCHAR(25) NOT NULL,
    'prix' FLOAT NOT NULL,
    CONSTRAINT PRIMARY_KEY ('id_formule')
);

CREATE TABLE IF NOT EXISTS 'formule_utilisateur' (

);