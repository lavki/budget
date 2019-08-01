-- MySQL Script generated by MySQL Workbench
-- Sun Jul 21 15:19:24 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Budget
-- -----------------------------------------------------
SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `status` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(10) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `status_UNIQUE` (`status` ASC))
ENGINE = InnoDB;

--
-- Дамп даних таблиці `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(3, 'Expensed'),
(1, 'Profit'),
(2, 'Saved');

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `currency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `currency` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `currency` CHAR(3) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `currency_UNIQUE` (`currency` ASC))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `category` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(50) NULL,
  `status_id` TINYINT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `category_UNIQUE` (`category` ASC))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NULL,
  `category_id` TINYINT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `type_UNIQUE` (`type` ASC),
  INDEX `t_fk_category_id_idx` (`category_id` ASC),
  CONSTRAINT `t_fk_category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `wallet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sum` DECIMAL NULL DEFAULT 0.00,
  `status_id` TINYINT UNSIGNED NULL,
  `type_id` INT UNSIGNED NULL,
  `currency_id` TINYINT UNSIGNED NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `w_fk_status_id_idx` (`status_id` ASC),
  INDEX `w_fk_currency_id_idx` (`currency_id` ASC),
  INDEX `w_fk_type_id_idx` (`type_id` ASC),
  CONSTRAINT `w_fk_type_id`
    FOREIGN KEY (`type_id`)
    REFERENCES `type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `w_fk_status_id`
    FOREIGN KEY (`status_id`)
    REFERENCES `status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `w_fk_currency_id`
    FOREIGN KEY (`currency_id`)
    REFERENCES `currency` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- View `view1`
-- -----------------------------------------------------
SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
