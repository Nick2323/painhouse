-- Створення бази даних для проекту PainHouse
-- Ансамбль "Воля"

CREATE DATABASE IF NOT EXISTS `kogut` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kogut`;

-- Таблиця адміністраторів
CREATE TABLE IF NOT EXISTS `admins` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Додаємо дефолтного адміністратора
-- Логін: admin
-- Пароль: admin123
-- SHA1 hash паролю: d033e22ae348aeb5660fc2140aec35850c4da997
INSERT INTO `admins` (`Login`, `Password`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- Таблиця учасників ансамблю
CREATE TABLE IF NOT EXISTS `members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(255) NOT NULL,
  `PhotoName` varchar(255) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Таблиця репертуару
CREATE TABLE IF NOT EXISTS `repertoire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Приклад категорій та пісень
INSERT INTO `repertoire` (`Name`, `Category`) VALUES
('', 'Українські народні пісні'),
('На Вкраїні ми родились', 'Українські народні пісні'),
('Рушив поїзд в далеку дорогу', 'Українські народні пісні'),
('А зорі, а зорі по синьому морі', 'Українські народні пісні'),
('Ой, чий то кінь стоїть?', 'Українські народні пісні'),
('Ішов козак потайком', 'Українські народні пісні'),
('Ой, у вишневому саду', 'Українські народні пісні'),
('', 'Авторські пісні'),
('Рушничок для сина', 'Авторські пісні'),
('Мамина коса', 'Авторські пісні'),
('', 'Патріотичні пісні'),
('Люляй, люляй, мій синочку', 'Патріотичні пісні'),
('Я сьогодні щось дуже сумую', 'Патріотичні пісні');

-- Таблиця медіафайлів (фото, відео, аудіо)
CREATE TABLE IF NOT EXISTS `media` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MediaFileName` varchar(255) NOT NULL,
  `MediaType` varchar(10) NOT NULL,
  `Description` text,
  `Extra` tinyint(1) DEFAULT 0 COMMENT '0 - фото, 1 - відео/аудіо',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
