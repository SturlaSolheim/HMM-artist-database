DROP TABLE IF EXISTS `HMMDB`.`Spor` ;

DROP TABLE IF EXISTS `HMMDB`.`Artist` ;

DROP TABLE IF EXISTS `HMMDB`.`Album` ;

DROP TABLE IF EXISTS `HMMDB`.`Bruker` ;





CREATE TABLE IF NOT EXISTS `HMMDB`.`Artist` (
  `Artistnavn` VARCHAR(45) UNIQUE NOT NULL,
  `AlbumNr` INT NULL,
  PRIMARY KEY (`Artistnavn`)
);



CREATE TABLE IF NOT EXISTS `HMMDB`.`Album` (
  `AlbumNavn` INT NULL,
  `AlbumNr` INT NOT NULL,
  `Artistnavn` VARCHAR(45) NULL,
  `AntallSpor` INT NULL,
  PRIMARY KEY (`AlbumNr`),

    FOREIGN KEY (`Artistnavn`)
    REFERENCES `HMMDB`.`Artist` (`Artistnavn`)
);




CREATE TABLE IF NOT EXISTS `HMMDB`.`Spor` (
  `SporNr` INT NULL,
  `SporNavn` VARCHAR(45) NULL,
  `Lengde` VARCHAR(45) NULL,
  `ISRC` VARCHAR(45) NOT NULL,
  `AlbumNr` INT NULL,
  `sporLenke` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ISRC`),
    FOREIGN KEY (`AlbumNr`)
    REFERENCES `HMMDB`.`Album` (`AlbumNr`)
);




CREATE TABLE IF NOT EXISTS `HMMDB`.`Bruker` (
  `Brukernavn` VARCHAR(45),
  `Passord` VARCHAR(45),
  PRIMARY KEY (`Brukernavn`),
);

/*
CREATE TABLE IF NOT EXISTS `HMMDB`.`Lenke` (
  `Artistside` VARCHAR(45) NULL,
  `Albumside` VARCHAR(45) NULL,
  `Bilde` VARCHAR(45) NULL,
  `ISRC` VARCHAR(45) NOT NULL,
  `AlbumNr` INT NULL,
  PRIMARY KEY (`ISRC`),
    FOREIGN KEY (`AlbumNr`)
    REFERENCES `HMMDB`.`Album` (`AlbumNr`)
);



*/


