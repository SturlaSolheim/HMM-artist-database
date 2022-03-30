DROP TABLE IF EXISTS `HMMDB`.`Artist` ;

CREATE TABLE IF NOT EXISTS `HMMDB`.`Artist` (
  `Artistnavn` VARCHAR(45) UNIQUE NOT NULL,
  `AlbumNr` INT NULL,
  PRIMARY KEY (`Artistnavn`)
);


DROP TABLE IF EXISTS `HMMDB`.`Album` ;

CREATE TABLE IF NOT EXISTS `HMMDB`.`Album` (
  `AlbumNavn` INT NULL,
  `AlbumNr` INT NOT NULL,
  `Artistnavn` VARCHAR(45) NULL,
  PRIMARY KEY (`AlbumNr`),

    FOREIGN KEY (`Artistnavn`)
    REFERENCES `HMMDB`.`Artist` (`Artistnavn`)
);


DROP TABLE IF EXISTS `HMMDB`.`Spor` ;

CREATE TABLE IF NOT EXISTS `HMMDB`.`Spor` (
  `SporNr` INT NULL,
  `SporNavn` VARCHAR(45) NULL,
  `Lengde` INT NULL,
  `ISRC` VARCHAR(45) NOT NULL,
  `AlbumNr` INT NULL,
  PRIMARY KEY (`ISRC`),
    FOREIGN KEY (`AlbumNr`)
    REFERENCES `HMMDB`.`Album` (`AlbumNr`)
);

