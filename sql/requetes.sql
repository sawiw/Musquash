-- INSERTION VALEURS
INSERT INTO `utilisateur` (`id`,`nom`,`prenom`,`date_naissance`) VALUES (1,'Suard','Erwann','1991_12_01'),
(2,'Girard','Sami','2001_01_29'),
(3,'Pera','Nicolas','1980_01_24'),
(4,'Soupa','Arthur','2003_09_04');

INSERT INTO `authentification` (`mail`, `mdp`, `login`, `role`, `id_utilisateur`) VALUES 
('erwann@lemail.com','1234','erwann34','utilisateur',1),
('sami@lemail.com','1234','sami34','admin',2),
('nico@lemail.com','1234','nico34','utilisateur',3),
('arthur@lemail.com','1234','arthur34','admin',4);

INSERT INTO `prof` (`sport`, `specialite_gym`,`id_prof`)
VALUES 
('squash', NULL, 3),
('gym', 'step',4);