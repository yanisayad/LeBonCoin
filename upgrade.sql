-- Sql - reset
DROP TABLE IF EXISTS `addresses`;
DROP TABLE IF EXISTS `contacts`;
DROP TABLE IF EXISTS `users`;

-- Sql - table users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sql - table contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(225) NOT NULL,
  `prenom` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sql - table addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(4) NOT NULL,
  `street` varchar(225) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(225) NOT NULL,
  `country` varchar(225) NOT NULL,
  `idContact` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idContact` (`idContact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sql - contraintes

ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`idContact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

-- Sql - initialisation user de test

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, 'admin', 'lebonoin@test.fr', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin', 'yanis@test.fr', '21232f297a57a5a743894a0e4a801fc3');
COMMIT;

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `email`, `userId`) VALUES
(1, 'AYAD', 'Yanis', 'ayad_y@etna-alternance.net', 2);
COMMIT;

INSERT INTO `addresses` (`id`, `number`, `street`, `postalCode`, `city`, `country`, `idContact`) VALUES
(1, 7, 'rue Maurice Grandcoing', 94200, 'Ivry-sur-seine', 'France', 1),
(2, 76, 'rue Colonel Fabien', 94200, 'Ivry-sur-seine', 'France', 1),
(3, 26, 'avenue Cusino', 93600, 'Aulnay-sous-bois', 'France', 1);
COMMIT;
