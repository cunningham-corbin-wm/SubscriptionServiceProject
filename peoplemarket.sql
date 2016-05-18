CREATE TABLE `peoplemarket` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(24),
  `last_name` VARCHAR(24),
  `email` VARCHAR(48),
  `location` ENUM('Pheonix', 'Glendale', 'Peoria', 'Scottsdale', 'Chandler', 'Surprise'),
  `password` VARCHAR(24),
  `optsales` ENUM('true', 'false') DEFAULT 'true',
  `optcoupons` ENUM('true', 'false') DEFAULT 'true',
  `optraffle` ENUM('true', 'false') DEFAULT 'false',
  PRIMARY KEY (`id`)
  );