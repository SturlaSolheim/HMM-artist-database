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



DROP TABLE IF EXISTS `HMMDB`.`Bruker` ;

CREATE TABLE IF NOT EXISTS `HMMDB`.`Bruker` (
  `Brukernavn` VARCHAR(45),
  `Passord` VARCHAR(45),
  PRIMARY KEY (`Brukernavn`),
);


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



/**/


